<?php

namespace backend\controllers;

use Yii;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
