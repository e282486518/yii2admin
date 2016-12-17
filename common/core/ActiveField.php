<?php
namespace common\core;

use Yii;
use common\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{

    /* 配置field模板 */
    public $template = '<div>{label}{hint}</div>{input}{error}';

    /* field 选项 */
    public $options = ['class' => 'form-group'];

    /* input选项 */
    public $inputOptions = ['class' => 'form-control c-md-4'];

    /* label标签选项 */
    public $labelOptions = ['class' => ''];

    /* tip 提示标签选项 */
    public $hintOptions = ['tag'=>'span', 'class' => 'help-inline'];

    /* error 错误选项 */
    public $errorOptions = ['tag'=>'span', 'class' => 'help-block'];

    public $enableClientValidation = true;

    /**
     * ---------------------------------------
     * 带前置/后置图标的input
     * @param array $options
     * @return $this
     * ---------------------------------------
     */
    public function iconTextInput($options = []){


        /* 设置图标左右位置 */
        $icon_pos = isset($options['iconPos']) ? $options['iconPos'] : 'left';
        /* 设置图标样式 */
        $icon_class = isset($options['iconClass']) ? $options['iconClass'] : 'icon-user';
        $icon_tag = Html::tag('i', '', ['class'=>$icon_class]);

        $input = Html::activeTextInput($this->model, $this->attribute, $options);
        $input = $icon_pos == 'left'?$icon_tag.$input:$input.$icon_tag;

        $this->parts['{input}'] = Html::tag('div', $input, ['class'=>'input-icon '.$icon_pos]);

        return $this;
    }

    /**
     * ---------------------------------------
     * radio单选
     * @param array $items
     * @param array $options
     * @param string $class
     * @return $this
     * ---------------------------------------
     */
    public function radioList($items, $options = [], $class='mt-radio mt-radio-outline'){
        $class = $class ? $class : 'radio';
        $options = array_merge([
            'tag'=>false,
            'encode'=>false,
            'itemOptions'=>[
                'labelOptions'=>[
                    'class' => $class,
                    'style' => 'padding-right:20px;margin-bottom:5px;',
                ],
            ]
        ], $options);
        
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeRadioList($this->model, $this->attribute, $items, $options);
        
        return $this;
    }

    /**
     * ---------------------------------------
     * checkbox多选
     * @param array $items
     * @param array $options
     * @param string $class
     * @return $this
     * ---------------------------------------
     */
    public function checkboxList($items, $options = [], $class='mt-checkbox mt-checkbox-outline'){
        $class = $class ? $class : 'mt-checkbox';
        $options = array_merge([
            'tag'=>false,
            'itemOptions'=>[
                'labelOptions'=>[
                    'class'=>$class,
                    'style' => 'padding-right:20px;margin-bottom:5px;',
                ]
            ]
        ], $options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeCheckboxList($this->model, $this->attribute, $items, $options);

        return $this;
    }

    /**
     * ---------------------------------------
     * select下拉框
     * @param array $items
     * @param array $options
     * @return \yii\widgets\ActiveField
     * ---------------------------------------
     */
    public function selectList($items, $options = []){
        $options = array_merge(['widthclass'=>''], $options);
        $this->template = '<div>{label}{hint}</div><div class="'.$options['widthclass'].'">{input}</div>{error}';
        return parent::dropDownList($items, $options);
    }

    /**
     * ---------------------------------------
     * widget
     * @param string $class
     * @param array $config
     * @param array $options 主要设置$options['class']
     * @return $this
     * @throws \Exception
     * ---------------------------------------
     */
    public function widget($class, $config = [], $options = [])
    {
        /* @var $class \yii\base\Widget */
        $config['model'] = $this->model;
        $config['attribute'] = $this->attribute;
        $config['view'] = $this->form->getView();
        $options['class'] = isset($options['class'])?$options['class']:'c-md-4';
        $this->parts['{input}'] = '<div class="'.$options['class'].'">'.$class::widget($config).'</div>';

        return $this;
    }

    /**
     * ---------------------------------------
     * 提示信息 处理
     * @param string $content
     * @param array $options
     * @return $this
     * ---------------------------------------
     */
    public function hint($content, $options = [])
    {
        $options = array_merge($this->hintOptions, $options);
        $options['hint'] = $content?'（'.$content.'）':'';
        $this->parts['{hint}'] = Html::activeHint($this->model, $this->attribute, $options);

        return $this;
    }

    /**
     * ---------------------------------------
     * 错误处理
     * @param array $options
     * @return \yii\widgets\ActiveField
     * ---------------------------------------
     */
    public function error($options = []){

        return parent::error($options);
    }
    
}