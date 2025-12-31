<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AcaoResposta $model */

$this->title = 'Update Acao Resposta: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Acao Respostas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="acao-resposta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
