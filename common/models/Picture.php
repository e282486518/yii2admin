<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%picture}}".
 *
 * @property string $id
 * @property string $path
 * @property string $url
 * @property string $md5
 * @property string $sha1
 * @property string $create_time
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
            [['path', 'url'], 'string', 'max' => 255],
            [['md5'], 'string', 'max' => 32],
            [['sha1'], 'string', 'max' => 40]
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
            'url' => 'Url',
            'md5' => 'Md5',
            'sha1' => 'Sha1',
            'create_time' => 'Create Time',
            'status' => 'Status',
        ];
    }
}
