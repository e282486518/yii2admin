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
class Select2Asset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'global/plugins/select2/css/select2.min.css',
        'global/plugins/select2/css/select2-bootstrap.min.css',
    ];
    /* 全局JS文件 */
    public $js = [
        'global/plugins/select2/js/select2.full.min.js',
        'pages/scripts/components-select2.min.js',
    ];
    /* 依赖关系 */
    public $depends = [
        'backend\assets\CoreAsset',
    ];
}
