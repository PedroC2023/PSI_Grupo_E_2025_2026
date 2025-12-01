<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pessoa $model */

$this->title = 'Create Pessoa';
$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
