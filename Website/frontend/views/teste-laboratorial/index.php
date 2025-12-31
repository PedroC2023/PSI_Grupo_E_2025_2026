<h1>Testes Laboratoriais</h1>

<?php foreach ($testes as $t): ?>
    <p>
        <?= $t->pessoa->nome ?> —
        <?= $t->tipo_teste ?> —
        <?= $t->resultado ?? 'Pendente' ?>
        <a href="<?= Yii::$app->urlManager->createUrl(['teste-laboratorial/update', 'id' => $t->id]) ?>">Editar</a>
    </p>
<?php endforeach; ?>
