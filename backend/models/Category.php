<?php

namespace backend\models;

use Yii;


class Category extends \common\models\Category
{
    
    /*
     * ---------------------------------------
     * 递归获取其所有父栏目
     * @param  int    $id  菜单ID
     * @return json   返回信息
     * ---------------------------------------
     */
    public static function getParents($id){
        $path = [];
        $nav = static::find()->select(['id','pid','title'])->where(['id'=>$id])->asArray()->one();
        $path[] = $nav;
        if($nav['pid'] > 0){
            $path = array_merge(static::getParents($nav['pid']),$path);
        }
        return $path;
    }

    /*
     * ---------------------------------------
     * 获取一条数据
     * @param  int    $id  参数信息
     * @return json   返回信息
     * ---------------------------------------
     */
    public static function getOne($id){
        if (empty($id)) {
            return false;
        }
        return static::find()->where(['id'=>$id])->asArray()->one();
    }


}
