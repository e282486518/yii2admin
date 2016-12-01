<?php

namespace frontend\controllers;

use yii\web\Controller;

class ArticleController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'main';

    public function actionIndex()
    {
        //phpinfo();
        return $this->render('index');
    }
    
}
