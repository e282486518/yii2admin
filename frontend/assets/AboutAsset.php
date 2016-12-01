<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * 关于我们相关页面 前端资源
 */
class AboutAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'pages/css/about.min.css',
    ];
    /* 全局JS文件 */
    public $js = [
    ];
    /* 依赖关系 */
    public $depends = [
        'backend\assets\CoreAsset',
    ];
}
