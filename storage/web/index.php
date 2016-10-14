<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');

// Composer
require(__DIR__ . '/../../vendor/autoload.php');

// Yii
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

// Bootstrap
require(__DIR__ . '/../../common/config/bootstrap.php');

// App Config
$config = require(__DIR__ . '/../config/base.php');

(new yii\web\Application($config))->run();
