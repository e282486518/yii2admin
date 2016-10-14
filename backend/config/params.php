<?php
return [
    'adminEmail' => 'admin@example.com',

    /* 后台中的配置参数 */
    'web' => [],

    /* 超级管理员的UID */
    'admin' => 1,

    /* 后台错误页面模板 */
    'action_error'     =>  '@backend/views/public/error.php', // 默认错误跳转对应的模板文件
    'action_success'   =>  '@backend/views/public/success.php', // 默认成功跳转对应的模板文件

    /* 后台系统配置 类型 和 分组 */
    'config_type'  => [
        0 => '数字',
        1 => '字符',
        2 => '文本',
        3 => '数组',
        4 => '枚举',
    ],
    'config_group' => [
        0 => '不分组',
        1 => '基本',
        2 => '内容',
        3 => '用户',
        4 => '系统',
    ],


];
