<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TesteLaboratorial $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="teste-laboratorial-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pessoa')->textInput() ?>

    <?= $form->field($model, 'id_laboratorio')->textInput() ?>

    <?= $form->field($model, 'tipo_teste')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resultado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_teste')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
