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
                'config' => Yii::$app->params['ueditorConfig'],
            ],
        ];
    }
    
}
