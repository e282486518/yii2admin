<?php

namespace backend\controllers;

use Yii;
use backend\models\Shop;
use backend\models\ShopGroup;
use common\helpers\ArrayHelper;
use common\helpers\FuncHelper;
use backend\models\search\GroupSearch;
use yii\web\NotFoundHttpException;

/**
 * 商品套餐
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class GroupController extends BaseController
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

        $searchModel = new GroupSearch();
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
        $model = $this->findModel(0);

        if (Yii::$app->request->isPost) {
            
            $data = Yii::$app->request->post('ShopGroup');

            /* 处理掉空白的groups数据 */
            $totel = 0;
            if ($data['groups'] && is_array($data['groups'])) {
                foreach ($data['groups'] as $i => $g) {
                    if ($g && is_array($g)) {
                        foreach ($g as $k => $v) {
                            if (!$v['days'] || !$v['num']) {
                                unset($data['groups'][$i][$k]);
                            }
                            /* 价格计算 */
                            $goods = Shop::info($v['id']);
                            $totel += $v['days'] * $v['num'] * $goods['price'];
                        }
                        if (!$data['groups'][$i]) {
                            unset($data['groups'][$i]);
                        }
                    }
                }
            }
            $data['groups'] = serialize($data['groups']);
            $data['totel']  = $totel;

            /* 将图组转化为字符串 */
            if (isset($data['images']) && is_array($data['images'])) {
                $data['images'] = array_values(array_flip(array_flip($data['images'])));
                $data['images'] = trim(implode ( ",", $data['images']),',');
            }

            /* 表单数据加载、验证、数据库操作 */
            if ($this->saveRow($model, $data)) {
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
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('ShopGroup');

            /* 处理掉空白的groups数据 */
            $total = 0;
            if ($data['groups'] && is_array($data['groups'])) {
                foreach ($data['groups'] as $i => $g) {
                    if ($g && is_array($g)) {
                        foreach ($g as $k => $v) {
                            if (!$v['days'] || !$v['num']) {
                                unset($data['groups'][$i][$k]);
                            }
                            /* 价格计算 */
                            $goods = Shop::info($v['id']);
                            $total += $v['days'] * $v['num'] * $goods['price'];
                        }
                        if (!$data['groups'][$i]) {
                            unset($data['groups'][$i]);
                        }
                    }
                }
            }
            $data['groups'] = serialize($data['groups']);
            $data['total']  = $total;

            /* 将图组转化为字符串 */
            if (isset($data['images']) && is_array($data['images'])) {
                $data['images'] = array_values(array_flip(array_flip($data['images'])));
                $data['images'] = trim(implode ( ",", $data['images']),',');
            }//var_dump($data);exit();

            /* 表单数据加载、验证、数据库操作 */
            if ($this->saveRow($model, $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }
        /* 还原groups的数据 */
        $groups = unserialize($model->groups);

        /* 渲染模板 */
        return $this->render('edit', [
            'model' => $model,
            'groups' => $groups,
        ]);
    }

    /**
     * ---------------------------------------
     * 删除或批量删除
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
     * @return ShopGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id == 0) {
            return new ShopGroup();
        }
        if (($model = ShopGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
