<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%goods_attribute}}".
 *
 * @property integer $attr_id
 * @property string $attr_name
 * @property integer $attr_type
 * @property string $attr_values
 * @property integer $sort
 */
class GoodsAttribute extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attr_type', 'sort'], 'integer'],
            [['attr_values'], 'required'],
            [['attr_values'], 'string'],
            [['attr_name'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attr_id' => 'Attr ID',
            'attr_name' => 'Attr Name',
            'attr_type' => 'Attr Type',
            'attr_values' => 'Attr Values',
            'sort' => 'Sort',
        ];
    }
}
