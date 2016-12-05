<?php

namespace backend\controllers;

use Yii;
use backend\models\Shop;
use common\helpers\ArrayHelper;
use common\helpers\FuncHelper;
use common\models\ShopGroup;
use backend\models\search\ShopSearch;
use yii\web\NotFoundHttpException;


/**
 * 商品控制器
 * 作者 ：longfei
 * Email ：phphome@qq.com
 */
class ShopController extends BaseController
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

        $searchModel = new ShopSearch();
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
            
            $data = Yii::$app->request->post('Shop');
            //$data['create_time'] = time();
            $data['type'] = Yii::$app->request->get('type',1);
            /* 格式化extend值，为空或数组序列化 */
            if ($data['extend']) {
                $tmp = FuncHelper::parse_field_attr($data['extend']);
                if (is_array($tmp)) {
                    $data['extend'] = serialize($tmp);
                }else{
                    $data['extend'] = '';
                }
            }
            /* 将图组转化为字符串 */
            if (isset($data['images']) && is_array($data['images'])) {
                $data['images'] = array_values(array_flip(array_flip($data['images'])));
                $data['images'] = trim(implode ( ",", $data['images']),',');
            }
            /* 将图组转化为字符串 */
            if (isset($data['imagess']) && is_array($data['imagess'])) {
                $data['imagess'] = array_values(array_flip(array_flip($data['imagess'])));
                $data['imagess'] = trim(implode ( ",", $data['imagess']),',');
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
            $data = Yii::$app->request->post('Shop');
            //$data['update_time'] = time();
            $data['type'] = Yii::$app->request->get('type',1);
            /* 格式化extend值，为空或数组序列化 */
            if ($data['extend']) {
                $tmp = FuncHelper::parse_field_attr($data['extend']);
                if (is_array($tmp)) {
                    $data['extend'] = serialize($tmp);
                }else{
                    $data['extend'] = '';
                }
            }
            /* 将图组转化为字符串 */
            if (isset($data['images']) && is_array($data['images'])) {
                $data['images'] = array_values(array_flip(array_flip($data['images'])));
                $data['images'] = trim(implode ( ",", $data['images']),',');
            }
            /* 将图组转化为字符串 */
            if (isset($data['imagess']) && is_array($data['imagess'])) {
                $data['imagess'] = array_values(array_flip(array_flip($data['imagess'])));
                $data['imagess'] = trim(implode ( ",", $data['imagess']),',');
            }
            /* 表单数据加载、验证、数据库操作 */
            if ($this->saveRow($model, $data)) {
                $this->success('操作成功', $this->getForward());
            }else{
                $this->error('操作错误');
            }
        }
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
        $model = $this->findModel(0);
        if($this->delRow($model, 'id')){
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

    /**
     * ---------------------------------------
     * 商城套餐
     * @param int $id 参数信息
     * @return string
     * ---------------------------------------
     */
    public function actionGroup(){
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        return $this->render('group',[
            'dataProvider' => $this->lists1(new ShopGroup(), '', 'sort ASC'),
        ]);

    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id == 0) {
            return new Shop();
        }
        if (($model = Shop::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
