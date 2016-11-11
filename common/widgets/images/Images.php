<?php

namespace common\widgets\images;

use Yii;
use yii\helpers\Url;
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
    public $url    = ''; // 上传地址

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
        /* 默认上传地址 */
        if ($this->url == '') {
            $this->url = Url::to(["public/uploadimage"]);
        }
        parent::init();
    }

    public function run(){
        $opt = [
            'model'     => $this->model,
            'attribute' => $this->attribute,
            'saveDB'    => $this->saveDB,
            'url'       => $this->url,
        ];
        return $this->render($this->type,$opt);
    }
}
