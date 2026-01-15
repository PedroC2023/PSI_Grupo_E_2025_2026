<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
    ],
    'components' => [        
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or PhpManager if you prefer
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => 'algo',
            'enableCsrfValidation' => false, // Desabilitar CSRF para APIs REST
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Regra para UserController
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/user',
                    'pluralize' => false
                ],
                // EVENTO (REST)
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/evento',
                    'pluralize' => false
                ],

                // MASTER / DETAIL
                'GET api/evento/<id:\d+>/participacoes' =>
                    'api/participacao-evento/index',

                'POST api/evento/<id:\d+>/participacoes' =>
                    'api/participacao-evento/create',                
//  <--------  usar ?access-token=qdXut46xKW-waAXTe-sLBgxfSAKex1W3 para testar - POST PUT DELETE GET - URLs  ---------->
                // Regra para PratoController com extraPatterns                
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'hail812\adminlte3\assets\AdminLteAsset' => [
                ],
            ],
        ],        
    ],
    'layout' => 'adminlte3',
    'params' => $params,
];