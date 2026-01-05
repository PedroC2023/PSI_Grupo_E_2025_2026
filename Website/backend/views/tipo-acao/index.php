<?php

use yii\grid\GridView;
use yii\helpers\Html;

echo Html::a('Criar Tipo de Ação', ['create'], ['class' => 'btn btn-success']);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'descricao',
        'nome',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);

// Yii::$app->user->can('manageTipoAcao') ? 'SIM' : 'NÃO' 


