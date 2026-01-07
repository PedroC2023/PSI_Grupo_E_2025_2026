<?php

return [
    'id' => 'app-frontend-tests',
    'basePath' => dirname(__DIR__),
    'components' => [

        'cache' => [
            'class' => yii\caching\DummyCache::class,
        ],

        'session' => [
            'class' => yii\web\Session,
            'name' => 'frontend-test-session',
            'useCookies' => false,
        ],

        'request' => [
            'cookieValidationKey' => 'test-key',
            'enableCsrfValidation' => false,
        ],
    ],
];

