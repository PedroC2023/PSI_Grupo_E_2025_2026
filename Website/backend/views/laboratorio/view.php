<?php
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = $model->nome;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data-method' => 'post',
        'data-confirm' => 'Tem a certeza?',
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'nome',
        'referencia',
        'contacto',
        'email',
    ],
]); ?>
