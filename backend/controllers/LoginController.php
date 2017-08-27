<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use yii\helpers\Url;

/**
 * 后台登录控制器
 * @author longfei <phphome@qq.com>
 */
class LoginController extends Controller
{

    public $layout = false;

    public $enableCsrfValidation = false;

    public $defaultAction = 'login';

    /**
     * ---------------------------------------
     * 行为控制
     * ---------------------------------------
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'logout'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * ---------------------------------------
     * 登录页
     * ---------------------------------------
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome(); // 默认 index/index
        }

        $model = new LoginForm();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post(), 'info') && $model->login()) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * ---------------------------------------
     * 注销页
     * ---------------------------------------
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Url::toRoute('/login/login'));
    }
}
