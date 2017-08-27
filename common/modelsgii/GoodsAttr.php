<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%goods_attr}}".
 *
 * @property integer $goods_attr_id
 * @property integer $goods_id
 * @property integer $attr_id
 * @property string $attr_value
 * @property string $attr_price
 */
class GoodsAttr extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_attr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'attr_id'], 'integer'],
            [['attr_value'], 'required'],
            [['attr_value'], 'string'],
            [['attr_price'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_attr_id' => 'Goods Attr ID',
            'goods_id' => 'Goods ID',
            'attr_id' => 'Attr ID',
            'attr_value' => 'Attr Value',
            'attr_price' => 'Attr Price',
        ];
    }
}
