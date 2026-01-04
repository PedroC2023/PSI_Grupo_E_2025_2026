<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TesteLaboratorial $model */

$this->title = 'Create Teste Laboratorial';
$this->params['breadcrumbs'][] = ['label' => 'Teste Laboratorials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teste-laboratorial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
