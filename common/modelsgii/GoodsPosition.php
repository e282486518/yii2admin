<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%goods_position}}".
 *
 * @property integer $goods_id
 * @property integer $position_id
 */
class GoodsPosition extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'position_id'], 'required'],
            [['goods_id', 'position_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => 'Goods ID',
            'position_id' => 'Position ID',
        ];
    }
}
