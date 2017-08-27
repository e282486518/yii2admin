<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $uid
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $mobile
 * @property string $reg_time
 * @property string $reg_ip
 * @property string $last_login_time
 * @property string $last_login_ip
 * @property string $update_time
 * @property string $tuid
 * @property string $image
 * @property string $score
 * @property string $score_all
 * @property integer $status
 */
class User extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'salt'], 'required'],
            [['reg_time', 'reg_ip', 'last_login_time', 'last_login_ip', 'update_time', 'tuid', 'score', 'score_all', 'status'], 'integer'],
            [['username'], 'string', 'max' => 16],
            [['password'], 'string', 'max' => 60],
            [['salt', 'email'], 'string', 'max' => 32],
            [['mobile'], 'string', 'max' => 15],
            [['image'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'username' => 'Username',
            'password' => 'Password',
            'salt' => 'Salt',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'reg_time' => 'Reg Time',
            'reg_ip' => 'Reg Ip',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login Ip',
            'update_time' => 'Update Time',
            'tuid' => 'Tuid',
            'image' => 'Image',
            'score' => 'Score',
            'score_all' => 'Score All',
            'status' => 'Status',
        ];
    }
}
