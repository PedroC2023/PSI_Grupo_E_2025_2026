<?php

namespace backend\controllers;

use Yii;
use common\models\Pessoa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PessoaController implements the CRUD actions for Pessoa model.
 */
class PessoaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Lists all Pessoa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pessoa::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pessoa model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pessoa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        throw new \yii\web\ForbiddenHttpException('A criação de utilizadores não é permitida.');
    }


    /**
     * Updates an existing Pessoa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // atualizar RBAC caso mudes role
            $auth = Yii::$app->authManager;
            $auth->revokeAll($model->id_user);

            $role = $auth->getRole($model->role);
            if ($role) {
                $auth->assign($role, $model->id_user);
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Pessoa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $pessoa = $this->findModel($id);

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        try {

            // 1) remover permissões (RBAC)
            Yii::$app->authManager->revokeAll($pessoa->id_user);

            // 2) guardar user antes de apagar pessoa
            $user = $pessoa->user; // objeto user associado

            // 3) apagar PESSOA
            if (!$pessoa->delete()) {
                throw new \Exception('Erro ao apagar dados da pessoa.');
            }

            // 4) apagar USER
            if ($user && !$user->delete()) {
                throw new \Exception('Erro ao apagar utilizador.');
            }

            // tudo OK
            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Pessoa e utilizador apagados com sucesso.');

        } catch (\Throwable $e) {

            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Erro ao eliminar: ' . $e->getMessage());
        }

        return $this->redirect(['index']);
    }



    /**
     * Finds the Pessoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pessoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pessoa::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
