<?php

namespace backend\controllers;

use Yii;
use backend\models\Admin;
use backend\models\Menu;
use common\modelsgii\AuthAssignment;

/**
 * 身份授权控制器
 * @author longfei <phphome@qq.com>
 */
class AuthController extends BaseController
{
    /**
     * @var \common\core\rbac\DbManager
     */
    public $authManager;

    /**
     * @var bool 这里很多自定义的表单，就没有添加验证
     */
    public $enableCsrfValidation = false;

    /**
     * ---------------------------------------
     * 构造方法
     * ---------------------------------------
     */
    public function init()
    {
        parent::init();
        $this->authManager = Yii::$app->authManager;
    }

    /**
     * ---------------------------------------
     * “角色”列表
     * ---------------------------------------
     */
    public function actionIndex()
    {
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        /* 获取角色列表 */
        $roles = Yii::$app->authManager->getRoles();

        return $this->render('index', [
            'roles' => $roles,
        ]);
    }

    /**
     * ---------------------------------------
     * 添加“角色”
     * 注意：角色表的“rule_name”字段必须为“NULL”，不然会出错。
     *      详情见“yii\rbac\BaseManager”的203行if($item->ruleName === null){return true;}
     * ---------------------------------------
     */
    public function actionAdd()
    {

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('param');
            /* 创建角色 */
            $role = Yii::$app->authManager->createRole($data['name']);
            $role->type = 1;
            $role->description = $data['description'];
            if (Yii::$app->authManager->add($role)) {
                $this->success('更新成功', $this->getForward());
            }
            $this->error('更新失败');
        }

        return $this->render('add');
    }

    /**
     * ---------------------------------------
     * 编辑“角色”
     * 注意：角色表的“rule_name”字段必须为“NULL”，不然会出错。
     *      详情见“yii\rbac\BaseManager”的203行if($item->ruleName === null){return true;}
     * ---------------------------------------
     */
    public function actionEdit()
    {

        /* 获取角色信息 */
        $item_name = Yii::$app->request->get('role');
        $role = Yii::$app->authManager->getRole($item_name);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('param');
            $role->name = $data['name'];
            $role->description = $data['description'];
            if (Yii::$app->authManager->update($item_name, $role)) {
                $this->success('更新成功', $this->getForward());
            }
            $this->error('更新失败');
        }

        return $this->render('edit', [
            'role' => $role,
        ]);
    }

    /**
     * ---------------------------------------
     * 删除“角色”
     * 同时会删除auth_assignment、auth_item_child、auth_item中关于$role的内容
     * @param string $role 角色名称
     * ---------------------------------------
     */
    public function actionDelete($role)
    {
        $role = Yii::$app->authManager->getRole($role);
        if (Yii::$app->authManager->remove($role)) {
            $this->success('删除成功', $this->getForward());
        }
        $this->error('删除失败');
    }

    /**
     * ---------------------------------------
     * 角色授权
     * ---------------------------------------
     */
    public function actionAuth($role)
    {

        /* 提交后 */
        if (Yii::$app->request->isPost) {
            $rules = Yii::$app->request->post('rules');
            /* 判断角色是否存在 */
            if (!$parent = Yii::$app->authManager->getRole($role)) {
                $this->error('角色不存在');
            }
            /* 删除角色所有child */
            Yii::$app->authManager->removeChildren($parent);

            if (is_array($rules)) {
                foreach ($rules as $rule) {
                    /* 更新auth_rule表 与 auth_item表 */
                    Yii::$app->authManager->saveRule($rule);
                    /* 更新auth_item_child表 */
                    Yii::$app->authManager->saveChild($parent->name, $rule);
                }
            }
            $this->success('更新权限成功', $this->getForward());
        }

        /* 获取栏目节点 */
        $node_list = Menu::returnNodes();
        $auth_rules = Yii::$app->authManager->getChildren($role);
        $auth_rules = array_keys($auth_rules);//var_dump($auth_rules);exit;

        return $this->render('auth', [
            'node_list' => $node_list,
            'auth_rules' => $auth_rules,
            'role' => $role,
        ]);
    }

    /**
     * ---------------------------------------
     * 授权用户列表
     * ---------------------------------------
     */
    public function actionUser($role)
    {
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();

        $uids = Yii::$app->authManager->getUserIdsByRole($role);
        $uids = implode(',', array_unique($uids));

        /*更新uids 为空的情况*/
        if ($uids) {
            $_where = 'uid in(' . $uids . ')';
        } else {
            $_where = '1 != 1';
        }

        return $this->render('user', [
            'dataProvider' => $this->lists1(new Admin(), $_where),
        ]);
    }

}
