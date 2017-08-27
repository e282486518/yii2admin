<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%message_sys}}".
 *
 * @property integer $sys_id
 * @property integer $uid
 * @property integer $message_id
 * @property integer $is_read
 */
class MessageSys extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message_sys}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'message_id'], 'required'],
            [['uid', 'message_id', 'is_read'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sys_id' => 'Sys ID',
            'uid' => 'Uid',
            'message_id' => 'Message ID',
            'is_read' => 'Is Read',
        ];
    }
}
