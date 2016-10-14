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
            'identityClass' => 'backend\models\Admin',
            'enableAutoLogin' => true,
            'loginUrl' => ['login/login'], //默认登录url
        ],
        /* 修改默认的request组件 */
        'request' => [
            'class' => 'common\core\Request',
            'baseUrl' => '/admin', //等于 Yii::getAlias('@web')
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
            'enablePrettyUrl' => true, //开启url规则
            'showScriptName' => false,  //是否显示链接中的index.php
            //'suffix' => '.html', //后缀
            'rules' => [
                //
            ],
        ],
        

        /* 覆盖布局文件layout默认的jQuery/bootstrap/js/css解决其不兼容问题 */
        'assetManager'=>[
            'bundles'=>[
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ],
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => []
                ],
            ],

        ],
    ],

    /* 控制器映射 */
    'controllerMap' => [
        /* 编辑器映射 */
        'ueditor' => [
            'class' => 'backend\controllers\UEditorController',
            'thumbnail' => false,//如果将'thumbnail'设置为空，将不生成缩略图。
            'watermark' => [    //默认不生存水印
                'path' => '', //水印图片路径
                'position' => 9 //position in [1, 9]，表示从左上到右下的 9 个位置，即如1表示左上，5表示中间，9表示右下。
            ],
            'zoom' => ['height' => 500, 'width' => 500], //缩放，默认不缩放
            'config' => [
                //server config @see http://fex-team.github.io/ueditor/#server-config
                //'imageUrlPrefix'       => '',
                'imagePathFormat'      => '/storage/web/image/{yyyy}{mm}/{time}{rand:6}',
                'scrawlPathFormat'     => '/storage/web/image/{yyyy}{mm}/{time}{rand:6}',
                'snapscreenPathFormat' => '/storage/web/image/{yyyy}{mm}/{time}{rand:6}',
                'catcherPathFormat'    => '/storage/web/image/{yyyy}{mm}/{time}{rand:6}',
                'videoPathFormat'      => '/storage/web/video/{yyyy}{mm}/{time}{rand:6}',
                'filePathFormat'       => '/storage/web/file/{yyyy}{mm}/{rand:4}_{filename}',
                'imageManagerListPath' => '/storage/web/image/',
                'fileManagerListPath'  => '/storage/web/file/',
            ]
        ]
    ],
    'params' => $params,
];
