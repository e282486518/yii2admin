<?php

/**
 * ============================================================
 * 全局公共函数
 * ============================================================
 */
if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        return $value;
    }
}


/**
 * ---------------------------------------
 * 简单的输出调试函数
 * ---------------------------------------
 */
function dump($var, $depth = 10, $highlight = false){
    \yii\helpers\VarDumper::dump($var, $depth, $highlight);
}


/**
 * ============================================================
 * 常量或环境配置
 * ============================================================
 */

/**
 * 从根目录的 .env 文件中 加载应用环境变量
 * Load application environment from .env file
 */
if (is_file(dirname(__DIR__) . '/.env')) {
    (new \Dotenv\Dotenv(dirname(__DIR__)))->load();
}

/**
 * 初始化全局常量
 * Init application constants
 */
defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG', 'true'));
defined('YII_ENV')   or define('YII_ENV', env('YII_ENV', 'dev'));


