<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Pessoa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pessoa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList([
        'paciente' => 'Paciente',
        'colaborador' => 'Colaborador',
    ]) ?>

    <?= $form->field($model, 'id_regiao')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'n_identificacao_fiscal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo_postal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'n_seguranca_social')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'n_utente_saude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'n_cartao_cidadao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
