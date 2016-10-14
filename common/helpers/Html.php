<?php

namespace common\helpers;

use Yii;

/**
 * Html provides a set of static methods for generating commonly used HTML tags.
 *
 * Nearly all of the methods in this class allow setting additional html attributes for the html
 * tags they generate. You can specify for example. 'class', 'style'  or 'id' for an html element
 * using the `$options` parameter. See the documentation of the [[tag()]] method for more details.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Html extends \yii\helpers\Html
{
    /*
     * ---------------------------------------
     * 生成 图片路径
     * ---------------------------------------
     */
    public static function src($url,$params = '',$isUrl = false){
        if ($isUrl === false) {
            return Yii::$app->params['upload']['url'].$url;
        }
        $query = 'path='.$url;
        if ($params) {
            $query .= '&'.$params;
        }
        if (Yii::$app->params['storage_encrypt']) {
            $query = 'path='.base64_encode($query);

        }
        return Yii::getAlias('@storageUrl').'/index.php?'.$query;
    }

    public static function radio($name, $checked = false, $options = [])
    {
        $options['checked'] = (bool) $checked;
        $value = array_key_exists('value', $options) ? $options['value'] : '1';
        if (isset($options['uncheck'])) {
            // add a hidden field so that if the radio button is not selected, it still submits a value
            $hidden = static::hiddenInput($name, $options['uncheck']);
            unset($options['uncheck']);
        } else {
            $hidden = '';
        }
        if (isset($options['label'])) {
            $label = $options['label'];
            $labelOptions = isset($options['labelOptions']) ? $options['labelOptions'] : [];
            unset($options['label'], $options['labelOptions']);
            $content = static::label(static::input('radio', $name, $value, $options) . '<span></span> ' . $label, null, $labelOptions);
            return $hidden . $content;
        } else {
            return $hidden . static::input('radio', $name, $value, $options);
        }
    }

    public static function checkbox($name, $checked = false, $options = [])
    {
        $options['checked'] = (bool) $checked;
        $value = array_key_exists('value', $options) ? $options['value'] : '1';
        if (isset($options['uncheck'])) {
            // add a hidden field so that if the checkbox is not selected, it still submits a value
            $hidden = static::hiddenInput($name, $options['uncheck']);
            unset($options['uncheck']);
        } else {
            $hidden = '';
        }
        if (isset($options['label'])) {
            $label = $options['label'];
            $labelOptions = isset($options['labelOptions']) ? $options['labelOptions'] : [];
            unset($options['label'], $options['labelOptions']);
            $content = static::label(static::input('checkbox', $name, $value, $options) . '<span></span> ' . $label, null, $labelOptions);
            return $hidden . $content;
        } else {
            return $hidden . static::input('checkbox', $name, $value, $options);
        }
    }
}
