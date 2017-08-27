<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modelsgii\Menu;

/**
 * MenuSearch represents the model behind the search form about `common\models\Menu`.
 */
class MenuSearch extends Menu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pid', 'sort', 'hide', 'status'], 'integer'],
            [['title', 'url', 'group'], 'safe'],
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
        $query = Menu::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        /* 条件搜索 */
        $pid = Yii::$app->request->get('pid',0);
        $query->andFilterWhere(['pid' => $pid]);
        
        $query->andFilterWhere([
            'hide' => $this->hide,
        ]);
        
        $query->andFilterWhere(['like', 'title', $this->title]);
        
        /* 排序 */
        $query->orderBy([
            'sort'   => SORT_ASC,
        ]);
        
        return $dataProvider;
    }
}
