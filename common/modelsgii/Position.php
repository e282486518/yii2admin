<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%position}}".
 *
 * @property integer $position_id
 * @property string $name
 */
class Position extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id', 'name'], 'required'],
            [['position_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => 'Position ID',
            'name' => 'Name',
        ];
    }
}
