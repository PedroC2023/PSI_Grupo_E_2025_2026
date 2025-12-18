<?php
use yii\helpers\Html;

/** @var $evento common\models\Evento */
/** @var $participacoes common\models\ParticipacaoEvento[] */

$this->title = 'Participantes - ' . $evento->titulo;
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-bordered">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Data Inscrição</th>
        <th>Estado</th>
    </tr>

    <?php foreach ($participacoes as $p): ?>
        <tr>
            <td><?= Html::encode($p->pessoa->nome ?? '-') ?></td>
            <td><?= Html::encode($p->user->email ?? '-') ?></td>
            <td><?= Html::encode($p->data_participacao) ?></td>
            <td><?= Html::encode($p->status_participacao) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
