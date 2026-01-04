<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\ParticipacaoEvento $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Participacao Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="participacao-evento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_evento',
            'id_utilizador',
            'data_participacao',
            'status_participacao',
        ],
    ]) ?>
    <p><b>Data:</b> <?= $evento->data_inicio ?> até <?= $evento->data_fim ?></p>
    <p><b>Local:</b> <?= $evento->cidade ?>, <?= $evento->regiao ?>, <?= $evento->pais ?></p>
    <p><strong>Localização:</strong><br>
        <?= $model->endereco ?>,<br>
        <?= $model->cidade ?> – <?= $model->regiao ?>,<br>
        <?= $model->pais ?>
    </p>

    <?php if (Yii::$app->user->can('participateEvents')): ?>
    <?= Html::a('Inscrever', ['/participacao/inscrever', 'id' => $model->id], [
        'class' => 'btn btn-primary',
        'data-method' => 'post'
    ]) ?>
    <?php endif; ?>


</div>
