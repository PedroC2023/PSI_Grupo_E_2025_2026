<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = "Alterar Role de: $user->username";
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Role atual: <strong><?= $currentRole ?></strong></p>

<?= Html::beginForm() ?>

<?= Html::dropDownList('role', $currentRole, ArrayHelper::map($roles, 'name', 'name')) ?>

<br><br>

<?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>

<?= Html::endForm() ?>
