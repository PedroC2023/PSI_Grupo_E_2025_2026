<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

class RbacController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'], // só admin acede
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRole($id)
    {
        $user = User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException("Utilizador não encontrado");
        }

        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();

        if (Yii::$app->request->isPost) {
            $newRole = Yii::$app->request->post('role');

            // remover roles antigas
            $auth->revokeAll($id);

            // atribuir nova role
            $role = $auth->getRole($newRole);
            if ($role) {
                $auth->assign($role, $id);
                Yii::$app->session->setFlash('success', 'Role atualizada com sucesso.');
            } else {
                Yii::$app->session->setFlash('error', 'Role inválida.');
            }

            return $this->redirect(['index']);
        }

        // obter role atual
        $current = array_keys($auth->getRolesByUser($id));
        $currentRole = $current ? $current[0] : '(sem role)';

        return $this->render('role', [
            'user' => $user,
            'roles' => $roles,
            'currentRole' => $currentRole,
        ]);
    }

    public function actionDeleteUser($id)
    {
        $user = User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException('User não encontrado.');
        }

        $auth = Yii::$app->authManager;

        // revogar roles
        $auth->revokeAll($id);

        // apagar pessoa associada (se existir)
        if ($user->pessoa) {
            $user->pessoa->delete();
        }

        // apagar user
        $user->delete();

        Yii::$app->session->setFlash('success', 'Utilizador eliminado com sucesso.');
        return $this->redirect(['index']);
    }
}

