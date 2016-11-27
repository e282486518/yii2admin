<?php

require(__DIR__ . '/../../vendor/autoload.php');

require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

/**
 * 全局环境，必须放在yii.php之后和config文件之前
 * 因为里面用到Yii类，配置中又要用到env函数
 * 这个文件转到 composer.json -> autoload -> files -> common/env.php 中了
 */
//require(__DIR__ . '/../../common/env.php');

require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../../api/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../../api/config/main.php'),
    require(__DIR__ . '/../../api/config/main-local.php')
);

(new yii\web\Application($config))->run();