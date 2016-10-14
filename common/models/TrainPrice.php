<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%train_price}}".
 *
 * @property integer $id
 * @property integer $train_id
 * @property integer $day
 * @property string $price
 */
class TrainPrice extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%train_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['train_id', 'day', 'price'], 'required'],
            [['train_id', 'day'], 'integer'],
            [['price'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'train_id' => 'Train ID',
            'day' => 'Day',
            'price' => 'Price',
        ];
    }
}
