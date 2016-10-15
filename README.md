##一、开发基础说明
1、gii生成的模型统一放在 common\models下，模型统一继承 common\core\BaseActiveRecord  方便扩展yii核心。  

2、所有表单模型都继承 common\core\BaseModel。  

3、所有控制器都继承 common\core\Controller ，每个应用下面应有一个BaseController控制器，做为该应用的父控制器，方便做一些公共操作。  

4、所有 自定义助手函数都放在 common\helpers\ 且方法都未static方法。  

5、公共别名在common/config/bootstarp.php中定义，使用Yii::getAlias()访问。  

6、超级管理员在\backend\comfig\params.php的“admin”项中定义其UID，超级管理员不需要进行RBAC权限检查。  

7、关于后台中的配置项目，实际是经过转化后(通常在BaseController控制器的init构造函数中转化)，变为Yii::$app->params['web']中。  
```
Yii::$app->params['web'] = Config::lists();
```
8、在后台的BaseController中有一些通用的方法，例如addRow（添加一行）、editRow（编辑一行）、delRow（删除一行）、error（错误提示）、success（成功提示）、setForward（标记当前列表url，通常在列表中标记）、getForward（获取列表url方便跳转，通常结合error或success使用）

##二、上传图片说明
####1、上传单图和多图
图片存储在storage/web/image目录下面。  
图片上传配置文件在/common/config/params的upload配置项中  
后台图片上传使用的是backend/controllers/UploadController控制器，上传成功后返回“201610/123456789123.jpg”。结合Yii::$app->params['upload']就可以生成图片路径。  
同时也可以使用\common\helpers\Html::src()方法生成图片路径。这个函数还可以生成类似“URL/index.php?path=201910/123456789123.jpg&w=100&h=100&fit=crop”的裁剪后的图片。其中URL可以是完整的路径，包含http，其配置在common/config/bootstarp.php的“@storageUrl”中配置。  

####2、编辑器使用UEditer(百度的编辑器)  
百度编辑器的上传路径配置在\backend\comfig\main.php的controllerMap中配置  


##三、服务器配置
###1、单域名配置
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

###2、二级域名配置
