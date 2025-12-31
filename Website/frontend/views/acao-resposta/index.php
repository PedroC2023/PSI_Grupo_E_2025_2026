<?php

use common\models\AcaoResposta;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>

<h2>Ações / Respostas</h2>

<?= Html::a('Nova Ação', ['create', 'eventoId' => Yii::$app->request->get('eventoId')], ['class' => 'btn btn-success']) ?>

<ul>
<?php foreach ($acoes as $acao): ?>
    <div class="card mb-2">
        <div class="card-body">
            <strong><?= Html::encode($acao->tipoAcao->descricao) ?></strong><br>
            <?= nl2br(Html::encode($acao->resposta)) ?><br>
            <small><?= Yii::$app->formatter->asDatetime($acao->data_acao) ?></small>
        </div>
    </div>
<?php endforeach; ?>

</ul>

