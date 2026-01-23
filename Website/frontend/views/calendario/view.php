<?php
use yii\helpers\Html;
?>
<h1><?= Html::encode($model->titulo) ?></h1>


<p><strong>Início:</strong> <?= $model->data_inicio ?></p>
<p><strong>Fim:</strong> <?= $model->data_fim ?></p>


<?php if (!empty($model->descricao)): ?>
    <p><?= nl2br(Html::encode($model->descricao)) ?></p>
<?php endif; ?>


<?= Html::a('Voltar ao Calendário', ['index'], ['class' => 'btn btn-secondary']) ?>

