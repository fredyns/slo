<?php

// init script
$init = __DIR__.'/../config/host/init.php';
if (file_exists($init)) {
    require $init;
}

// load config
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

// run app
(new yii\web\Application($config))->run();
