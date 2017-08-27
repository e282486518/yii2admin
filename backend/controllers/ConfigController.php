<?php

namespace backend\controllers;

use Yii;
use backend\models\Config;
use backend\models\search\ConfigSearch;
use yii\web\NotFoundHttpException;


/**
 * 系统配置控制器
 * @author longfei <phphome@qq.com>
 */
class ConfigController extends BaseController
{

    /**
     * ---------------------------------------
     * 以列表的形式展现配置项
     * @return string
     * ---------------------------------------
     */
    public function actionIndex()
    {
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        $searchModel = new ConfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * ---------------------------------------
     * 添加配置项
     * ---------------------------------------
     */
    public function actionAdd()
    {
        $model = $this->findModel(0);
        if (Yii::$app->request->isPost) {
            /* 表单验证 */
            $data = Yii::$app->request->post('Config');
            //$data['create_time'] = time();

            if ($this->saveRow($model, $data)) {
                $this->success('操作成功', $this->getForward());
            } else {
                $this->error('操作错误');
            }
        }
        /* 模型默认值 */
        $model->loadDefaultValues();
        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * ---------------------------------------
     * 编辑配置项
     * ---------------------------------------
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->get('id', 0);
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            /* 表单验证 */
            $data = Yii::$app->request->post('Config');
            //$data['update_time'] = time();//var_dump($data);exit;

            if ($this->saveRow($model, $data)) {
                $this->success('操作成功', $this->getForward());
            } else {
                $this->error('操作错误');
            }
        }
        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * ---------------------------------------
     * 删除配置项
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
     * 以表单的形式展现配置项
     * ---------------------------------------
     */
    public function actionGroup()
    {

        /* 提交表单后 */
        if (Yii::$app->request->isPost) {
            /* 表单验证 */
            $data = Yii::$app->request->post('param');
            //var_dump($data);exit;
            /* 更改配置值 */
            $isSuccess = true;
            foreach ($data as $name => $value) {
                $model = Config::findOne(['name' => $name]);
                $model->value = $value;
                $model->update_time = time();
                if (!$model->save()) {
                    $isSuccess = false;
                    continue;
                }
            }
            if ($isSuccess) {
                $this->success('操作成功', $this->getForward());
            } else {
                $this->error('有配置值修改失败');
            }
        }

        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        $id = Yii::$app->request->get('id', 1);
        /* 配置表 分组 */
        $groups = Config::find()
            ->where(['and', ['group' => $id], ['status' => 1]])
            ->orderBy('sort ASC')->asArray()->all();
        foreach ($groups as $key => $value) {
            if ($value['extra']) {
                $groups[$key]['extra'] = Config::parse(3, $value['extra']);
            }
        }

        return $this->render('group', [
            'groups' => $groups,
        ]);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id == 0) {
            return new Config();
        }
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
