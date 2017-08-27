<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%admin_log}}".
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
class AdminLog extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_log}}';
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
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => '用户uid',
            'title' => '标题',
            'controller' => '控制器',
            'action' => '动作',
            'querystring' => '查询字符串',
            'remark' => '备注',
            'ip' => 'IP',
            'create_time' => '创建时间',
            'status' => '状态',
        ];
    }
}
