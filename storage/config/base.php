<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php')
);

return [
    'id' => 'storage',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'glide/index',
    'controllerMap' => [
        'glide' => '\common\glide\GlideController'
    ],
    'components' => [
        'urlManager'=>[
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl'=>true,
            'showScriptName'=>false,
            'rules'=> [
                ['pattern'=>'cache/<path:(.*)>', 'route'=>'glide/index', 'encodeParams' => true]
            ],
        ],
        'glide' => [
            'class' => 'trntv\glide\components\Glide',
            'sourcePath' => '@storage/web/image',
            'cachePath' => '@storage/cache',
            'maxImageSize' => 4000000,
            'signKey' => false
        ]
    ],
    'params' => $params,
];
