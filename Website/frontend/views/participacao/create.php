<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ParticipacaoEvento $model */

$this->title = 'Create Participacao Evento';
$this->params['breadcrumbs'][] = ['label' => 'Participacao Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participacao-evento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
