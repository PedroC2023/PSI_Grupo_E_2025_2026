<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\models\TesteLaboratorial;
use common\models\Pessoa;
use common\models\Laboratorio;
use yii\web\ForbiddenHttpException;
use yii\web\BadRequestHttpException;


class TesteLaboratorialController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    // paciente
                    [
                        'actions' => ['meus-testes', 'escolher-laboratorio'],
                        'allow' => true,
                        'roles' => ['viewMyTestes'],
                    ],

                    // colaborador / admin
                    [
                        'actions' => ['index', 'create', 'update', 'view'],
                        'allow' => true,
                        'roles' => ['manageTestes'],
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
        $model->estado = 'pendente';
        $model->data_criacao = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'pessoas' => Pessoa::find()->all(),
        ]);
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
        $pessoaId = Yii::$app->user->identity->pessoa->id;

        $testes = TesteLaboratorial::find()
            ->where(['id_pessoa' => $pessoaId])
            ->orderBy(['data_criacao' => SORT_DESC])
            ->all();

        return $this->render('meus-testes', [
            'testes' => $testes,
        ]);
    }

    public function actionDebugUser()
    {
        echo '<pre>';
        var_dump([
            'isGuest' => Yii::$app->user->isGuest,
            'id' => Yii::$app->user->id,
            'username' => Yii::$app->user->identity->username ?? null,
        ]);
        echo '</pre>';
        exit;
    }

}
