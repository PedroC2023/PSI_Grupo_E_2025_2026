<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class RbacController extends Controller
{
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $permissions = $auth->getPermissions();

        return $this->render('index', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function actionAssign($userId, $roleName)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($roleName);
        if ($role) {
            $auth->assign($role, $userId);
            Yii::$app->session->setFlash('success', "Assigned role '{$roleName}' to user #{$userId}");
        } else {
            Yii::$app->session->setFlash('error', "Role not found: {$roleName}");
        }
        return $this->redirect(['index']);
    }
}
