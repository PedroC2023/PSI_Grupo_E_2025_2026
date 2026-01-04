<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use common\models\Evento;
use common\models\ParticipacaoEvento;
use common\models\Pessoa;

class ParticipacaoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'inscrever', 'meus-eventos'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['paciente'], // RBAC
                    ],
                ],
            ],
        ];
    }

    // ===============================
    // Eventos em que o paciente está inscrito
    // ===============================
    public function actionMeusEventos()
    {
        $userId = Yii::$app->user->id;

        $participacoes = ParticipacaoEvento::find()
            ->where(['id_utilizador' => $userId])
            ->with('evento')
            ->all();

        return $this->render('meus-eventos', [
            'participacoes' => $participacoes,
        ]);
    }

    // ===============================
    // Lista de eventos disponíveis
    // ===============================
    public function actionIndex()
    {
        // Atualizar estados automaticamente
        $eventos = Evento::find()->all();
        foreach ($eventos as $evento) {
            $evento->updateStatusIfNeeded();
        }

        // Mostrar apenas eventos abertos
        $eventos = Evento::find()
            ->where(['status' => 'aberto'])
            ->orderBy(['data_inicio' => SORT_ASC])
            ->all();

        return $this->render('index', [
            'eventos' => $eventos
        ]);
    }

    // ===============================
    // Inscrição do paciente num evento
    // ===============================
    public function actionInscrever($id)
    {
        $userId = Yii::$app->user->id;

        $pessoa = Pessoa::findOne(['id_user' => $userId]);
        if (!$pessoa || $pessoa->role !== Pessoa::ROLE_PACIENTE) {
            throw new ForbiddenHttpException('Apenas pacientes podem inscrever-se.');
        }

        // Evitar inscrição duplicada (CORRETO)
        if (ParticipacaoEvento::findOne([
            'id_evento' => $id,
            'id_utilizador' => $userId
        ])) {
            Yii::$app->session->setFlash('warning', 'Já estás inscrito neste evento.');
            return $this->redirect(['index']);
        }

        $participacao = new ParticipacaoEvento();
        $participacao->id_evento = $id;
        $participacao->id_utilizador = $userId;
        $participacao->data_participacao = date('Y-m-d H:i:s');
        $participacao->status_participacao = 'inscrito';

        if ($participacao->save()) {
            Yii::$app->session->setFlash('success', 'Inscrição realizada com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', implode(', ', $participacao->getFirstErrors()));
        }

        return $this->redirect(['index']);
    }
}
