<?php

use common\models\ParticipacaoEvento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Participacao Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participacao-evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Participacao Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_evento',
            'id_utilizador',
            'data_participacao',
            'status_participacao',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ParticipacaoEvento $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
