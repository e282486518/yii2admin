<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $id
 * @property string $appid
 * @property integer $uid
 * @property integer $content
 * @property integer $to_comment
 * @property integer $up
 * @property integer $down
 * @property integer $create_time
 * @property integer $status
 */
class Comment extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appid', 'uid', 'content', 'to_comment', 'create_time'], 'required'],
            [['uid', 'content', 'to_comment', 'up', 'down', 'create_time', 'status'], 'integer'],
            [['appid'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'appid' => 'Appid',
            'uid' => 'Uid',
            'content' => 'Content',
            'to_comment' => 'To Comment',
            'up' => 'Up',
            'down' => 'Down',
            'create_time' => 'Create Time',
            'status' => 'Status',
        ];
    }
}
