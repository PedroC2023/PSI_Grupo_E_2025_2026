<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Laboratórios';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Criar Laboratório', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'nome',
        'referencia',
        'contacto',
        'email',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
