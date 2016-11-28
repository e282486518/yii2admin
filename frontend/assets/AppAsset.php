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
class AppAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    public $css = [

    ];
    public $js = [
        'global/scripts/app.min.js',
    ];
    public $depends = [
        'frontend\assets\CoreAsset',
    ];
}
