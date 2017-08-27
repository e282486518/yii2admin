<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $message_id
 * @property string $appid
 * @property integer $from_uid
 * @property integer $to_uid
 * @property string $content
 * @property integer $create_time
 * @property integer $is_read
 */
class Message extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appid', 'from_uid', 'to_uid', 'content', 'create_time'], 'required'],
            [['from_uid', 'to_uid', 'create_time', 'is_read'], 'integer'],
            [['appid'], 'string', 'max' => 30],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message_id' => 'Message ID',
            'appid' => 'Appid',
            'from_uid' => 'From Uid',
            'to_uid' => 'To Uid',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'is_read' => 'Is Read',
        ];
    }
}
