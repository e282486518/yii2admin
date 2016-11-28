<?php

namespace frontend\controllers;

use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex()
    {
        //phpinfo();
        return $this->render('index');
    }
    
}
