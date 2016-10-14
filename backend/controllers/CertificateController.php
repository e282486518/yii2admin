<?php

namespace backend\controllers;

use Yii;
use common\models\TrainCertificate;
use backend\models\search\CertificateSearch;

/*
 * 栏目控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class CertificateController extends BaseController
{

    public function actionIndex(){
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        $searchModel = new CertificateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        /*return $this->render('index', [
            'dataProvider' => $this->lists1('\common\models\TrainCertificate', '', 'ctime ASC'),
        ]);*/
    }

    public function actionEdit() {
        $id = Yii::$app->request->get('id',0);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('TrainCertificate');
            if($id) {
                $data['id'] = $id;
                $succ = $this->editRow('\common\models\TrainCertificate', 'id', $data);
            }else{
                $data['ctime'] = time();
                $succ = $this->addRow('\common\models\TrainCertificate', $data);
            }

            /* 表单数据加载、验证、数据库操作 */
            if ($succ) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }
        if($id) {
            $model = TrainCertificate::findOne($id);
        }else{
            $model = new TrainCertificate();
            /* 获取模型默认数据 */
            $model->loadDefaultValues();
        }

        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionDelete(){
        if($this->delRow('\common\models\TrainCertificate', 'id')){
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

}
