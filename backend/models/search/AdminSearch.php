<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Admin;
use common\modelsgii\AuthAssignment;

/**
 * AdminSearch represents the model behind the search form about `backend\models\Admin`.
 */
class AdminSearch extends Admin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'reg_time', 'reg_ip', 'last_login_time', 'last_login_ip', 'update_time', 'status'], 'integer'],
            [['username', 'password', 'salt', 'email', 'mobile'], 'safe'],
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
        $query = Admin::find();

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
            'uid' => $this->uid,
            'reg_time' => $this->reg_time,
            'reg_ip' => $this->reg_ip,
            'last_login_time' => $this->last_login_time,
            'last_login_ip' => $this->last_login_ip,
            'update_time' => $this->update_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'salt', $this->salt])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile]);
        
        /* 排序 */
        $query->orderBy([
            'uid' => SORT_ASC,
        ]);

        return $dataProvider;
    }
}
