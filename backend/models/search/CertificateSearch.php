<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TrainCertificate;

/**
 * CertificateSearch represents the model behind the search form about `common\models\TrainCertificate`.
 */
class CertificateSearch extends TrainCertificate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ctime'], 'integer'],
            [['title', 'cover', 'description'], 'safe'],
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
        $query = TrainCertificate::find();

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
            'ctime' => $this->ctime,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
