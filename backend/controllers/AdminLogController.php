<?php

namespace backend\controllers;

use Yii;
use common\modelsgii\AdminLog;
use backend\models\search\AdminLogSearch;
use yii\web\NotFoundHttpException;

/**
 * 行为日志控制器
 * @author longfei <phphome@qq.com>
 */
class AdminLogController extends BaseController
{

    /**
     * ---------------------------------------
     * 行为日志列表
     * @param string string  参数说明
     * @return string 返回信息
     * ---------------------------------------
     */
    public function actionIndex()
    {
        /* 添加当前位置到cookie供后续操作调用 */
        $this->setForward();

        $searchModel = new AdminLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * ---------------------------------------
     * 查看行为日志
     * @param string string  参数说明
     * @return string 返回信息
     * ---------------------------------------
     */
    public function actionView()
    {
        $id = Yii::$app->request->get('id', 0);
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    /**
     * ---------------------------------------
     * 删除日志
     * ---------------------------------------
     */
    public function actionDelete()
    {
        $model = $this->findModel(0);
        if ($this->delRow($model, 'id')) {
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

    /**
     * ---------------------------------------
     * 清空日志
     * ---------------------------------------
     */
    public function actionClear()
    {
        $res = AdminLog::deleteAll();
        if ($res !== false) {
            $this->success('日志清空成功！');
        } else {
            $this->error('日志清空失败！');
        }
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id == 0) {
            return new AdminLog();
        }
        if (($model = AdminLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
