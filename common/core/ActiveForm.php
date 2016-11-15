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

    /**
     * 这个是为了使IED能自动识别 $form->field($model, 'name') 的返回值。
     *
     * @param \yii\base\Model $model
     * @param string $attribute
     * @param array $options
     * @return \common\core\ActiveField
     */
    public function field($model, $attribute, $options = [])
    {
        return parent::field($model, $attribute, $options);
    }


}
