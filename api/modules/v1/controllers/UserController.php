<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;

/**
 * 控制器
 *
 * @package api\modules\v1\controllers
 */
class UserController extends BaseController
{
    public $modelClass = 'api\models\User';

    // 不需进行token权限认证的方法
    public $optional = ['index','aaa'];



    public function actions()
    {
        $action = parent::actions();
        unset($action['index']);
        return $action;
    }

    /**
     * ---------------------------------------
     * 功能说明
     *
     * @return mixed
     * @throws \Throwable
     * @author hlf <phphome@qq.com> 2020/5/21
     * ---------------------------------------
     */
    public function actionIndex(){
        $this->getIdentity();
	
        return $this->user;
    }
    
    /**
     * ---------------------------------------
     * 功能说明
     *
     * @return mixed
     * @throws \Throwable
     * @author hlf <phphome@qq.com> 2020/5/21
     * ---------------------------------------
     */
    public function actionAaa(){
        $identity = Yii::$app->user->getIdentity();
        return $identity ? $identity->getAttributes() : null;
    }

}
