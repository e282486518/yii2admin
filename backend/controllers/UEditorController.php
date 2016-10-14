<?php

namespace backend\controllers;


use common\helpers\ArrayHelper;
use Yii;


/*
 * 百度编辑器(UEditor)控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class UEditorController extends \crazydb\ueditor\UEditorController
{
    public function init(){
        parent::init();
        //do something
        //这里可以对扩展的访问权限进行控制
    }

    /**
     * 显示配置信息
     */
    public function actionConfig()
    {
        return $this->show($this->config);
    }
    
    // more modify ...
    // 更多的修改
    
}