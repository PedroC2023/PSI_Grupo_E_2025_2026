<?php

use common\models\Evento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'descricao',
            'data_inicio',
            'data_fim',
            //'tipo_evento',
            //'status',
            //'id_utilizador',
            //'pais',
            //'regiao',
            //'cidade',
            //'endereco',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Evento $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
