<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Train;

/**
 * TrainSearch represents the model behind the search form about `common\models\Train`.
 */
class TrainSearch extends Train
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'num', 'sort', 'create_time', 'update_time', 'status'], 'integer'],
            [['title', 'description', 'cover'], 'safe'],
            [['price'], 'number'],
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
        $query = Train::find();

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
        
        /* 条件搜索 */
        
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'price' => $this->price,
            'num' => $this->num,
            'sort' => $this->sort,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'cover', $this->cover]);
        
        /* 排序 */
        $query->orderBy([
            'sort'   => SORT_ASC,
        ]);
        
        return $dataProvider;
    }
}
