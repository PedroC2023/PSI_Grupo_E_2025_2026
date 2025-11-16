<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\User;
use yii\web\NotFoundHttpException;

class RoleController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $auth = Yii::$app->authManager;

        $currentRole = $auth->getRolesByUser($user->id);
        $currentRoleName = count($currentRole) ? array_keys($currentRole)[0] : null;

        if (Yii::$app->request->isPost) {
            $role = Yii::$app->request->post('role');

            // remover roles antigos
            $auth->revokeAll($user->id);

            // atribuir novo role
            $newRole = $auth->getRole($role);
            $auth->assign($newRole, $user->id);

            Yii::$app->session->setFlash('success', 'Role atualizado com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'user' => $user,
            'currentRole' => $currentRoleName,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('User não encontrado.');
    }
}
