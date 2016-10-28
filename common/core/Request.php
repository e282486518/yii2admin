<?php

namespace common\core;

use Yii;


class Request extends \yii\web\Request
{

    /**
     * ---------------------------------------
     * 获取页面GET/POST数据
     * @param string $name 参数名
     * @param string $defaultValue 默认值
     * @return  mixed
     * ---------------------------------------
     */
    public function param($name, $defaultValue = null)
    {
        $value = $this->get($name);
        $value = (!empty($value)) ? $this->get($name) : $this->post($name);
        $value = (!empty($value)) ? $value : $defaultValue;
        return $value;
    }

    /**
     * ---------------------------------------
     * 获取页面GET/POST的int数据
     * @param string $name 参数名
     * @param string $defaultValue 默认值
     * @return mixed 
     * ---------------------------------------
     */
    public function paramInt($name, $defaultValue = null)
    {
        return intval($this->param($name, $defaultValue));
    }
}
