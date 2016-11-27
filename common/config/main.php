<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-cn', // 设置默认语言
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        /* 多语言管理 */
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath'=>'@common/messages',
                    'fileMap' => ['app' => 'backend.php'],
                ],
            ],
        ],
    ],
];
