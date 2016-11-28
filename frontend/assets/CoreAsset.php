<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CoreAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        'global/plugins/font-awesome/css/font-awesome.min.css',
        'global/plugins/simple-line-icons/simple-line-icons.min.css',
        'global/plugins/bootstrap/css/bootstrap.min.css',
        'global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
    ];
    /* 全局JS文件 */
    public $js = [
        'global/plugins/jquery.min.js',
        'global/plugins/bootstrap/js/bootstrap.min.js',
        'global/plugins/js.cookie.min.js',
        'global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'global/plugins/jquery.blockui.min.js',
        'global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    ];
    /* 依赖关系 */
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\grid\GridViewAsset'
    ];
}
