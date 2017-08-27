<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%ad}}".
 *
 * @property integer $id
 * @property string $image
 * @property integer $type
 * @property string $title
 * @property string $url
 * @property integer $sort
 * @property integer $status
 */
class Ad extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'type'], 'required'],
            [['type', 'sort', 'status'], 'integer'],
            [['image', 'url'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'type' => 'Type',
            'title' => 'Title',
            'url' => 'Url',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}
