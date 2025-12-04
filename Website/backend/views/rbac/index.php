<?php
use yii\grid\GridView;
use yii\helpers\Html;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'email',

        [
            'label' => 'Role',
            'value' => function($model) {
                $auth = Yii::$app->authManager;
                $roles = $auth->getRolesByUser($model->id);
                return implode(', ', array_keys($roles));
            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{role} {delete}',
            'buttons' => [
                'role' => function ($url, $model) {
                    return Html::a('Alterar Role', ['rbac/role', 'id' => $model->id]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('Eliminar', ['rbac/delete-user', 'id' => $model->id], [
                        'data-confirm' => 'Eliminar o utilizador e a sua pessoa?',
                        'data-method' => 'post',
                        'style' => 'color:red'
                    ]);
                },
            ],
        ],
    ],
]);
