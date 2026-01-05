
<h1>Teste #<?= $model->id ?></h1>

<ul>
    <li><b>Paciente:</b> <?= $model->pessoa->nome ?></li>
    <li><b>Tipo:</b> <?= $model->tipoTeste->descricao ?></li>
    <li><b>Estado:</b> <?= $model->estado ?></li>
    <li><b>Laboratório:</b> <?= $model->laboratorio->nome ?? 'Por escolher' ?></li>
</ul>
