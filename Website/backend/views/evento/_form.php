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

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_inicio')->textInput() ?>

    <?= $form->field($model, 'data_fim')->textInput() ?>

    <?= $form->field($model, 'tipo_evento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_utilizador')->textInput() ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'regiao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
