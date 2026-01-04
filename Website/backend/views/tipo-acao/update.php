<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoAcao $model */

$this->title = 'Update Tipo Acao: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Acaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-acao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
