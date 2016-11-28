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
class AppAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [];
    /* 全局JS文件 */
    public $js = [];
    /* 选项 */
    //public $jsOptions = ['condition' => 'lt IE9'];
    /* 依赖关系 */
    public $depends = [
        'backend\assets\IeAsset',
        'backend\assets\CoreAsset',
        //'backend\assets\LayoutAsset', //因为加载顺序，这个放到了main.php的endBody()前手动加载了，不然某些样式会被覆盖
    ];

    /**
     * ------------------------------------------
     * 定义按需加载JS方法，注意加载顺序在最后
     * @param $view \yii\web\View
     * @param $jsfile string
     * ------------------------------------------
     */
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }

    /**
     * ------------------------------------------
     * 定义按需加载css方法，注意加载顺序在最后
     * @param $view \yii\web\View
     * @param $cssfile string
     * ------------------------------------------
     */
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
}
