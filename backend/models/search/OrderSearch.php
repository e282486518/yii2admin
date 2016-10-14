<?php

namespace backend\models\search;

use backend\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\models\Order`.
 */
class OrderSearch extends Order
{

    public $from_date; // 搜索开始时间
    public $to_date; // 搜索结束时间

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'uid', 'aid', 'start_time', 'end_time', 'num', 'pay_status', 'pay_time', 'pay_type', 'pay_source', 'create_time', 'status'], 'integer'],
            [['order_sn', 'type', 'title'], 'safe'],
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
        //$params = $params ? : Yii::$app->request->getQueryParams();
        
        $query = Order::find()->orderBy('order_id DESC')->asArray();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /* 基本搜索 */
        $query->andFilterWhere([
            'pay_status' => $this->pay_status,
            'uid' => $this->uid,
            'pay_type' => $this->pay_type,
            'pay_source' => $this->pay_source,
        ]);

        /* 某用户推荐的人的订单 */
        if (isset($params['tuid']) && $params['tuid']) {
            $uids = User::find()->select('uid')->where(['tuid' => $params['tuid']])->asArray()->column();
            $uids = $uids?$uids:-1;
            $query->andFilterWhere(['in', 'uid', $uids]);
            //var_dump($uids);exit;
        }

        /* 商品名 */
        $query->andFilterWhere([
            'like', 'title', $this->title,
        ]);

        /* 时间搜索 */
        if(isset($params['OrderSearch']['from_date']) && isset($params['OrderSearch']['to_date'])){
            $this->from_date = $params['OrderSearch']['from_date'];
            $this->to_date = $params['OrderSearch']['to_date'];
        }
        if($this->from_date !='' && $this->to_date != '') {
            $query->andFilterWhere(['between', 'create_time', strtotime($this->from_date), strtotime($this->to_date)]);
        }
        
        /* 排序 */
        $query->orderBy([
            'order_id' => SORT_DESC,
        ]);

        return $dataProvider;
    }
}
