<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoAcao $model */

$this->title = 'Create Tipo Acao';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Acaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-acao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
