<?php

namespace frontend\controllers;

use Yii;
use common\models\Evento;
use common\models\ParticipacaoEvento;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class EventoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['index', 'view', 'create', 'update', 'delete', 'participar'],
                'rules' => [
                    // Pacientes e colaboradores podem ver eventos
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['viewEvents'],
                    ],

                    // Pacientes podem participar
                    [
                        'actions' => ['participar'],
                        'allow' => true,
                        'roles' => ['participateEvents'],
                    ],

                    // Só colaboradores podem criar/editar/apagar
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['manageEvents'],
                    ],
                ],
            ],
        ];
    }

    // listar participantes de um evento (colaborador)
    public function actionParticipantes($id)
    {
        $evento = Evento::findOne($id);
        if (!$evento) {
            throw new NotFoundHttpException();
        }

        return $this->render('participantes', [
            'evento' => $evento,
            'participacoes' => $evento->participacoes,
        ]);
    }

    public function actionIndex()
    {
        $eventos = Evento::find()->all();
        return $this->render('index', ['eventos' => $eventos]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Evento();

            if ($model->load(Yii::$app->request->post())) {

            // preenche automaticamente o utilizador que cria o evento
            $model->id_utilizador = Yii::$app->user->id;

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }


        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    // paciente participa no evento -----------------

    public function actionParticipar($id)
    {
        $userId = Yii::$app->user->id;

        if (!$userId) {
            throw new ForbiddenHttpException();
        }

        $pessoa = \common\models\Pessoa::findOne(['id_user' => $userId]);
        if (!$pessoa || $pessoa->role !== 'paciente') {
            throw new ForbiddenHttpException('Apenas pacientes podem inscrever-se.');
        }

        $evento = Evento::findOne($id);
        if (!$evento) {
            throw new NotFoundHttpException();
        }

        // impedir inscrições após início/fim
        $now = new \DateTime();
        if ($now > new \DateTime($evento->data_inicio)) {
            Yii::$app->session->setFlash('error', 'Inscrições encerradas.');
            return $this->redirect(['view', 'id' => $id]);
        }

        // verificar duplicado (CORRETO)
        $exists = ParticipacaoEvento::find()
            ->where([
                'id_evento' => $id,
                'id_utilizador' => $userId
            ])->one();

        if ($exists) {
            Yii::$app->session->setFlash('info', 'Já estás inscrito.');
            return $this->redirect(['view', 'id' => $id]);
        }

        // criar participação
        $model = new ParticipacaoEvento();
        $model->id_evento = $id;
        $model->id_utilizador = $userId;
        $model->data_participacao = date('Y-m-d H:i:s');
        $model->status_participacao = 'inscrito';

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Inscrição realizada.');
        } else {
            Yii::$app->session->setFlash('error', implode(', ', $model->getFirstErrors()));
        }

        return $this->redirect(['view', 'id' => $id]);
    }


    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('O evento não existe.');
    }
}

