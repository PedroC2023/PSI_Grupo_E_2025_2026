<?php

namespace backend\modules\api\controllers;

use yii\rest\Controller;
use common\models\ParticipacaoEvento;
use Yii;

class ParticipacaoEventoController extends Controller
{
    // GET /api/evento/{id}/participacoes
    public function actionIndex($id)
    {
        return ParticipacaoEvento::find()
            ->where(['id_evento' => $id])
            ->all();
    }

    // POST /api/evento/{id}/participacoes
    public function actionCreate($id)
    {
        $model = new ParticipacaoEvento();
        $model->id_evento = $id;
        $model->id_utilizador = Yii::$app->request->post('id_utilizador');
        $model->status_participacao = 'pendente';
        $model->data_participacao = date('Y-m-d H:i:s');

        if ($model->save()) {
            return $model;
        }

        return $model->errors;
    }
}
