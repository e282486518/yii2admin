<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use backend\models\Category;
use common\helpers\ArrayHelper;

/**
 * CategorySearch represents the model behind the search form about `backend\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pid', 'create_time', 'update_time', 'sort', 'status'], 'integer'],
            [['name', 'title', 'link', 'extend', 'meta_title', 'keywords', 'description'], 'safe'],
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
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $query = Category::find();

        /* 分类查询 */
        //$pid = Yii::$app->request->get('pid',0);
        //$query->andFilterWhere(['pid' => $pid]);

        $lists = $query->orderBy('sort asc')->asArray()->all();

        $lists = ArrayHelper::list_to_tree($lists, 'id', 'pid');
        $lists = ArrayHelper::format_tree($lists, 'title');

        $dataProvider = new ArrayDataProvider([
            'allModels' => $lists,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);
        
        /*$query->andFilterWhere([
            'id' => $this->id,
            'pid' => $this->pid,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'sort' => $this->sort,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'extend', $this->extend])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description]);*/

        return $dataProvider;
    }
}
