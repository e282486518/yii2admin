成型后的系统包括文章、商城、单页、广告、购物车、订单、标签、评论、推荐位、艾特@、消息、支付和回调、后台rbac、后台行为日志、数据可视化、配置管理等、前台用户中心、会员积分等功能。关注的朋友可以先给个Star。。

特别说明，这是一个学习型的项目（注释会尽量详细，尽量将yii2提供的大部分功能都用一遍）。有什么建议可以联系我：phphome@qq.com

如遇bug请告诉作者哦，花你一分钟时间就可以让项目更易使用.^_^.

github : https://github.com/e282486518/yii2admin 

oschina : http://git.oschina.net/ccdream/yii2admin （国内可以下载这个）

交流：http://www.yiichina.com/code/1052 （遇到bug不愿发邮件的可以贴到这里）

全站打包：https://share.weiyun.com/b0d11485e993bce1ee3398cbbf07e1e4 （不定期更新，安装出错的朋友可以试试这个）


## 一、开发基础说明
* 系统配置文件为.env文件。

* gii生成的模型统一放在 `common\modelsgii`下，模型统一继承 `common\core\BaseActiveRecord` 方便扩展yii核心；

* 所有公共模型放在 `common\models` 下，并继承 `common\modelsgii` 对应模型；

* 所有表单模型都继承 `common\core\BaseModel`；

* 所有控制器都继承 `common\core\Controller` ，每个应用下面应有一个`BaseController`控制器，做为该应用的父控制器，方便做一些公共操作；

* 所有 自定义助手函数都放在 `common\helpers\` 且方法都未`static`方法；

* 公共别名在`common/config/bootstarp.php`中定义，使用`Yii::getAlias()`访问；

* 超级管理员在`\backend\comfig\params.php`的“admin”项中定义其UID，超级管理员不需要进行RBAC权限检查；

* 关于后台中的配置项目，实际是经过转化后(通常在BaseController控制器的init构造函数中转化)，变为`Yii::$app->params['web']`中；
```php
Yii::$app->params['web'] = Config::lists();
```
* 在后台的`BaseController`中有一些通用的方法，例如`saveRow`（添加或编辑一行）、`delRow`（删除一行）、`error`（错误提示）、`success`（成功提示）、`setForward`（标记当前列表url，通常在列表中标记）、`getForward`（获取列表url方便跳转，通常结合error或success使用）；

* 多语言配置在`/common/config/main.php`中“i18n”项中，源语言设置的是中文，具体可自行查看；

* 后台项目的js和css资源文件放在`/common/metronic`中；

* 由于我使用的是模板自带的jQuery和bootstrap，所以我再后台`main.php`的assetManager项中清空了系统自带的jQuery和bootstrap，为了模板全局的js/css放在其他插件的前面，这里我设置了yii\web\JqueryAsset依赖backend\assets\AppAsset，这里要注意循环依赖的问题；

* RBAC权限系统没有使用第三方扩展，其实现大致思路为：一个后台用户对于一个用户组，用户权限和后台栏目一一对应；

* API接口主要使用模块做版本控制，使用RESTfull标准，权限及接口限制参考`/api/models/User.php`；

* 关于后台权限问题，后台权限是与Menu绑定的，在添加功能时先在后台【系统-菜单管理】中添加列表、增、删、改等菜单，然后到【用户-后台用户-权限管理】中【授权】，可以看到刚刚添加的菜单，勾选并提交后对应的用户组就有了该权限；

## 二、上传图片说明

#### 1、上传单图和多图

* 图片上传使用`/common/widgets/images`，需要扩展的可以自行修改，使用的是ajax将图片转化为`base64`编码后上传的；

* 图片存储在`storage/web/image`目录下面。如果服务器解析到`/web`目录，则图片上传地址须修改，详情参考`/web`目录；

* 图片上传配置文件在`/common/config/params`的`upload`配置项中；

* 后台图片上传使用的是`backend/controllers/PbulicController`控制器，上传成功后返回“`201610/123456789123.jpg`”。结合`Yii::$app->params['upload']`就可以生成图片路径。

* 同时也可以使用`\common\helpers\Html::src()`方法生成图片路径。这个函数还可以生成类似“`URL/index.php?path=201910/123456789123.jpg&w=100&h=100&fit=crop`”的裁剪后的图片。其中URL可以是完整的路径，包含http，其配置在`common/config/bootstarp.php`的“`@storageUrl`”中配置。

#### 2、编辑器使用UEditer(百度的编辑器)

* 百度编辑器使用的是大裤衩的扩展，请自行查看；

* 百度编辑器的上传路径配置在`\common\comfig\params.php`的`ueditorConfig`配置项；


## 三、服务器配置

* Apache: [点击查看](https://github.com/e282486518/yii2admin/blob/master/doc/htaccess.txt)

* Nginx: [点击查看](https://github.com/e282486518/yii2admin/blob/master/doc/nginx.conf)

## 四、安装

一键安装方法如下：

```
1、下载源文件或git clone https://github.com/e282486518/yii2admin.git
2、composer install #安装依赖扩展
3、php ./yii install #配置环境、配置数据库并安装数据库
4、参照 doc 目录下的Nginx和Apache配置文件，配置服务器，并设置hosts文件。

超级管理员账号： admin 123456
普通管理员： guanli 123456
编辑人员： feifei 123456
```


## 五、预览
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
![接口调用](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/api.png)
![前台](https://raw.githubusercontent.com/e282486518/yii2admin/master/doc/preview/frontend.png)
