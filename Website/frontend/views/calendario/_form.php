<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Evento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descricao')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'data_inicio')->input('datetime-local', [
            'value' => $model->data_inicio
                    ? date('Y-m-d\TH:i', strtotime($model->data_inicio))
                    : ''
    ]) ?>

    <?= $form->field($model, 'data_fim')->input('datetime-local', [
            'value' => $model->data_fim
                    ? date('Y-m-d\TH:i', strtotime($model->data_fim))
                    : ''
    ]) ?>

    <?= $form->field($model, 'tipo_evento')->dropDownList([
            'alerta' => 'Alerta',
            'normal' => 'Normal',
            'urgente' => 'Urgente'
    ]) ?>
    <?= $form->field($model, 'status')->dropDownList([
            'ativo' => 'Ativo',
            'inativo' => 'Inativo'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>