<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%shop}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $title
 * @property string $description
 * @property string $cover
 * @property string $images
 * @property string $imagess
 * @property integer $num
 * @property string $price
 * @property string $extend
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
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
            [['price'], 'number'],
            [['extend'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['description', 'cover', 'images', 'imagess'], 'string', 'max' => 255]
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
            'imagess' => 'Imagess',
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
