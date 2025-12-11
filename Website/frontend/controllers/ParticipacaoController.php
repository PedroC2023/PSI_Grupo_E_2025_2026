<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Evento;
use common\models\ParticipacaoEvento;

class ParticipacaoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'inscrever'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['paciente'], // só pacientes
                    ],
                ],
            ],
        ];
    }

    // Lista eventos ativos para o paciente
    public function actionIndex()
    {
        $eventos = Evento::find()
        ->orderBy(['data_inicio' => SORT_ASC])
        ->all();

        // Atualizar status automaticamente
        foreach ($eventos as $evento) {
            $evento->updateStatusIfNeeded();
        }

        // Mostrar apenas eventos abertos para pacientes
        $eventos = Evento::find()
            ->where(['status' => 'aberto'])
            ->orderBy(['data_inicio' => SORT_ASC])
            ->all();

        return $this->render('index', [
            'eventos' => $eventos
        ]);
    }

    // Paciente inscreve-se num evento
    public function actionInscrever($id)
    {
        $pessoa = Yii::$app->user->identity->pessoa;
        if (!$pessoa) {
            Yii::$app->session->setFlash('error', 'Dados pessoais não encontrados.');
            return $this->redirect(['index']);
        }

        // Impedir duplicada
        if (ParticipacaoEvento::findOne(['id_evento' => $id, 'id_pessoa' => $pessoa->id])) {
            Yii::$app->session->setFlash('warning', 'Já estás inscrito neste evento.');
            return $this->redirect(['index']);
        }

        $participacao = new ParticipacaoEvento();
        $participacao->id_evento = $id;
        $participacao->id_pessoa = $pessoa->id;
        $participacao->data_participacao = date('Y-m-d');
        $participacao->status_participacao = 'pendente';

        if ($participacao->save()) {
            Yii::$app->session->setFlash('success', 'Inscrição realizada com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao inscrever.');
        }

        return $this->redirect(['index']);
    }
}
