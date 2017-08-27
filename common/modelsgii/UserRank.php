<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%user_rank}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $score
 * @property string $discount
 * @property integer $status
 */
class UserRank extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_rank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'score'], 'required'],
            [['score', 'status'], 'integer'],
            [['discount'], 'number'],
            [['title'], 'string', 'max' => 30]
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
            'score' => 'Score',
            'discount' => 'Discount',
            'status' => 'Status',
        ];
    }
}
