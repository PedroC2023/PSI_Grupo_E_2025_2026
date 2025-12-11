<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ParticipacaoEvento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="participacao-evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_evento')->textInput() ?>

    <?= $form->field($model, 'id_utilizador')->textInput() ?>

    <?= $form->field($model, 'data_participacao')->textInput() ?>

    <?= $form->field($model, 'status_participacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
