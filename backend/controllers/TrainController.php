<?php

namespace backend\controllers;

use backend\models\Train;
use common\helpers\ArrayHelper;
use common\helpers\FuncHelper;
use Yii;
use backend\models\search\TrainSearch;

/**
 * 订单控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class TrainController extends BaseController
{
    /**
     * ---------------------------------------
     * 列表页
     * ---------------------------------------
     */
    public function actionIndex()
    {
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        $searchModel = new TrainSearch();
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
        $model = new Train();

        if (Yii::$app->request->isPost) {
            
            $data = Yii::$app->request->post('Train');
            $data['create_time'] = time();
            /* 表单数据加载、验证、数据库操作 */
            if ($this->addRow('\backend\models\Train', $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }

        /* 获取模型默认数据 */
        $model->loadDefaultValues();
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
            $data = Yii::$app->request->post('Train');
            $data['update_time'] = time();
            $data['id'] = $id;
            /* 表单数据加载、验证、数据库操作 */
            if ($this->editRow('\backend\models\Train', 'id', $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }
        $model = Train::findOne($id);
        
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
        if($this->delRow('\backend\models\Train', 'id')){
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

}
