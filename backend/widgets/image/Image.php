<?php

namespace backend\widgets\image;

/**
 * 单图上传widgets
 */
class Image extends \yii\widgets\InputWidget
{

    /**
     * @var $data 数据
     */
    public $data;
    public $field;
    public $saveDB;
    public $title;
    public $tishi;

    public function init()
    {
        //$this->name = $this->field;
        
        parent::init();
    }

    public function run(){
        return $this->render('image',[
            'data'   => $this->data,
            'field'  => $this->field,
            'saveDB' => $this->saveDB,
            'title'  => $this->title,
            'tishi'  => $this->tishi,
        ]);
    }
}
