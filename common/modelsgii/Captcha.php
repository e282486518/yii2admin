<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%captcha}}".
 *
 * @property string $id
 * @property string $ip
 * @property string $mobile
 * @property string $captcha
 * @property string $time
 */
class Captcha extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%captcha}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile', 'captcha'], 'required'],
            [['time'], 'integer'],
            [['ip'], 'string', 'max' => 15],
            [['mobile'], 'string', 'max' => 20],
            [['captcha'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'mobile' => 'Mobile',
            'captcha' => 'Captcha',
            'time' => 'Time',
        ];
    }
}
