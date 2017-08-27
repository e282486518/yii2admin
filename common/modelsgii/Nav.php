<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%nav}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $pid
 * @property integer $sort
 * @property integer $status
 */
class Nav extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nav}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sort', 'status'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'pid' => 'Pid',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}
