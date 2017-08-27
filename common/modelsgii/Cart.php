<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property integer $rec_id
 * @property integer $uid
 * @property integer $goods_id
 * @property string $goods_sn
 * @property string $goods_name
 * @property string $market_price
 * @property string $goods_price
 * @property integer $goods_number
 * @property string $goods_attr
 */
class Cart extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'goods_id', 'goods_number'], 'integer'],
            [['market_price', 'goods_price'], 'number'],
            [['goods_attr'], 'required'],
            [['goods_attr'], 'string'],
            [['goods_sn'], 'string', 'max' => 60],
            [['goods_name'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rec_id' => 'Rec ID',
            'uid' => 'Uid',
            'goods_id' => 'Goods ID',
            'goods_sn' => 'Goods Sn',
            'goods_name' => 'Goods Name',
            'market_price' => 'Market Price',
            'goods_price' => 'Goods Price',
            'goods_number' => 'Goods Number',
            'goods_attr' => 'Goods Attr',
        ];
    }
}
