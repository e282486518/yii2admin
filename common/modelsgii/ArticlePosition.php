<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%article_position}}".
 *
 * @property integer $article_id
 * @property integer $position_id
 */
class ArticlePosition extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'position_id'], 'required'],
            [['article_id', 'position_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'Article ID',
            'position_id' => 'Position ID',
        ];
    }
}
