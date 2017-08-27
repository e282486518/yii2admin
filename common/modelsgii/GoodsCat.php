<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%goods_cat}}".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $name
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $sort
 * @property integer $status
 */
class GoodsCat extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_cat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'create_time', 'update_time', 'sort', 'status'], 'integer'],
            [['name', 'title'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 50],
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
            'keywords' => 'Keywords',
            'description' => 'Description',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}
