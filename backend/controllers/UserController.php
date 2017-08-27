<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\search\UserSearch;

/**
 * 用户控制器
 * @author longfei <phphome@qq.com>
 */
class UserController extends BaseController
{
    /**
     * ---------------------------------------
     * 构造方法
     * ---------------------------------------
     */
    public function init()
    {
        parent::init();
    }

    /**
     * ---------------------------------------
     * 用户列表
     * ---------------------------------------
     */
    public function actionIndex()
    {
        /* 添加当前位置到cookie供后续操作调用 */
        $this->setForward();

        $searchModel = new UserSearch();
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
    public function actionAdd()
    {

        $model = new User();

        if (Yii::$app->request->isPost) {
            /* 表单验证 */
            $data = Yii::$app->request->post('User');
            $data['reg_time'] = time();
            $data['reg_ip'] = ip2long(Yii::$app->request->getUserIP());
            $data['last_login_time'] = 0;
            $data['last_login_ip'] = ip2long(Yii::$app->request->getUserIP());
            $data['update_time'] = 0;
            /* 表单数据加载和验证，具体验证规则在模型rule中配置 */
            /* 密码单独验证，否则setPassword后密码肯定符合rule */
            if (empty($data['password']) || strlen($data['password']) < 6) {
                $this->error('密码为空或小于6字符');
            }
            $model->setAttributes($data);
            $model->generateAuthKey();
            $model->setPassword($data['password']);
            /* 保存用户数据到数据库 */
            if ($model->save()) {
                $this->success('操作成功', $this->getForward());
            } else {
                $this->error('操作错误');
            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * ---------------------------------------
     * 编辑
     * ---------------------------------------
     */
    public function actionEdit($uid)
    {
        $model = User::findOne($uid);

        if (Yii::$app->request->isPost) {
            /* 表单验证 */
            $data = Yii::$app->request->post('User');
            $data['update_time'] = time();
            /* 如果设置密码则重置密码，否则不修改密码 */
            if (!empty($data['password'])) {
                $model->generateAuthKey();
                $model->setPassword($data['password']);
            }
            unset($data['password']);

            $model->setAttributes($data);
            /* 保存用户数据到数据库 */
            if ($model->save()) {
                $this->success('操作成功', $this->getForward());
            } else {
                $this->error('操作错误');
            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * ---------------------------------------
     * 删除
     * ---------------------------------------
     */
    public function actionDelete()
    {
        $ids = Yii::$app->request->param('id', 0);
        $ids = implode(',', array_unique((array)$ids));

        if (empty($ids)) {
            $this->error('请选择要操作的数据!');
        }

        $_where = 'uid in(' . $ids . ')';
        if (User::deleteAll($_where)) {
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }


}
