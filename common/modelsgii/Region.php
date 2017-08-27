<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property integer $code
 * @property integer $parent_code
 * @property string $name
 * @property string $fullname
 * @property integer $level
 */
class Region extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'parent_code', 'fullname', 'level'], 'required'],
            [['code', 'parent_code', 'level'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['fullname'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'parent_code' => 'Parent Code',
            'name' => 'Name',
            'fullname' => 'Fullname',
            'level' => 'Level',
        ];
    }
}
