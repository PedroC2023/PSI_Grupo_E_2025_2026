<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Laboratorio;

/** @var $model */

$form = ActiveForm::begin();

echo $form->field($model, 'id_laboratorio')->dropDownList(
    ArrayHelper::map(Laboratorio::find()->all(), 'id', 'nome'),
    ['prompt' => 'Selecione o laboratório']
);

echo Html::submitButton('Confirmar', ['class' => 'btn btn-success']);

ActiveForm::end();

