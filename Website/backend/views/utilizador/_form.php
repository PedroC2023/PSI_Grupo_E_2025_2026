<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Utilizador $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="utilizador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_registo')->textInput() ?>

    <?= $form->field($model, 'id_role')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
