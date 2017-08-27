<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property string $id
 * @property string $title
 * @property string $pid
 * @property string $sort
 * @property string $url
 * @property integer $hide
 * @property string $group
 * @property integer $status
 */
class Menu extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sort', 'hide', 'status'], 'integer'],
            [['title', 'group'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'pid' => 'Pid',
            'sort' => 'Sort',
            'url' => 'Url',
            'hide' => 'Hide',
            'group' => 'Group',
            'status' => 'Status',
        ];
    }
}
