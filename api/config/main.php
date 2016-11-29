<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => false,
    /* 模块 */
    'modules' => [
        /**
         * 这里我们用Module实现版本v1和v2
         */
        'v1' => [
            'class' => 'api\modules\v1\Module',
            'defaultRoute' => 'index',
        ],
        'v2' => [
            'class' => 'api\modules\v2\Module',
            'defaultRoute' => 'index'
        ],
    ],
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'api\models\User',
            'enableAutoLogin' => true, //开启自动登录
            'enableSession' => false, //关闭session
            'loginUrl' => null, //登录跳转地址为空
        ],
        /* 修改默认的request组件 */
        'request' => [
            'class' => 'common\core\Request',
            'baseUrl' => Yii::getAlias('@apiUrl'),
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

        'urlManager' => [
            'enablePrettyUrl' => env('API_PRETTY_URL', true),
            'showScriptName' => false,
            'enableStrictParsing' => false, // 是否启用严格解析，只有在rules中存在的才解析，开启容易出错
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['index','v1/user','v2/index'],
                    'pluralize' => false, //是否启用复数形式，注意index的复数indices，我认为开启后不直观
                ]

            ],
        ],

    ],
    'params' => $params,
];
