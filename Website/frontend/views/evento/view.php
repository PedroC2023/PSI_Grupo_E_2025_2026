<?php
use yii\helpers\Html;
?>

<h1><?= $model->titulo ?></h1>

<p><?= $model->descricao ?></p>

<p>
    <strong>Localização:</strong> 
    <?= $model->endereco ?>, <?= $model->cidade ?>, <?= $model->regiao ?>, <?= $model->pais ?>
</p>

<p><strong>Início:</strong> <?= $model->data_inicio ?></p>
<p><strong>Fim:</strong> <?= $model->data_fim ?></p>

<?php if (Yii::$app->user->can('manageEvents')): ?>
    <?= Html::a("Editar", ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a("Eliminar", ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data-method' => 'post',
        'data-confirm' => 'Eliminar evento?',
    ]) ?>
<?php endif; ?>
