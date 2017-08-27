<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%goods_tag}}".
 *
 * @property integer $goods_id
 * @property integer $tag_id
 */
class GoodsTag extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'tag_id'], 'required'],
            [['goods_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => 'Goods ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
