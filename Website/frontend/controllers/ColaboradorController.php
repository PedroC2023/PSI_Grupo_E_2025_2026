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
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['colaborador'], // só colaboradores
                    ],
                ],
            ],
        ];
    }

    public function actionEventos()
    {
        return $this->render('eventos');
    }

    public function actionParticipantes($id)
    {
        return $this->render('participantes');
    }

    public function actionEditar($id)
    {
        return $this->render('editar');
    }
}
