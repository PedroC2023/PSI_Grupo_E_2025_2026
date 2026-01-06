<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'nome')->textInput() ?>
<?= $form->field($model, 'Localizacao')->textInput() ?>
<?= $form->field($model, 'contacto')->textInput() ?>


<div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
