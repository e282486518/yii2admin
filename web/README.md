如果你想使用单域名，但感觉高级版原版的单域名配置重写比较麻烦，那么可以使用这种方式。这种方式将每个应用的web目录单独提取出来构成前台、后台、api、存储应用入口。
## 一、基本配置
```
1、将服务器解析到/www/yii2admin/web目录；
2、修改/common/config/params.php的 upload、ueditorConfig 对应上传地址；
    Yii::$app->params['upload']['path'] = Yii::getAlias('@base/web/storage/image/')
    Yii::$app->params['ueditorConfig']['imageRoot']  = Yii::getAlias("@base/web/storage")
    Yii::$app->params['ueditorConfig']['fileRoot']   = ......(同上)
    Yii::$app->params['ueditorConfig']['videoRoot']  = ......(同上)
    Yii::$app->params['ueditorConfig']['scrawlRoot'] = ......(同上)
3、将.env文件中的配置修改为：
    # Urls
    # ---------
    FRONTEND_URL     = /
    BACKEND_URL      = /
    API_URL          = /
    STORAGE_URL      = /
```

## 二、安装 
#### Nginx配置
```
server {
    charset      utf-8;
    client_max_body_size  32M;

    listen       80; ## listen for ipv4
    #listen       [::]:80 default_server ipv6only=on; ## listen for ipv6

    server_name  www.yii2.com;
    root  /vagrant/yii2admin/web;
    index index.php index.html;

    access_log off;
    #access_log   /path/to/logs/advanced.access.log main buffer=50k;
    #error_log    /path/to/logs/advanced.error.log warn;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }
    location /admin {
        try_files $uri $uri/ /admin/index.php?$args;
    }
    location /api {
        try_files $uri $uri/ /api/index.php?$args;
    }
    location /storage {
        try_files $uri $uri/ /storage/index.php?$args;
    }

    include enable-php.conf;
    #error_page  404 /404.html;

    location ~ \.(htaccess|svn|git|env) {
        deny all;
    }
}
```
#### Apache配置
```
    <VirtualHost *:80>
        ServerAdmin webmaster@dummy-host2.example.com
        DocumentRoot "/vagrant/yii2admin/web"
        ServerName  www.yii2.com
        ErrorLog "logs/yii2.com-error.log"
        CustomLog "logs/yii2.com-access.log" common
    </VirtualHost>
    <Directory "/vagrant/yii2admin/web">
        AllowOverride all
        Require all granted
    </Directory>
```