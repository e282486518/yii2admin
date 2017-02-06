<?php

// Composer
require(__DIR__ . '/../../vendor/autoload.php');

// Yii
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

/**
 * 全局环境，必须放在yii.php之后和config文件之前
 * 因为里面用到Yii类，配置中又要用到env函数.
 */
require(__DIR__ . '/../../common/env.php');

// Bootstrap
require(__DIR__ . '/../../common/config/bootstrap.php');

// App Config
$config = require(__DIR__ . '/../config/base.php');

(new yii\web\Application($config))->run();
