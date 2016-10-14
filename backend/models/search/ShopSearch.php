<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Shop;

/**
 * ShopSearch represents the model behind the search form about `common\models\Shop`.
 */
class ShopSearch extends Shop
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'num', 'sort', 'create_time', 'update_time', 'status'], 'integer'],
            [['title', 'description', 'cover', 'images', 'extend'], 'safe'],
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
        $query = Shop::find();

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
        $type = Yii::$app->request->get('type',0);
        $query->andFilterWhere(['type' => $type]);
        
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'num' => $this->num,
            'price' => $this->price,
            'sort' => $this->sort,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'extend', $this->extend]);
        
        /* 排序 */
        $query->orderBy([
            'sort'   => SORT_ASC,
        ]);
        
        return $dataProvider;
    }
}
