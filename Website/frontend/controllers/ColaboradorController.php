<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class ColaboradorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'eventos', 'participantes', 'editar-evento'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['colaborador'],
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

    public function actionParticipantes()
    {
        return $this->render('participantes');
    }

    public function actionEditarEvento()
    {
        return $this->render('editar-evento');
    }
}
