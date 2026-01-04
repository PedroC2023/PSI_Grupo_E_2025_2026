<?php
use yii\helpers\Html;

/** @var $participacoes common\models\ParticipacaoEvento[] */

$this->title = 'Os meus eventos';
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-striped">
    <tr>
        <th>Evento</th>
        <th>Data</th>
        <th>Local</th>
        <th>Estado</th>
    </tr>

    <?php foreach ($participacoes as $p): ?>
        <tr>
            <td><?= Html::encode($p->evento->titulo) ?></td>
            <td><?= Html::encode($p->evento->data_inicio) ?></td>
            <td><?= Html::encode($p->evento->cidade) ?></td>
            <td><?= Html::encode($p->status_participacao) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
