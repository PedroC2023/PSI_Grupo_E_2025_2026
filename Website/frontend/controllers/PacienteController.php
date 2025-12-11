<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class PacienteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'eventos', 'participacao'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['paciente'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEventos()
    {
        return $this->render('eventos');
    }

    public function actionParticipacao()
    {
        return $this->render('participacao');
    }
}

