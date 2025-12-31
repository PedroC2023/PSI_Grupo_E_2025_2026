<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\models\TesteLaboratorial;
use common\models\Pessoa;

class TesteLaboratorialController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [

                    // paciente vê os seus testes
                    [
                        'actions' => ['meus-testes'],
                        'allow' => true,
                        'roles' => ['paciente'],
                    ],

                    // colaborador gere testes
                    [
                        'actions' => ['index', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['colaborador', 'admin'],
                    ],
                ],
            ],
        ];
    }

    // LISTA GERAL (colaborador)
    public function actionIndex()
    {
        $testes = TesteLaboratorial::find()->all();
        return $this->render('index', compact('testes'));
    }

    // CRIAR TESTE (colaborador)
    public function actionCreate()
    {
        $model = new TesteLaboratorial();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('model'));
    }

    // EDITAR / REGISTAR RESULTADO
    public function actionUpdate($id)
    {
        $model = TesteLaboratorial::findOne($id);
        if (!$model) throw new NotFoundHttpException();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('model'));
    }

    // PACIENTE: ver os seus testes
    public function actionMeusTestes()
    {
        $pessoa = Pessoa::findOne(['id_user' => Yii::$app->user->id]);

        $testes = TesteLaboratorial::find()
            ->where(['id_pessoa' => $pessoa->id])
            ->all();

        return $this->render('meus-testes', compact('testes'));
    }
}
