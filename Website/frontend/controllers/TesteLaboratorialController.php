<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\models\TesteLaboratorial;
use common\models\Pessoa;
<<<<<<< HEAD
=======
use common\models\Laboratorio;
use yii\web\ForbiddenHttpException;
use yii\web\BadRequestHttpException;

>>>>>>> main

class TesteLaboratorialController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
<<<<<<< HEAD

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
=======
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
>>>>>>> main
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
<<<<<<< HEAD
=======
        $model->estado = 'pendente';
        $model->data_criacao = date('Y-m-d H:i:s');
>>>>>>> main

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

<<<<<<< HEAD
        return $this->render('create', compact('model'));
=======
        return $this->render('create', [
            'model' => $model,
            'pessoas' => Pessoa::find()->all(),
        ]);
>>>>>>> main
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
<<<<<<< HEAD
        $pessoa = Pessoa::findOne(['id_user' => Yii::$app->user->id]);

        $testes = TesteLaboratorial::find()
            ->where(['id_pessoa' => $pessoa->id])
            ->all();

        return $this->render('meus-testes', compact('testes'));
    }
=======
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

>>>>>>> main
}
