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
<<<<<<< HEAD
        'nome',
        'referencia',
        'contacto',
        'email',
=======
        'id',
        'nome',
        'Localizacao',
        'contacto',
>>>>>>> main
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
