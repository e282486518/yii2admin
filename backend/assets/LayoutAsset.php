<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LayoutAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'global/css/components-md.min.css',
        //'global/css/components-rounded.min.css',
        'global/css/plugins-md.min.css',
        //'global/css/plugins.min.css',

        'layouts/layout/css/layout.min.css',
        'layouts/layout/css/themes/darkblue.min.css',
        'layouts/layout/css/custom.min.css',
    ];
    /* 全局JS文件 */
    public $js = [
        'layouts/layout/scripts/layout.min.js',
        'layouts/layout/scripts/demo.min.js',
        'layouts/global/scripts/quick-sidebar.min.js',

        'other/js/common.js'
    ];
    /* 选项 */
    //public $jsOptions = ['condition' => 'lt IE9'];
    /* 依赖关系 */
    public $depends = [
        'backend\assets\CoreAsset',
    ];
}
