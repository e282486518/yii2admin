<?php

namespace backend\models;

use Yii;

/**
 * 图片处理模型
 *
 */
class Picture extends \common\models\Picture
{
    /**
     * ----------------------------------
     * 保存一张图片到数据库
     * @param $url string 图片路径
     * @return array
     * ----------------------------------
     */
    public static function savePic($url){
        $file_path = Yii::$app->params['upload']['path'].$url;
        $file_md5  = md5_file($file_path);
        $image = static::find()->where(['md5'=>$file_md5])->asArray()->one();
        if ($image) {
            unlink($file_path); // 图片已存在，删除该图片
            return $image;
        }
        $model = new Picture();
        $data['path'] = $url;
        $data['md5']  = $file_md5;
        $data['create_time'] = time();
        $data['status'] = 1;
        $model->setAttributes($data);
        if ($model->save()) {
            return $model->getAttributes();
        }
        return false;
    }

    /**
     * ---------------------------------------
     * 获取一张图片信息
     * @param $id int 图片ID
     * @return array
     * ---------------------------------------
     */
    public static function getPic($id){
        return static::find()->where(['id'=>$id])->asArray()->one();
    }

}
