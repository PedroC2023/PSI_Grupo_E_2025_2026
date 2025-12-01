<?php

namespace backend\models;

use Yii;

class LoginForm extends \common\models\LoginForm
{
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();

            // backend: só admin pode entrar
            if (!Yii::$app->authManager->checkAccess($user->id, 'admin')) {
                Yii::$app->session->setFlash('error', 'Acesso reservado a administradores.');
                return false;
            }

            return Yii::$app->user->login(
                $user, 
                $this->rememberMe ? 3600 * 24 * 30 : 0
            );
        }

        return false;
    }
}
