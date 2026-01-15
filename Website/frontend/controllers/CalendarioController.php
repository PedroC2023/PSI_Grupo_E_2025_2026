<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Evento;
class CalendarioController extends Controller
{
    public function actionIndex()
    {
        $eventos = Evento::find()->all();

        return $this->render('index', [
            'eventos' => $eventos,
        ]);
    }


}