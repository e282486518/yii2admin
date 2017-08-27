<?php

namespace backend\models;

use Yii;


class ArticleCat extends \common\modelsgii\ArticleCat
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /**
             * 写库和更新库时，时间自动完成
             * 注意rules验证必填时可使用AttributeBehavior行为，model的EVENT_BEFORE_VALIDATE事件
             */
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => time(),
            ],
        ];
    }
    
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
     * @return array|boolean
     * ---------------------------------------
     */
    public static function getOne($id){
        if (empty($id)) {
            return false;
        }
        return static::find()->where(['id'=>$id])->asArray()->one();
    }


}
