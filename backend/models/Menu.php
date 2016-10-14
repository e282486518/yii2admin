<?php

namespace backend\models;

use Yii;


class Menu extends \common\models\Menu
{
    /**
     * 配置model规则
     */
    public function rules()
    {
        return [
            [['title','url'],'required'],
            [['pid', 'sort', 'hide', 'status'], 'integer'],
            [['title', 'group'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /*
     * ---------------------------------------
     * 递归获取其所有父栏目
     * @param  int    $id  菜单ID
     * @return json   返回信息
     * ---------------------------------------
     */
    public static function getParentMenus($id){
        $path = [];
        $nav = static::find()->select(['id','pid','title'])->where(['id'=>$id])->asArray()->one();
        $path[] = $nav;
        if($nav['pid'] > 0){
            $path = array_merge(static::getParentMenus($nav['pid']),$path);
        }
        return $path;
    }


}
