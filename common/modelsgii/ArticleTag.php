<?php

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "{{%article_tag}}".
 *
 * @property integer $article_id
 * @property integer $tag_id
 */
class ArticleTag extends \common\core\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'required'],
            [['article_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'Article ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
