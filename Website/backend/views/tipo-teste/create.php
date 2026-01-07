<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoTeste $model */

$this->title = 'Create Tipo Teste';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Testes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-teste-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
