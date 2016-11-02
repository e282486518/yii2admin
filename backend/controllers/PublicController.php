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

    /**
     * ---------------------------------------
     * 地区操作
     * ---------------------------------------
     */
    public function actionRegion(){
        $parent_id = Yii::$app->request->post('depdrop_parents')[0];//var_dump($parent_id);
        $region = Region::find()->where(['parent_id'=>$parent_id])->orderBy('region_id ASC')->asArray()->all();
        foreach ($region as &$value) {
            $value['id']   = $value['region_id'];
            $value['name'] = $value['region_name'];
        }
        $out = ['output'=>$region, 'selected'=>$region[0]['region_id']];
        echo Json::encode($out);
    }

}
