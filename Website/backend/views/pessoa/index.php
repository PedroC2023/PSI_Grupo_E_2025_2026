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

    <p>
        <?= Html::a('Create Pessoa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'telefone',
            'role',
            'id_regiao',
            'id_user',
            //'nome',
            //'n_identificacao_fiscal',
            //'morada',
            //'codigo_postal',
            //'n_seguranca_social',
            //'n_utente_saude',
            //'n_cartao_cidadao',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pessoa $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
