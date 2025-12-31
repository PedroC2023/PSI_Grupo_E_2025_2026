<h1>Os meus testes</h1>

<?php foreach ($testes as $t): ?>
    <p>
        <?= $t->tipo_teste ?> —
        <?= $t->resultado ?? 'A aguardar resultado' ?>
        (<?= $t->data_teste ?>)
    </p>
<?php endforeach; ?>
