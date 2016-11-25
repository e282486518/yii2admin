<?php
/**
 * 扩展的Yii类映射，这种对已有项目的扩展YII核心类/自定义类比较好用
 * 在不改动yii2文件和现有文件的前提下，可以重写任何文件
 *
 * 例子：
 * Yii::$classMap['yii\helpers\Html'] = '@common/helpers/Html.php';
 *
 * 使用要注意common/helpers/Html.php命名空间必须和Yii::$classMap的key对应
 * 这样，已有项目中yii\helpers\Html实际调用的是新扩展的common/helpers/Html
 * 从而在不改变现有任何代码的基础之上扩展了功能
 */
//Yii::$classMap['yii\helpers\Html'] = '@common/helpers/Html.php';

/* 设置 path 别名 */
Yii::setAlias('@base', dirname(dirname(__DIR__))); //项目根目录path
Yii::setAlias('@common', dirname(__DIR__)); //公共目录path
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend'); //后台path
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend'); // 前台path
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console'); //命令行path
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api'); //API的path
Yii::setAlias('@storage', dirname(dirname(__DIR__)) . '/storage'); //存储目录path

/* 设置 url 别名 */
Yii::setAlias('@backendUrl', env('BACKEND_URL')); //后台url
Yii::setAlias('@frontendUrl', env('FRONTEND_URL')); //前台url
Yii::setAlias('@apiUrl', env('API_URL')); //API的url
Yii::setAlias('@storageUrl', env('STORAGE_URL')); //存储url