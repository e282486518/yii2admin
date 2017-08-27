<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modelsgii\AdminLog;

/**
 * AdminLogSearch represents the model behind the search form about `common\models\AdminLog`.
 */
class AdminLogSearch extends AdminLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'create_time', 'status'], 'integer'],
            [['title', 'controller', 'action', 'querystring', 'remark', 'ip'], 'safe'],
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
        $query = AdminLog::find();

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
            'uid' => $this->uid,
            'create_time' => $this->create_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'controller', $this->controller])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'querystring', $this->querystring])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'ip', $this->ip]);
        
        /* 排序 */
        $query->orderBy([
            'id'   => SORT_DESC,
        ]);
        
        return $dataProvider;
    }
}
