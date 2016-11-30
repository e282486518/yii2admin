<?php

namespace frontend\controllers;

use yii\web\Controller;

class IndexController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'main1';

    public function actionIndex()
    {
        //phpinfo();
        return $this->render('index');
    }
    
}
