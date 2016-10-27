<?php
namespace backend\controllers;

use Yii;

/**
 * 上传图片控制器
 */
class UploadController extends \common\core\Controller
{
    public $enableCsrfValidation=false;
    public function actions()
    {
        return [
            'image' => [
                'class' => 'common\actions\UploadAction',
            ],
        ];
    }

}
