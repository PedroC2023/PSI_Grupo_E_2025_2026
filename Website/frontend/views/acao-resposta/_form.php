<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\TipoAcao;

/** @var yii\web\View $this */
/** @var common\models\AcaoResposta $model */
?>

<div class="acao-resposta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_tipo_acao')->dropDownList(
        ArrayHelper::map(
            TipoAcao::find()->all(),
            'id',
            'descricao'
        ),
        ['prompt' => 'Selecionar tipo de ação']
    ) ?>

    <?= $form->field($model, 'mensagem')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
