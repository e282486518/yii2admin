<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $title
 * @property string $controller
 * @property string $action
 * @property string $querystring
 * @property string $remark
 * @property string $ip
 * @property integer $create_time
 * @property integer $status
 */
class Log extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'title', 'controller', 'action', 'querystring', 'remark'], 'required'],
            [['uid', 'create_time', 'status'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['controller', 'action'], 'string', 'max' => 50],
            [['querystring', 'remark'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'title' => 'Title',
            'controller' => 'Controller',
            'action' => 'Action',
            'querystring' => 'Querystring',
            'remark' => 'Remark',
            'ip' => 'Ip',
            'create_time' => 'Create Time',
            'status' => 'Status',
        ];
    }
}
