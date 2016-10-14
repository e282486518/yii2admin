<?php

namespace backend\controllers;

use backend\models\Article;
use common\helpers\ArrayHelper;
use common\helpers\FuncHelper;
use common\models\Category;
use Yii;
use backend\models\search\ArticleSearch;


/*
 * 文章控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class ArticleController extends BaseController
{
    /*
     * ---------------------------------------
     * 列表页
     * ---------------------------------------
     */
    public function actionIndex()
    {
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * ---------------------------------------
     * 添加
     * ---------------------------------------
     */
    public function actionAdd(){
        $model = new Article();

        if (Yii::$app->request->isPost) {
            
            $data = Yii::$app->request->post('Article');
            $data['create_time'] = time();
            /* 格式化extend值，为空或数组序列化 */
            if ($data['extend']) {
                $tmp = FuncHelper::parse_field_attr($data['extend']);
                if (is_array($tmp)) {
                    $data['extend'] = serialize($tmp);
                }else{
                    $data['extend'] = '';
                }
            }
            /* 表单数据加载、验证、数据库操作 */
            if ($this->addRow('\backend\models\Article', $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }

        /* 获取模型默认数据 */
        $model->loadDefaultValues();
        /* 获取栏目树形结构 */
        $cate_list = Category::find()->asArray()->all();
        $cate_tree = ArrayHelper::list_to_tree($cate_list,'id','pid','_child');
        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
            'cate_tree' => $cate_tree,
        ]);
    }

    /*
     * ---------------------------------------
     * 编辑
     * ---------------------------------------
     */
    public function actionEdit(){
        $id = Yii::$app->request->get('id',0);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('Article');
            $data['update_time'] = time();
            $data['id'] = $id;
            /* 格式化extend值，为空或数组序列化 */
            if ($data['extend']) {
                $tmp = FuncHelper::parse_field_attr($data['extend']);
                if (is_array($tmp)) {
                    $data['extend'] = serialize($tmp);
                }else{
                    $data['extend'] = '';
                }
            }
            /* 表单数据加载、验证、数据库操作 */
            if ($this->editRow('\backend\models\Article', 'id', $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }
        $model = Article::findOne($id);
        /* 还原extend的数据 */
        if ($model->extend) {
            $_tmp = unserialize($model->extend);
            $_str = '';
            if ($_tmp && is_array($_tmp)) {
                foreach ($_tmp as $key => $value) {
                    $_str .= $key.':'.$value.',';
                }
            }
            $model->extend = $_str;
        }
        /* 获取栏目树形结构 */
        $cate_list = Category::find()->asArray()->all();
        $cate_tree = ArrayHelper::list_to_tree($cate_list,'id','pid','_child');
        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
            'cate_tree' => $cate_tree,
        ]);
    }

    /*
     * ---------------------------------------
     * 删除或批量删除
     * ---------------------------------------
     */
    public function actionDelete(){
        if($this->delRow('\backend\models\Article', 'id')){
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

}
