<?php

namespace backend\controllers;

use Yii;

/**
 * 公共调用处理
 */
class PublicController extends \common\core\Controller{

    public $layout = false;

    /**
     * ---------------------------------------
     * 通用的404错误处理
     * @return string
     * ---------------------------------------
     */
    public function action404(){
        
        //渲染模板
        return $this->render('404');
    }



}
