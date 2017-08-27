<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $title
 * @property integer $cover
 * @property string $description
 * @property string $content
 * @property string $extend
 * @property string $link
 * @property integer $up
 * @property integer $down
 * @property integer $view
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
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
            [['category_id', 'cover', 'up', 'down', 'view', 'sort', 'create_time', 'update_time', 'status'], 'integer'],
            [['content', 'extend'], 'string'],
            [['name'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 80],
            [['description'], 'string', 'max' => 140],
            [['link'], 'string', 'max' => 255],
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
            'link' => 'Link',
            'up' => 'Up',
            'down' => 'Down',
            'view' => 'View',
            'sort' => 'Sort',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
        ];
    }
}
