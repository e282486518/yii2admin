<?php

namespace backend\controllers;

use Yii;
use common\models\TrainCertificate;
use backend\models\search\CertificateSearch;
use yii\web\NotFoundHttpException;

/**
 * 栏目控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class CertificateController extends BaseController
{

    /**
     * ---------------------------------------
     * 列表
     * @return string
     * ---------------------------------------
     */
    public function actionIndex(){
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        $searchModel = new CertificateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * ---------------------------------------
     * 编辑
     * @return string
     * ---------------------------------------
     */
    public function actionEdit() {
        $id = Yii::$app->request->get('id',0);
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('TrainCertificate');
            if($id) {
                $data['id'] = $id;
            }else{
                $data['ctime'] = time();
            }
            if ($this->saveRow($model, $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }
        if(!$id) {
            /* 获取模型默认数据 */
            $model->loadDefaultValues();
        }

        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * ---------------------------------------
     * 删除
     * ---------------------------------------
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
     * @return TrainCertificate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id == 0) {
            return new TrainCertificate();
        }
        if (($model = TrainCertificate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
