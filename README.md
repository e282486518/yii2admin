##开发基础说明
1、gii生成的模型统一放在 common\models下，模型统一继承 common\core\BaseActiveRecord  方便扩展yii核心  
2、所有表单模型都继承 common\core\BaseModel  
3、所有控制器都继承 common\core\Controller  
4、所有 自定义助手函数都放在 common\helpers\ 且方法都未static方法  
5、

##服务器配置
```
<VirtualHost *:80>
    ServerName www.yii2.cn

    RewriteEngine on
    DocumentRoot E:\www\haigui\admin

    # 应用前端主要重写规则
    RewriteCond %{HTTP_HOST} ^www.yii2.cn$ [NC]
    RewriteCond %{REQUEST_URI} !^/(backend/web|admin|storage/web)
    RewriteRule !^/frontend/web /frontend/web%{REQUEST_URI} [L]

    # 重定向的网页没有一个斜线（注释，如果必要的话）
    #RewriteCond %{REQUEST_URI} ^/admin/$
    #RewriteRule ^(/admin)/ $1 [L,R=301]
    # 禁止斜线重定向
    RewriteCond %{REQUEST_URI} ^/admin$
    RewriteRule ^/admin /backend/web/index.php [L]
    # 后端应用程序的主要重写规则
    RewriteCond %{REQUEST_URI} ^/admin
    RewriteRule ^/admin(.*) /backend/web$1 [L]

    <Directory />
        Options FollowSymLinks
        AllowOverride None
        AddDefaultCharset utf-8
    </Directory>
    <Directory "E:\www\haigui\admin/frontend/web">
        RewriteEngine on
        # 如果一个目录或一个文件存在，请直接使用请求
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        # 否则去请求 index.php
        RewriteRule . index.php

        Require all granted
    </Directory>
    <Directory "E:\www\haigui\admin/backend/web">
        RewriteEngine on
        # 如果一个目录或一个文件存在，请直接使用请求
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        # 否则去请求 index.php
        RewriteRule . index.php

        Require all granted
    </Directory>
    <Directory "E:\www\haigui\admin/storage/web">
        RewriteEngine on
        # 如果一个目录或一个文件存在，请直接使用请求
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        # 否则去请求 index.php
        RewriteRule . index.php

        Require all granted
    </Directory>
    <FilesMatch \.(htaccess|htpasswd|svn|git)>
        Require all denied
    </FilesMatch>
</VirtualHost>
```
