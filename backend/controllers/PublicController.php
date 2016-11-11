<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use common\models\Region;

/**
 * 公共调用处理
 */
class PublicController extends \common\core\Controller{

    public $layout = false;
    public $enableCsrfValidation=false;

    public function actions()
    {
        return \yii\helpers\ArrayHelper::merge(parent::actions(), [
            'region' => [
                'class' => \kartik\depdrop\DepDropAction::className(),
                'outputCallback' => function ($id, $params) {
                    $region = Region::find()->where(['parent_id'=>$id])->orderBy('region_id ASC')->asArray()->all();
                    $_out = [];//var_dump($region);
                    foreach ($region as $value) {
                        $_tmp['id']   = $value['region_id'];
                        $_tmp['name'] = $value['region_name'];
                        $_out[] = $_tmp;
                    }
                    return $_out;
                },
                'selectedCallback' => function($id, $params){
                    return Yii::$app->getRequest()->get('sid');
                }
            ],
            /* ueditor文件上传 */
            'ueditor' => [
                'class' => 'common\actions\UEditorAction',
                'config' => Yii::$app->params['ueditorConfig'],
            ],
            /* 单图、多图上传 */
            'uploadimage' => [
                'class' => 'common\widgets\images\UploadAction',
            ],
        ]);
    }

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
