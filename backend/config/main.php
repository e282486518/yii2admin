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
    /**
     * 比较重要的属性，系统启动阶段(一般new application()最后)加载的组件或模块。
     * 如果该组件或模块实现BootstrapInterface接口，那么就会执行bootstrap()方法，yii/base/application类315行左右。
     * 应用案例：yii-debug扩展，或者设想我有个需求：在数据库中配置某些组件和模块的开启或关闭。这样可以不将这些组件或模块
     *         配置在config.php中，而写在数据库中，通过bootstrap()方法将这些组件模块动态加载到系统中。
     * 参考：http://www.yiichina.com/doc/guide/2.0/structure-applications#bootstrap
     */
    'bootstrap' => ['log'],
    /**
     * 模块
     */
    'modules' => [],
    /* 默认路由 */
    'defaultRoute' => 'index',
    /* 默认布局文件 优先级 控制器>配置文件>系统默认 */
    'layout' => 'main',
    /**
     * 组件
     */
    'components' => [
        /* 身份认证类 默认yii\web\user */
        'user' => [
            'class' => 'yii\web\User',
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
    /**
     * 该属性允许你用一个数组定义多个 别名 代替 Yii::setAlias()
     */
    'aliases' => [],
    /**
     * 通过配置文件附加行为，全局
     */
    'as rbac' => [
        'class' => 'backend\behaviors\RbacBehavior',
        'allowActions' => [
            'login/login','login/logout','public*','debug/*','gii/*', // 不需要权限检测
        ]
    ],

    'params' => $params,
];
