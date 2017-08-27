<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $content
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 */
class Page extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title', 'content'], 'required'],
            [['content'], 'string'],
            [['create_time', 'update_time', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
        ];
    }
}
