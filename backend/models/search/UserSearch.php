<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modelsgii\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'reg_time', 'reg_ip', 'last_login_time', 'last_login_ip', 'update_time', 'tuid', 'score', 'score_all', 'status'], 'integer'],
            [['username', 'password', 'salt', 'email', 'mobile', 'image'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
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
            'tuid' => $this->tuid,
            'score' => $this->score,
            'score_all' => $this->score_all,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'salt', $this->salt])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
