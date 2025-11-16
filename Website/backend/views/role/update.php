<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Alterar Role de: " . $user->username;
?>

<h1><?= $this->title ?></h1>

<div class="card p-4">

    <?php $form = ActiveForm::begin(); ?>

    <label class="form-label">Novo Role</label>
    <?= Html::dropDownList('role', $currentRole, [
        'paciente' => 'Paciente',
        'colaborador' => 'Colaborador',
        'admin' => 'Admin',
    ], ['class' => 'form-control']) ?>

    <br>

    <div>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
