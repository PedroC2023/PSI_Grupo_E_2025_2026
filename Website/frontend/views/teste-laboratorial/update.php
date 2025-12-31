<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TesteLaboratorial $model */

$this->title = 'Update Teste Laboratorial: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teste Laboratorials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teste-laboratorial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
