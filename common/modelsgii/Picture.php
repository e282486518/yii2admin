<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%picture}}".
 *
 * @property integer $id
 * @property string $path
 * @property string $md5
 * @property integer $create_time
 * @property integer $status
 */
class Picture extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'status'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['md5'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'md5' => 'Md5',
            'create_time' => 'Create Time',
            'status' => 'Status',
        ];
    }
}
