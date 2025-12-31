<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var $model common\models\AcaoResposta */

$form = ActiveForm::begin();
?>

<?= $form->field($model, 'id_tipo_acao')->dropDownList(
    ArrayHelper::map(
        \common\models\TipoAcao::find()->all(),
        'id',
        'descricao'
    ),
    ['prompt' => 'Selecionar tipo de ação']
) ?>

<?= $form->field($model, 'resposta')->textarea(['rows' => 4]) ?>

<div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

