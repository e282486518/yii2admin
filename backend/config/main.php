<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    /* 控制器默认命名空间 */
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    /* 默认路由 */
    'defaultRoute' => 'index',
    /* 默认布局文件 优先级 控制器>配置文件>系统默认 */
    'layout' => 'abc',

    'components' => [
        /* 身份认证类 默认yii\web\user */
        'user' => [
            'class' => 'yii\web\user',
            'identityClass' => 'backend\models\Admin',
            'enableAutoLogin' => true,
            'loginUrl' => ['login/login'], //默认登录url
        ],
        /* 修改默认的request组件 */
        'request' => [
            'class' => 'common\core\Request',
            'baseUrl' => Yii::getAlias('@backendUrl'), //等于 Yii::getAlias('@web')
        ],
        /* 数据库RBAC权限控制 */
        'authManager' => [
            'class' => 'common\core\rbac\DbManager',
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
        'errorHandler' => [
            //'errorAction' => 'public/404',
        ],

        /* 链接管理 */
        'urlManager' => [
            'class' => 'common\core\UrlManager',
            'enablePrettyUrl' => env('BACKEND_PRETTY_URL', true), //开启url规则
            'showScriptName' => false,  //是否显示链接中的index.php
            //'suffix' => '.html', //后缀
            'rules' => [
                //
            ],
        ],
        /* 多语言管理 */
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath'=>'@common/messages',
                    'fileMap' => ['app' => 'backend.php'],
                    'on missingTranslation' => ['\backend\modules\i18n\Module', 'missingTranslation']
                ],
            ],
        ],

        /**
         * 这里要注意了，由于我使用的是模板自带的jQuery和bootstrap，所以这里就先清空系统的jQuery和bootstrap
         * 基本上所有的插件都是使用了yii\web\JqueryAsset，
         * 为了模板全局的js/css放在其他插件的前面，这里我设置了yii\web\JqueryAsset依赖backend\assets\AppAsset
         */
        'assetManager'=>[
            'bundles'=>[
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [],
                    'depends' => [
                        'backend\assets\AppAsset'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ],
            ],

        ],
    ],


    'params' => $params,
];
