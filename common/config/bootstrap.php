<?php
/* 设置 path 别名 */
Yii::setAlias('@base', dirname(dirname(__DIR__)));
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
/* 存储目录 */
Yii::setAlias('@storage', dirname(dirname(__DIR__)) . '/storage');

/* 设置 url 别名 */
Yii::setAlias('@backendUrl', '/admin');
Yii::setAlias('@frontendUrl', '');
Yii::setAlias('@storageUrl', 'http://www.yii2.cn/storage/web');