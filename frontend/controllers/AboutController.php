<?php

namespace frontend\controllers;

use yii\web\Controller;

class AboutController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'main';

    public function actionContact()
    {
        //phpinfo();
        return $this->render('contact');
    }
    
}
