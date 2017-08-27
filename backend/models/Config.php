<?php

namespace backend\models;

use Yii;


class Config extends \common\modelsgii\Config
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /**
             * 写库和更新库时，时间自动完成
             * 注意rules验证必填时可使用AttributeBehavior行为，model的EVENT_BEFORE_VALIDATE事件
             */
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => time(),
            ],
        ];
    }

    /**
     * ---------------------------------------
     * 获取 数据库中的 配置列表
     * @return array
     * ---------------------------------------
     */
    public static function lists(){
        $config = [];
        $data = (new \yii\db\Query())
                ->select(['type', 'name', 'value'])
                ->from(self::tableName())
                ->where(['status'=>1])
                ->all();
        if (!empty($data) && is_array($data)) {
            foreach ($data as $key => $value) {
                $config[$value['name']] = self::parse($value['type'], $value['value']);
            }
        }
        return $config;
    }

    /**
     * ---------------------------------------
     * 根据配置类型解析配置
     * @param  integer $type  配置类型
     * @param  string  $value 配置值
     * @return mixed
     * ---------------------------------------
     */
    public static function parse($type, $value){
        switch ($type) {
            case 3: //解析数组
                $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
                if(strpos($value,':')){
                    $value  = [];
                    foreach ($array as $val) {
                        list($k, $v) = explode(':', $val);
                        $value[$k]   = $v;
                    }
                }else{
                    $value =    $array;
                }
                break;
        }
        return $value;
    }
}
