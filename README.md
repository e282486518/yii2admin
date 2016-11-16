特别说明，项目刚刚做不久，而且对yii2有些功能不是很熟，难免有缺陷。有什么建议可以联系我phphome@qq.com  

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
* 图片存储在storage/web/image目录下面。
* 图片上传配置文件在/common/config/params的upload配置项中
* 后台图片上传使用的是backend/controllers/UploadController控制器，上传成功后返回“201610/123456789123.jpg”。结合Yii::$app->params['upload']就可以生成图片路径。
* 同时也可以使用\common\helpers\Html::src()方法生成图片路径。这个函数还可以生成类似“URL/index.php?path=201910/123456789123.jpg&w=100&h=100&fit=crop”的裁剪后的图片。其中URL可以是完整的路径，包含http，其配置在common/config/bootstarp.php的“@storageUrl”中配置。

####2、编辑器使用UEditer(百度的编辑器)  
* 百度编辑器的上传路径配置在\common\comfig\params.php的ueditorConfig配置项


##三、服务器配置

* apache:[点击查看](https://github.com/e282486518/yii2admin/blob/master/doc/htaccess.txt)
* nginx:[点击查看](https://github.com/e282486518/yii2admin/blob/master/doc/nginx.conf)

##四、安装
安装文件正在开发中（打算用console、migrate）。。。
目前安装方法是：1）下载或clone项目；2）执行composer install；3）导入数据库(doc/yii2admin.sql)到本地；4）配置服务器（doc目录有配置文件）

##五、预览
![登录](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/login.png)
![首页](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/index.png)
![管理员](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/admin.png)
![权限](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/auth.png)
![配置](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/config.png)
![数据库](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/database.png)
![列表](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/order.png)
![编辑](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/order_edit.png)
![配置皮肤](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/shop.png)
![手机版](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/order_edit1.png)
