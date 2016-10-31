<?php

namespace backend\widgets\images;

use Yii;
use yii\helpers\Html;
use yii\widgets\InputWidget;
use yii\base\InvalidConfigException;

/**
 * 单图上传widgets
 */
class Images extends InputWidget
{
    const TYPE_IMAGE  = 'image'; // 单图
    const TYPE_IMAGES = 'images'; // 多图

    public $type   = self::TYPE_IMAGE; //默认为单图
    public $saveDB = 1; // 是否保存到picture数据表

    public function init()
    {
        /* 类型判断 */
        if ($this->type != self::TYPE_IMAGE && $this->type != self::TYPE_IMAGES) {
            throw new InvalidConfigException("Images 'type' error ,his value self::TYPE_IMAGE or self::TYPE_IMAGES");
        }
        /* 是否保存到数据 */
        if (!in_array($this->saveDB ,[0,1])) {
            throw new InvalidConfigException("Images 'saveDB' = 0 or 1");
        }
        parent::init();
    }

    public function run(){
        $opt = [
            'model'     => $this->model,
            'attribute' => $this->attribute,
            'saveDB'    => $this->saveDB,
        ];
        return $this->render($this->type,$opt);
    }
}
