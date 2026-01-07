<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
<<<<<<< HEAD
=======
use yii\helpers\ArrayHelper;
use common\models\Especialidade;
>>>>>>> main

/** @var yii\web\View $this */
/** @var common\models\Evento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

<<<<<<< HEAD
=======
    <?= $form->field($model, 'id_especialidade')->dropDownList(
        ArrayHelper::map(
            Especialidade::find()->orderBy('nome')->all(),
            'id',
            'nome'
        ),
        ['prompt' => 'Selecionar especialidade']
    ) ?>


>>>>>>> main
    <?= $form->field($model, 'pais')->textInput() ?>

    <?= $form->field($model, 'regiao')->textInput() ?>

    <?= $form->field($model, 'cidade')->textInput() ?>

    <?= $form->field($model, 'endereco')->textInput() ?>

    <?= $form->field($model, 'data_inicio')->input('datetime-local') ?>
    <?= $form->field($model, 'data_fim')->input('datetime-local') ?>

    <?= $form->field($model, 'tipo_evento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
<<<<<<< HEAD
        'aberto' => 'Aberto',
        'fechado' => 'Fechado'
=======
        'aberto' => 'Aberto'        
>>>>>>> main
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
