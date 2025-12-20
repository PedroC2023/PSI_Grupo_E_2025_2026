<?php
use yii\helpers\Html;
?>

<h1>Eventos</h1>

<?php if (Yii::$app->user->can('manageEvents')): ?>
    <p><?= Html::a("Criar Evento", ['create'], ['class' => 'btn btn-success']) ?></p>
<?php endif; ?>

<table class="table table-bordered">
    <tr>
        <th>Título</th>
        <th>Data</th>
        <th></th>
    </tr>

    <?php foreach ($eventos as $evento): ?>
        <tr>
            <td><?= $evento->titulo ?></td>
            <td><?= $evento->data_inicio ?></td>
            <td>
                <?= Html::a("Ver", ['view', 'id' => $evento->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?php if (Yii::$app->user->can('manageEvents')) ?>
                    <?= Html::a("Ver Participantes", ['evento/participantes', 'id' => $evento->id], 
                    ['class' => 'btn btn-info btn-sm']); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
