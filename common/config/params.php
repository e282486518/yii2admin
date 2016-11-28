<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    /* 上传的图片路径是否加密，配合 \common\helpers\Html::src()使用 */
    'storage_encrypt' => false,
    
    /* redis key 前缀 */
    'redisKey' => 'school_cache_',
    /* redis key 标识 */
    'redisKeyPre' => [
        'school'      => 'school',          //哈希类型 以school_id为键值，存储一个学校的所有信息
        'member'      => 'member',          //哈希类型 以uid为键值，一个用户信息
        'rank_school' => 'rank_school',     //哈希类型 以school_id为键值，所有学校贡献排名
        'rank_user'   => 'rank_user',       //哈希类型 以school_id为键值，一学校的用户贡献排名
        'renk_user_top1' => 'renk_user_top1'//哈希类型 以school_id为键值，一学校贡献第一名的用户
    ],
    /* redis key 生存时间 600秒 */
    'redisExpires' => 600,

    /* 上传文件 */
    'upload' => [
        'url'  => Yii::getAlias('@storageUrl/image/'),
        //'path' => Yii::getAlias('@base/web/storage/image/'), // 服务器解析到/web/目录时，上传到这里
        'path' => Yii::getAlias('@storage/web/image/'),
    ],

    /* UEditor编辑器配置 */
    'ueditorConfig' => [
        /* 图片上传配置 */
        'imageRoot'            => Yii::getAlias("@storage/web"), //图片path前缀
        //'imageRoot'            => Yii::getAlias("@base/web/storage"), //图片path前缀，服务器解析到/web/目录时，上传到这里
        'imageUrlPrefix'       => Yii::getAlias('@storageUrl'), //图片url前缀
        'imagePathFormat'      => '/image/{yyyy}{mm}/editor{time}{rand:6}',

        /* 文件上传配置 */
        'fileRoot'             => Yii::getAlias("@storage/web"), //文件path前缀
        //'fileRoot'             => Yii::getAlias("@base/web/storage"), //文件path前缀，服务器解析到/web/目录时，上传到这里
        'fileUrlPrefix'        => Yii::getAlias('@storageUrl'), //文件url前缀
        'filePathFormat'       => '/file/{yyyy}{mm}/editor{rand:4}_{filename}',

        /* 上传视频配置 */
        'videoRoot'            => Yii::getAlias("@storage/web"),
        //'videoRoot'            => Yii::getAlias("@base/web/storage"), // 服务器解析到/web/目录时，上传到这里
        "videoUrlPrefix"       => Yii::getAlias('@storageUrl'),
        'videoPathFormat'      => '/video/{yyyy}{mm}/editor{time}{rand:6}',

        /* 涂鸦图片上传配置项 */
        'scrawlRoot'           => Yii::getAlias("@storage/web"),
        //'scrawlRoot'           => Yii::getAlias("@base/web/storage"), // 服务器解析到/web/目录时，上传到这里
        "scrawlUrlPrefix"      => Yii::getAlias('@storageUrl'),
        'scrawlPathFormat'     => '/image/{yyyy}{mm}/editor{time}{rand:6}',
    ],

    /* 多语言配置 */
    'language' => [
        'zn-CN','zh-TW','en-US'
    ],

    /* 支付状态 */
    'pay_status' => [
        0 => '未支付',
        1 => '已支付'
    ],
    /* 支付类型 */
    'pay_type' => [
        1 => '微信',
        2 => '支付宝',
        3 => '银联',
        4 => '后台'
    ],
    /* 支付途径 */
    'pay_source' => [
        1 => '网站',
        2 => '微信',
        3 => '后台',
    ]
    
];
