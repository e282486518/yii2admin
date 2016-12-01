<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * 用户中心 前端资源
 */
class UserAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'pages/css/profile.min.css',
        'apps/css/ticket.min.css',
    ];
    /* 全局JS文件 */
    public $js = [
        
    ];
    /* 依赖关系 */
    public $depends = [
        'backend\assets\CoreAsset',
    ];
}
