<?php

namespace backend\controllers;

use backend\models\Category;
use common\helpers\ArrayHelper;
use common\helpers\FuncHelper;
use Yii;
use backend\models\search\CategorySearch;

/*
 * 栏目控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class CategoryController extends BaseController
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
        //var_dump(Category::getParents(2));
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        /*$pid = Yii::$app->request->get('pid',0);

        $_where = ['pid'=>$pid];
        return $this->render('index',[
            'dataProvider' => $this->lists1('\common\models\Category', $_where, 'sort ASC'),
        ]);*/
    }

    /*
     * ---------------------------------------
     * 添加
     * ---------------------------------------
     */
    public function actionAdd(){
        $model = new Category();

        if (Yii::$app->request->isPost) {
            
            $data = Yii::$app->request->post('Category');
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
            if ($this->addRow('\backend\models\Category', $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }

        /* 获取模型默认数据 */
        $model->loadDefaultValues();
        $model->pid = Yii::$app->request->get('pid',0);
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
            $data = Yii::$app->request->post('Category');
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
            if ($this->editRow('\backend\models\Category', 'id', $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }
        $model = Category::findOne($id);
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
        if($this->delRow('\backend\models\Category', 'id')){
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

}
