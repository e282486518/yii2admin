<?php

namespace backend\controllers;

use Yii;
use common\models\TrainType;
use yii\web\NotFoundHttpException;

/**
 * 栏目控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class TraintypeController extends BaseController
{
    /**
     * ------------------------------------------
     * 功能介绍
     * @return string
     * ------------------------------------------
     */
    public function actionIndex(){
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        return $this->render('index', [
            'dataProvider' => $this->lists1(new TrainType(), '', 'ctime ASC'),
        ]);
    }

    /**
     * ------------------------------------------
     * 功能介绍
     * @return string
     * ------------------------------------------
     */
    public function actionEdit() {
        $id = Yii::$app->request->get('id',0);
        $model = TrainType::findOne($id);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('TrainType');
            $data['certif_ids'] = join(",", $data['certif_ids']);
            if($id) {
                $data['id'] = $id;
            }else{
                $data['ctime'] = time();
            }
            /* 表单数据加载、验证、数据库操作 */
            if ($this->saveRow($model, $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }
        if($id) {
            $model->certif_ids = explode(',', $model->certif_ids);
        }else{
            /* 获取模型默认数据 */
            $model->loadDefaultValues();
        }

        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * ------------------------------------------
     * 功能介绍
     * ------------------------------------------
     */
    public function actionDelete(){
        $model = $this->findModel(0);
        if($this->delRow($model, 'id')){
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrainType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id == 0) {
            return new TrainType();
        }
        if (($model = TrainType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
