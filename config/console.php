<?php
$db = require __DIR__.'/db.php';
$params = require __DIR__.'/params.php';

$config = [
    'id' => 'basic-console',
    'timeZone' => 'Asia/Jakarta',
    'language' => 'id-ID',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
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
