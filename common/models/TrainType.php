<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%train_type}}".
 *
 * @property integer $id
 * @property string $name
 */
class TrainType extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%train_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['cover','certif_ids','description'], 'string', 'max'=>255],
            [['ctime'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cover' => '封面',
            'description' => '描述',
            'certif_ids' => '证书'
        ];
    }

    /**
     * 获取所有培训分类
     */
    public static function getAll($format = 1){
        $list = static::find()->orderBy('ctime desc')->asArray()->all();
        $return = null;
        if($list) {
            if($format == 1) {
                foreach ($list as $key => $val) {
                    $return[$val['id']] = $val['name'];
                }
            }else{
                $return = $list;
            }
        }
        return $return;
    }

    /**
     * 根据分类id获取名称
     */
    public static function getNameById($id) {
        if(!$id) return '';
        $info =  static::findOne($id);
        return $info->name;
    }
}
