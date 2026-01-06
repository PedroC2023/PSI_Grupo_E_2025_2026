<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'id_pessoa')->dropDownList(
    ArrayHelper::map(\common\models\Pessoa::find()->all(), 'id', 'nome'),
    ['prompt' => 'Selecionar paciente']
) ?>

<?= $form->field($model, 'id_tipo_teste')->dropDownList(
    ArrayHelper::map(\common\models\TipoTeste::find()->all(), 'id', 'nome'),
    ['prompt' => 'Selecionar tipo de teste']
) ?>

<?= $form->field($model, 'data_realizacao')->input('date') ?>

<?= Html::submitButton('Criar Teste', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>
