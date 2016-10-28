<?php

namespace backend\models;

use Yii;


class Category extends \common\models\Category
{
    
    /**
     * ---------------------------------------
     * 递归获取其所有父栏目
     * @param $id int 菜单ID
     * @return array
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

    /**
     * ---------------------------------------
     * 获取一条数据
     * @param $id int
     * @return array
     * ---------------------------------------
     */
    public static function getOne($id){
        if (empty($id)) {
            return false;
        }
        return static::find()->where(['id'=>$id])->asArray()->one();
    }


}
