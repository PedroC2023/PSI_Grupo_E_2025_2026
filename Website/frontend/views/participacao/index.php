<?php
use yii\helpers\Html;
?>

<h1>Eventos Disponíveis</h1>

<?php if (empty($eventos)): ?>
    <p>Não existem eventos disponíveis no momento.</p>
<?php endif; ?>

<?php foreach ($eventos as $evento): ?>
    <div class="card mb-3">
        <div class="card-body">

            <h3><?= Html::encode($evento->titulo) ?></h3>
            <p><?= Html::encode($evento->descricao) ?></p>

            <p><b>Data:</b> 
                <?= Yii::$app->formatter->asDate($evento->data_inicio) ?> 
                até 
                <?= Yii::$app->formatter->asDate($evento->data_fim) ?>
            </p>

            <p><strong>Localização:</strong><br>
                <?= Html::encode($evento->endereco) ?><br>
                <?= Html::encode($evento->cidade) ?> –
                <?= Html::encode($evento->regiao) ?><br>
                <?= Html::encode($evento->pais) ?>
            </p>

            <?= Html::a(
                'Inscrever',
                ['inscrever', 'id' => $evento->id],
                [
                    'class' => 'btn btn-primary',
                    'data-method' => 'post'
                ]
            ) ?>

        </div>
    </div>
<?php endforeach; ?>


