<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * 文章列表或搜索列表 前端资源
 */
class SearchAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'pages/css/search.min.css',
    ];
    /* 全局JS文件 */
    public $js = [
    ];
    /* 依赖关系 */
    public $depends = [
        'backend\assets\CoreAsset',
    ];
}
