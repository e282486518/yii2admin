<?php

namespace backend\models;

use Yii;

/*
 * ---------------------------------------
 * 文章模型
 * ---------------------------------------
 */
class Article extends \common\models\Article
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /* 写库和更新库时，时间自动完成 */
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => time(),
            ],
        ];
    }
    
    
    
}
