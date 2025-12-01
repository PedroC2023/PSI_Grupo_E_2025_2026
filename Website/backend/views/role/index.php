<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Gestão de Roles";
?>

<h1><?= $this->title ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'email',
        [
            'label' => 'Role Atual',
            'value' => function($model) {
                $roles = Yii::$app->authManager->getRolesByUser($model->id);
                return count($roles) ? array_keys($roles)[0] : '(sem role)';
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'buttons' => [
                'update' => function($url, $model) {
                    return Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                }
            ],
        ],
    ],
]); ?>

