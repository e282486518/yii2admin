<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%shop}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $title
 * @property string $description
 * @property string $cover
 * @property string $images
 * @property integer $num
 * @property string $price
 * @property string $extend
 * @property integer $sort
 * @property string $create_time
 * @property string $update_time
 * @property integer $status
 */
class Shop extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'title', 'images', 'num', 'price'], 'required'],
            [['type', 'num', 'sort', 'create_time', 'update_time', 'status'], 'integer'],
            [['images', 'extend'], 'string'],
            [['price'], 'number'],
            [['title'], 'string', 'max' => 100],
            [['description', 'cover'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'title' => 'Title',
            'description' => 'Description',
            'cover' => 'Cover',
            'images' => 'Images',
            'num' => 'Num',
            'price' => 'Price',
            'extend' => 'Extend',
            'sort' => 'Sort',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
        ];
    }
}
