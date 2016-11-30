<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * 3D幻灯片 jQuery CCSlider 插件
 */
class CcsliderAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'global/plugins/ccslider/css/ccslider.css',
        'global/plugins/ccslider/css/style.css',
    ];
    /* 全局JS文件 */
    public $js = [
        'global/plugins/ccslider/js/jquery-migrate-1.1.1.min.js',
        'global/plugins/ccslider/js/jquery.ccslider-3.0.2.min.js',
    ];
    /* 依赖关系 */
    public $depends = [
        'backend\assets\CoreAsset',
    ];
}
