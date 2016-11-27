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
class FileinputAsset extends AssetBundle
{
    public $sourcePath = '@backend/metronic';
    /* 全局CSS文件 */
    public $css = [
        'global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
    ];
    /* 全局JS文件 */
    public $js = [];
    /* 选项 */
    //public $jsOptions = ['condition' => 'lt IE9'];
    /* 依赖关系 */
    public $depends = [
        'backend\assets\CoreAsset',
    ];
}
