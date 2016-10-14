<?php

namespace backend\controllers;

use Yii;

/**
 * 数据库备份还原控制器
 */
class PublicController extends \common\core\Controller{

    public $layout = false;
    
    /**
     * 数据库备份/还原列表
     * @param  String $type import-还原，export-备份
     * @return String
     */
    public function action404(){
        
        //渲染模板
        return $this->render('404');
    }



}
