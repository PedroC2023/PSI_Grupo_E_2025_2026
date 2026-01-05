<?php
use yii\helpers\Html;

/** @var $testes */
?>

<h1>Os Meus Testes</h1>

<table class="table table-striped">
    <tr>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Laboratório</th>
        <th>Localização</th>
        <th>Contacto</th>
    </tr>

    <?php foreach ($testes as $teste): 
    $teste->updateEstadoSeNecessario();
    ?>
        <tr>
            <td><?= $teste->tipoTeste->descricao ?></td>
            <td><?= $teste->estado ?></td>
            <td>
                <?= $teste->laboratorio->nome ?? '-' ?>              
                <?php if ($teste->estado === 'pendente'): ?>
                    <?= Html::a(
                        'Escolher Laboratório',
                        ['escolher-laboratorio', 'id' => $teste->id],
                        ['class' => 'btn btn-primary btn-sm']
                    ) ?>
                <?php endif; ?>
            </td>
            <td> <?= $teste->laboratorio->localizacao ?? '-' ?></td>
            <td> <?= $teste->laboratorio->contacto ?? '-' ?></td>
        </tr>
    <?php endforeach; ?>
</table>
