<?php

namespace common\models;

use Yii;

/*
 * ---------------------------------------
 * 文章模型
 * ---------------------------------------
 */
class TrainCertificate extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%train_certificate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'cover', 'description'], 'required'],
            [['title'], 'string', 'max' => 100],
            [['cover'], 'string', 'max'=>255],
            [['description'], 'string', 'max'=>1000],
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
            'title' => '证书名',
            'cover' => '证书图',
            'description' => '证书简介',
            'ctime' => '添加时间'
        ];
    }

    /**
     * 获取所有的证书
     */
    public static function getAll(){
        $list = static::find()->select(['id', 'title'])->orderBy('ctime desc')->asArray()->all();
        $return = null;
        if($list) {
            foreach($list as $key=>$val) {
                $return[$val['id']] = $val['title'];
            }
        }
        return $return;
    }

    /**
     * 根据id获取证书
     */
    public static function getAllByIds($ids, $format = 1) {
        if(!$ids) return '';
        $list = static::find()->where(['id' => explode(',', $ids)])->asArray()->all();
        $str = '';
        if($list) {
            if($format) {
                foreach ($list as $val) {
                    $str[] = $val['title'];
                }
                return join(' | ', $str);
            }else{
                return $list;
            }
        }
        return null;
    }

}
