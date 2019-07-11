<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__.'/db.php';

$config = [
    'id' => 'basic',
    'language'=>'ru-RU',
    'basePath' => dirname(__DIR__),
    'defaultRoute'=>'main',
    'bootstrap' => ['log','queue'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@webroot'=>'web/'
    ],
    'modules' => [
        'user' => [
            'class' => 'app\modules\auth\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ]
    ],
    'components' => [
        'redis'=>[
            'class'=>\yii\redis\Connection::class,
            'port'=>6379,
            'hostname'=>'localhost',
            'database'=>0
        ],
        'queue'=>[
            'class'=>\yii\queue\redis\Queue::class,
            'as log'=>\yii\queue\LogBehavior::class,
            'redis'=>'redis'
        ],
        'authComp'=>[
            'class'=>\app\components\AuthComponent::class,
            'model'=>'\app\models\Users'
        ],
        'rbac'=>[
            'class'=>\app\components\RbacComponent::class
        ],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'GiafTRWHn515BsdPmINcg1By6uvU0QAZ',
            'parsers'=>[
                'application/json'=>'yii\web\JsonParser'
            ]
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis'=> 'redis'
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'main/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport'=>[
                'class'=>'Swift_SmtpTransport',
                'host'=>'smtp.yandex.ru',
                'username'=>'*',
                'password'=>'*',
                'port'=>587,
                'encryption'=>'tls'
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                'class'=>'yii\rest\UrlRule',
                'controller'=>'rest',
                'pluralize'=>false
                ],
            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*']
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
