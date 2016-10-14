<?php
namespace common\core;

use Yii;

class ActiveForm extends \yii\widgets\ActiveForm
{
    /* form表情的默认属性 */
    public $options = [
        'class' => '',
    ];

    /* 字段默认使用的类 */
    public $fieldClass = 'common\core\ActiveField';

    public $errorCssClass = 'has-error';

    public $successCssClass = 'has-success';


}
