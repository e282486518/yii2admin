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
class ComponentsAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'global/css/components-md.min.css',
        'global/css/plugins-md.min.css',
    ];
    /* 全局JS文件 */
    public $js = [
    ];
    /* 依赖关系 */
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\grid\GridViewAsset'
    ];
}
