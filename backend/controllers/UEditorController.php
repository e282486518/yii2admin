<?php

namespace backend\controllers;


use common\helpers\ArrayHelper;
use Yii;


/*
 * 百度编辑器(UEditor)控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class UeditorController extends \common\core\Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\actions\UEditorAction',
                'config' => [
                    /* path路径前缀 */
                    'imageRoot'  => Yii::getAlias("@storage").'/web',
                    'scrawlRoot' => Yii::getAlias("@storage").'/web',
                    'videoRoot'  => Yii::getAlias("@storage").'/web',
                    'fileRoot'   => Yii::getAlias("@storage").'/web',

                    /* url图片访问路径前缀 */
                    'imageUrlPrefix'       => Yii::getAlias('@storageUrl'),

                    /* 上传图片路径 */
                    'imagePathFormat'      => '/image/{yyyy}{mm}/{time}{rand:6}',
                    'scrawlPathFormat'     => '/image/{yyyy}{mm}/{time}{rand:6}',
                    'snapscreenPathFormat' => '/image/{yyyy}{mm}/{time}{rand:6}',
                    'catcherPathFormat'    => '/image/{yyyy}{mm}/{time}{rand:6}',
                    'videoPathFormat'      => '/video/{yyyy}{mm}/{time}{rand:6}',
                    'filePathFormat'       => '/file/{yyyy}{mm}/{rand:4}_{filename}',
                    'imageManagerListPath' => '/image/',
                    'fileManagerListPath'  => '/file/',
                ],
            ],

        ];
    }
    
}