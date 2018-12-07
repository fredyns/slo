<?php
// load host config

$host_config_path = __DIR__.'/../config/host/web.php';
$host_config_exist = file_exists($host_config_path);

if ($host_config_exist) {
    $host_config = require $host_config_path;
}

// load main app config

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__.'/../config/web.php';

// merge config

if ($host_config_exist) {
    $config = yii\helpers\ArrayHelper::merge($config, $host_config);
}

// run app

(new yii\web\Application($config))->run();
