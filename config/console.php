<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','queue'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
        '@noreply'=> '*'
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
        'authComp'=>[
            'class'=>\app\components\AuthComponent::class,
            'model'=>'\app\models\Users'
        ],
        'authManager' => [
            'class'=>'yii\rbac\DbManager'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'rbac'=>[
            'class'=>\app\components\RbacComponent::class
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'scriptUrl' => 'localhost',
            'baseUrl'=>'localhost',
            'hostInfo'=>'',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
