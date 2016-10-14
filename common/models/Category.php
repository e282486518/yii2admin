<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $pid
 * @property string $name
 * @property string $title
 * @property string $link
 * @property string $extend
 * @property string $meta_title
 * @property string $keywords
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 * @property integer $sort
 * @property integer $status
 */
class Category extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'create_time', 'update_time', 'sort', 'status'], 'integer'],
            [['name', 'title'], 'required'],
            [['extend'], 'string'],
            [['name'], 'string', 'max' => 30],
            [['title', 'meta_title'], 'string', 'max' => 50],
            [['link'], 'string', 'max' => 250],
            [['keywords', 'description'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'name' => 'Name',
            'title' => 'Title',
            'link' => 'Link',
            'extend' => 'Extend',
            'meta_title' => 'Meta Title',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}
