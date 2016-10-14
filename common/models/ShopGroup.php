<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%shop_group}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $cover
 * @property string $images
 * @property string $groups
 * @property string $price
 * @property string $total
 * @property integer $sort
 * @property integer $status
 */
class ShopGroup extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'images', 'groups', 'price'], 'required'],
            [['images', 'groups'], 'string'],
            [['price', 'total'], 'number'],
            [['sort', 'status'], 'integer'],
            [['title'], 'string', 'max' => 50],
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
            'title' => 'Title',
            'description' => 'Description',
            'cover' => 'Cover',
            'images' => 'Images',
            'groups' => 'Groups',
            'price' => 'Price',
            'total' => 'Total',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}
