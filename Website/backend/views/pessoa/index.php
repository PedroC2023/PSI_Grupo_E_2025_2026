<?php

use common\models\Pessoa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pessoas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-index">

    <h1><?= Html::encode($this->title) ?></h1>
   


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\ActionColumn',],

            'id',
            'telefone',
            'role',
            //'id_regiao',
            //'id_user',
            'nome',
            //'n_identificacao_fiscal',
            'morada',
            //'codigo_postal',
            //'n_seguranca_social',
            //'n_utente_saude',
            'n_cartao_cidadao',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return \yii\helpers\Html::a(
                            '<i class="fas fa-trash"></i>',
                            ['delete', 'id' => $model->id],
                            [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => 'Eliminar completamente a pessoa e o user associado?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                ],
            ],

        ],
    ]); ?>


</div>
