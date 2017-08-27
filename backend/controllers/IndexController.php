<?php

namespace backend\controllers;

use Yii;

/**
 * 后台首页控制器
 * @author longfei <phphome@qq.com>
 */
class IndexController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
