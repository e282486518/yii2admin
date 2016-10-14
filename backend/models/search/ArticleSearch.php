<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `backend\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'type', 'position', 'sort', 'create_time', 'update_time', 'status'], 'integer'],
            [['name', 'title', 'cover', 'description', 'content', 'extend', 'link'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'type' => $this->type,
            'position' => $this->position,
            'sort' => $this->sort,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'extend', $this->extend])
            ->andFilterWhere(['like', 'link', $this->link]);
        
        /* 排序 */
        $query->orderBy([
            'sort' => SORT_ASC,
            'id' => SORT_DESC,
        ]);

        return $dataProvider;
    }
}
