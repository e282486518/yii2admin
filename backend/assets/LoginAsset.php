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
class LoginAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'global/css/components-rounded.min.css',
        'global/css/plugins.min.css',
        'pages/css/login.min.css',
    ];
    /* 全局JS文件 */
    public $js = [
        'global/plugins/jquery-validation/js/jquery.validate.min.js',
        'global/plugins/jquery-validation/js/additional-methods.min.js',
        'global/plugins/select2/js/select2.full.min.js',
        'pages/scripts/jquery.form.js',
        'pages/scripts/login.js',
    ];
    /* 依赖关系 */
    public $depends = [
        'backend\assets\CoreAsset',
    ];
}
