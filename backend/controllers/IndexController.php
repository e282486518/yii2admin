<?php

namespace backend\controllers;

use Yii;

/**
 * 后台首页
 * @author longfei <phphome@qq.com>
 */
class IndexController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
