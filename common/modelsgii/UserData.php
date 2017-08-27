<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%user_data}}".
 *
 * @property string $uid
 * @property integer $type
 * @property string $target_id
 */
class UserData extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'type', 'target_id'], 'required'],
            [['uid', 'type', 'target_id'], 'integer'],
            [['uid', 'type', 'target_id'], 'unique', 'targetAttribute' => ['uid', 'type', 'target_id'], 'message' => 'The combination of Uid, Type and Target ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'type' => 'Type',
            'target_id' => 'Target ID',
        ];
    }
}
