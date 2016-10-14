<?php

namespace backend\controllers;

use common\models\TrainType;
use Yii;


/*
 * 栏目控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class TraintypeController extends BaseController
{

    public function actionIndex(){
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        return $this->render('index', [
            'dataProvider' => $this->lists1('\common\models\TrainType', '', 'ctime ASC'),
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->get('id',0);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('TrainType');
            $data['certif_ids'] = join(",", $data['certif_ids']);
            if($id) {
                $data['id'] = $id;
                $succ = $this->editRow('\common\models\TrainType', 'id', $data);
            }else{
                $data['ctime'] = time();
                $succ = $this->addRow('\common\models\TrainType', $data);
            }

            /* 表单数据加载、验证、数据库操作 */
            if ($succ) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }
        if($id) {
            $model = TrainType::findOne($id);
            $model->certif_ids = explode(',', $model->certif_ids);
        }else{
            $model = new TrainType();
            /* 获取模型默认数据 */
            $model->loadDefaultValues();
        }

        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionDelete(){
        if($this->delRow('\common\models\TrainType', 'id')){
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

}
