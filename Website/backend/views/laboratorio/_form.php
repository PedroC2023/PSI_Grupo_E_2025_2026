<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'nome')->textInput() ?>
<<<<<<< HEAD
<?= $form->field($model, 'referencia')->textInput() ?>
<?= $form->field($model, 'contacto')->textInput() ?>
<?= $form->field($model, 'email')->textInput() ?>
=======
<?= $form->field($model, 'Localizacao')->textInput() ?>
<?= $form->field($model, 'contacto')->textInput() ?>

>>>>>>> main

<div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
