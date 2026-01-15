<?php
use yii\helpers\Html;

/** @var $testes */
?>

<h1>Testes Laboratoriais</h1>

<?= Html::a('Criar Teste', ['create'], ['class' => 'btn btn-success']) ?>

<table class="table table-bordered mt-3">
    <tr>
        <th>ID</th>
        <th>Paciente</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Laboratório</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($testes as $teste): ?>
        <tr>
            <td><?= $teste->id ?></td>
            <td><?= $teste->pessoa->nome ?></td>
            <td><?= $teste->tipoTeste->descricao ?? '-' ?></td>
            <td><?= $teste->estado ?></td>
            <td><?= $teste->laboratorio->nome ?? '-' ?></td>
            <td>
                <?= Html::a('Ver', ['view', 'id' => $teste->id], ['class'=>'btn btn-sm btn-info']) ?>
                <?= Html::a('Editar', ['update', 'id' => $teste->id], ['class'=>'btn btn-sm btn-warning']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

