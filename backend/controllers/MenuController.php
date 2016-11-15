<?php

namespace backend\controllers;

use backend\models\Menu;
use common\helpers\ArrayHelper;
use Yii;
use backend\models\search\MenuSearch;

/*
 * 后台菜单控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class MenuController extends BaseController
{
    /**
     * ---------------------------------------
     * 列表页
     * ---------------------------------------
     */
    public function actionIndex()
    {

        /* 添加当前位置到cookie供后续跳转调用*/
        $this->setForward();

        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * ---------------------------------------
     * 添加
     * ---------------------------------------
     */
    public function actionAdd(){
        $pid = Yii::$app->request->get('pid',0);

        if (Yii::$app->request->isPost) {
            /* 表单验证 */
            $data = Yii::$app->request->post('Menu');
            $data['status'] = 1;

            if ($this->addRow('\backend\models\Menu', $data)) {
                $this->success('操作成功', $this->getForward());
            } else {
                $this->error('操作错误');
            }
        }

        $model = new Menu();
        /* 设置默认值 */
        $model->loadDefaultValues();
        $model->pid = $pid;
        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * ---------------------------------------
     * 编辑
     * ---------------------------------------
     */
    public function actionEdit(){
        $id = Yii::$app->request->get('id',0);

        if (Yii::$app->request->isPost) {
            /* 表单验证 */
            $data = Yii::$app->request->post('Menu');
            $data['id'] = $id;

            if ($this->editRow('\backend\models\Menu', 'id', $data)) {
                $this->success('操作成功', $this->getForward());
            } else {
                $this->error('操作错误');
            }
        }

        $model = Menu::findOne($id);
        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * ---------------------------------------
     * 删除或批量删除
     * ---------------------------------------
     */
    public function actionDelete(){
        if($this->delRow('\common\models\Menu', 'id')){
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

}
