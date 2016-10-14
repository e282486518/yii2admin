<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property string $category_id
 * @property string $name
 * @property string $title
 * @property string $cover
 * @property string $description
 * @property string $content
 * @property string $extend
 * @property integer $type
 * @property integer $position
 * @property string $link
 * @property integer $sort
 * @property string $create_time
 * @property string $update_time
 * @property integer $status
 */
class Article extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'content'], 'required'],
            [['category_id', 'type', 'position', 'sort', 'create_time', 'update_time', 'status'], 'integer'],
            [['content', 'extend'], 'string'],
            [['name'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 80],
            [['cover', 'link'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 140]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'title' => 'Title',
            'cover' => 'Cover',
            'description' => 'Description',
            'content' => 'Content',
            'extend' => 'Extend',
            'type' => 'Type',
            'position' => 'Position',
            'link' => 'Link',
            'sort' => 'Sort',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
        ];
    }
}
