<?php

namespace api\components;

use Yii;
use yii\rest\ActiveController;
use common\core\TokenAuth;

/**
 * 这里注意是继承 yii\rest\ActiveController 因为源码中已经帮我们实现了index/update等方法
 * 以及其访问规则verbs()等，
 * 其他可参考：http://www.yiichina.com/doc/guide/2.0/rest-controllers
 *
 * 权限采用最简单的QueryParamAuth方式
 * 用户角色权限比较复杂，这里没有做
 *
 * @package api\modules\v1\controllers
 */
class BaseController extends ActiveController
{

    /**
     * ---------------------------------------
     * 构造方法
     *
     * @throws \yii\base\InvalidConfigException
     * @author hlf <phphome@qq.com> 2020/5/21
     * ---------------------------------------
     */
    public function init () {
        parent::init();
        // 多语言，需要在http header中设置 app-language:zh-CN
        Yii::$app->language = Yii::$app->request->getHeaders()->get('app-language'); //'en-US';
    }

    /**
     * ---------------------------------------
     * 行为
     *
     * @return array
     *
     * @author hlf <phphome@qq.com> 2020/5/21
     * ---------------------------------------
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // 设置认证方式
        $behaviors['authenticator'] = [
            'class' => TokenAuth::className(),
        ];
        return $behaviors;
    }



}
