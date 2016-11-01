<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use console\models\Picture;

/*
 * 图片处理控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class PictureController extends Controller
{
    /*
     * ---------------------------------------
     * 清除多余的图片文件
     * ---------------------------------------
     */
    public function actionClear()
    {
        Picture::clearPic(Yii::$app->params['upload']['path']);
        return static::EXIT_CODE_NORMAL;
    }

    /*
     * ---------------------------------------
     * 清除多余的图片文件
     * ---------------------------------------
     */
    public function actionClear1()
    {
        Picture::clearPic1();
        return static::EXIT_CODE_NORMAL;
    }

}
