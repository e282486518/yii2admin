<?php

namespace backend\models;

use Yii;

/**
 * ---------------------------------------
 * 文章模型
 * ---------------------------------------
 */
class Order extends \common\modelsgii\Order
{

    public function rules()
    {
        return [
            [['order_sn', 'type', 'aid', 'title', 'start_time', 'end_time', 'pay_time', 'create_time', 'status'], 'required'],
            [['uid', 'aid', 'province', 'city', 'area', 'num', 'pay_status', 'pay_time', 'pay_type', 'pay_source', 'create_time', 'status'], 'integer'],
            [['order_sn', 'type'], 'string', 'max' => 10],
            [['title'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 30],
            [['tel'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /* 在rules验证前，时间自动完成 */
            [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    static::EVENT_BEFORE_VALIDATE => 'create_time',
                ],
                'value' => time(),
            ],
        ];
    }
}
