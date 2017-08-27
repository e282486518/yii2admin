<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%article_cat}}".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $name
 * @property string $title
 * @property string $link
 * @property string $extend
 * @property string $meta_title
 * @property string $keywords
 * @property string $description
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $sort
 * @property integer $status
 */
class ArticleCat extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_cat}}';
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
            [['name'], 'unique'],
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
