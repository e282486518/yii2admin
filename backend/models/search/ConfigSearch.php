<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Config;

/**
 * ConfigSearch represents the model behind the search form about `backend\models\Config`.
 */
class ConfigSearch extends Config
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group', 'type', 'create_time', 'update_time', 'sort', 'status'], 'integer'],
            [['name', 'title', 'value', 'extra', 'remark'], 'safe'],
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
        $query = Config::find();

        /**
         * 在PHP5中 对象的复制是通过引用来实现的，
         * 运行到return处的$query对象和这里的$query在内存中的地址是一样的，
         * 所以不需要将这个语句写在return前
         */
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
            'group' => $this->group,
            'type' => $this->type,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'sort' => $this->sort,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'extra', $this->extra])
            ->andFilterWhere(['like', 'remark', $this->remark]);
        
        /* 条件搜索 */
        
        
        /* 排序 */
        $query->orderBy([
            'sort' => SORT_ASC,
        ]);
        
        return $dataProvider;
    }
}
