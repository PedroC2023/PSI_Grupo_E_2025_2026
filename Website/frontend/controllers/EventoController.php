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
            Yii::$app->session->setFlash('error', 'Precisas de fazer login para te inscrever.');
            return $this->redirect(['view', 'id' => $id]);
        }

        // encontrar a pessoa associada ao user
        $pessoa = \common\models\Pessoa::findOne(['id_user' => $userId]);
        if (!$pessoa) {
            Yii::$app->session->setFlash('error', 'Registo de pessoa não encontrado. Completa o teu perfil.');
            return $this->redirect(['view', 'id' => $id]);
        }

        // evento existe?
        $evento = \common\models\Evento::findOne($id);
        if (!$evento) {
            Yii::$app->session->setFlash('error', 'Evento não encontrado.');
            return $this->redirect(['index']);
        }

        // verificar datas: só permitir inscrição antes do inicio (ou conforme regra)
        $now = new \DateTime('now');
        $inicio = new \DateTime($evento->data_inicio);
        $fim = $evento->data_fim ? new \DateTime($evento->data_fim) : null;

        if ($fim && $now > $fim) {
            Yii::$app->session->setFlash('error', 'Evento já terminou, não é possível inscrever.');
            return $this->redirect(['view', 'id' => $id]);
        }
        if ($now > $inicio) {
            Yii::$app->session->setFlash('error', 'O evento já iniciou — inscrições encerradas.');
            return $this->redirect(['view', 'id' => $id]);
        }

        // verificar capacidade (se tens campo capacidade no evento)
        if (isset($evento->capacidade)) {
            $count = \common\models\ParticipacaoEvento::find()
                ->where(['id_evento' => $id, 'status_participacao' => 'inscrito'])
                ->count();
            if ($count >= (int)$evento->capacidade) {
                Yii::$app->session->setFlash('error', 'Capacidade esgotada.');
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        // verificar inscrição duplicada
        $exists = \common\models\ParticipacaoEvento::find()
            ->where(['id_evento' => $id, 'id_pessoa' => $pessoa->id])
            ->one();
        if ($exists) {
            Yii::$app->session->setFlash('info', 'Já estás inscrito neste evento.');
            return $this->redirect(['view', 'id' => $id]);
        }

        // criar participação
        $model = new \common\models\ParticipacaoEvento();
        $model->id_evento = $id;
        $model->id_pessoa = $pessoa->id;
        $model->data_participacao = date('Y-m-d H:i:s');
        $model->status_participacao = 'inscrito';

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Inscrição realizada com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao inscrever: ' . implode('; ', $model->getFirstErrors()));
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

