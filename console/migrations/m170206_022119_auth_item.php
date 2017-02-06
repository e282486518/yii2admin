<?php

use yii\db\Migration;

class m170206_022119_auth_item extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%auth_item}}', [
            'name' => 'varchar(64) NOT NULL COMMENT \'角色或权限名称\'',
            'type' => 'int(11) NOT NULL COMMENT \'1角色 2权限\'',
            'description' => 'text NULL',
            'rule_name' => 'varchar(64) NULL',
            'data' => 'text NULL',
            'created_at' => 'int(11) NULL',
            'updated_at' => 'int(11) NULL',
            'PRIMARY KEY (`name`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        $this->createIndex('rule_name','{{%auth_item}}','rule_name',0);
        $this->createIndex('type','{{%auth_item}}','type',0);
        
        
        /* 表数据 */
        $this->insert('{{%auth_item}}',['name'=>'action/actionlog','type'=>'2','description'=>'','rule_name'=>'action/actionlog','data'=>'','created_at'=>'1460031880','updated_at'=>'1460031880']);
        $this->insert('{{%auth_item}}',['name'=>'action/edit','type'=>'2','description'=>'','rule_name'=>'action/edit','data'=>'','created_at'=>'1460031880','updated_at'=>'1460031880']);
        $this->insert('{{%auth_item}}',['name'=>'ad/add','type'=>'2','description'=>NULL,'rule_name'=>'ad/add','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'ad/delete','type'=>'2','description'=>NULL,'rule_name'=>'ad/delete','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'ad/edit','type'=>'2','description'=>NULL,'rule_name'=>'ad/edit','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'ad/index','type'=>'2','description'=>NULL,'rule_name'=>'ad/index','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'Addons/addHook','type'=>'2','description'=>NULL,'rule_name'=>'Addons/addHook','data'=>NULL,'created_at'=>'1472528088','updated_at'=>'1472528088']);
        $this->insert('{{%auth_item}}',['name'=>'Addons/adminList','type'=>'2','description'=>NULL,'rule_name'=>'Addons/adminList','data'=>NULL,'created_at'=>'1472528088','updated_at'=>'1472528088']);
        $this->insert('{{%auth_item}}',['name'=>'Addons/edithook','type'=>'2','description'=>NULL,'rule_name'=>'Addons/edithook','data'=>NULL,'created_at'=>'1472528088','updated_at'=>'1472528088']);
        $this->insert('{{%auth_item}}',['name'=>'Addons/execute','type'=>'2','description'=>NULL,'rule_name'=>'Addons/execute','data'=>NULL,'created_at'=>'1472528088','updated_at'=>'1472528088']);
        $this->insert('{{%auth_item}}',['name'=>'Addons/hooks','type'=>'2','description'=>NULL,'rule_name'=>'Addons/hooks','data'=>NULL,'created_at'=>'1472528088','updated_at'=>'1472528088']);
        $this->insert('{{%auth_item}}',['name'=>'Addons/index','type'=>'2','description'=>'','rule_name'=>'Addons/index','data'=>'','created_at'=>'1460030539','updated_at'=>'1460030539']);
        $this->insert('{{%auth_item}}',['name'=>'admin/add','type'=>'2','description'=>NULL,'rule_name'=>'admin/add','data'=>NULL,'created_at'=>'1472528089','updated_at'=>'1472528089']);
        $this->insert('{{%auth_item}}',['name'=>'admin/auth','type'=>'2','description'=>NULL,'rule_name'=>'admin/auth','data'=>NULL,'created_at'=>'1472528089','updated_at'=>'1472528089']);
        $this->insert('{{%auth_item}}',['name'=>'admin/edit','type'=>'2','description'=>NULL,'rule_name'=>'admin/edit','data'=>NULL,'created_at'=>'1472528089','updated_at'=>'1472528089']);
        $this->insert('{{%auth_item}}',['name'=>'admin/index','type'=>'2','description'=>NULL,'rule_name'=>'admin/index','data'=>NULL,'created_at'=>'1472528089','updated_at'=>'1472528089']);
        $this->insert('{{%auth_item}}',['name'=>'administrator','type'=>'1','description'=>'administrator角色12','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1465352150','updated_at'=>'1476446363']);
        $this->insert('{{%auth_item}}',['name'=>'article/add','type'=>'2','description'=>'','rule_name'=>'article/add','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'article/autoSave','type'=>'2','description'=>'','rule_name'=>'article/autoSave','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'article/batchOperate','type'=>'2','description'=>'','rule_name'=>'article/batchOperate','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'article/clear','type'=>'2','description'=>'','rule_name'=>'article/clear','data'=>'','created_at'=>'1460027927','updated_at'=>'1460027927']);
        $this->insert('{{%auth_item}}',['name'=>'article/copy','type'=>'2','description'=>'','rule_name'=>'article/copy','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'article/edit','type'=>'2','description'=>'','rule_name'=>'article/edit','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'Article/examine','type'=>'2','description'=>'','rule_name'=>'Article/examine','data'=>'','created_at'=>'1460027927','updated_at'=>'1460027927']);
        $this->insert('{{%auth_item}}',['name'=>'article/index','type'=>'2','description'=>'','rule_name'=>'article/index','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'article/move','type'=>'2','description'=>'','rule_name'=>'article/move','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'article/paste','type'=>'2','description'=>'','rule_name'=>'article/paste','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'article/permit','type'=>'2','description'=>'','rule_name'=>'article/permit','data'=>'','created_at'=>'1460027927','updated_at'=>'1460027927']);
        $this->insert('{{%auth_item}}',['name'=>'article/recycle','type'=>'2','description'=>'','rule_name'=>'article/recycle','data'=>'','created_at'=>'1460027927','updated_at'=>'1460027927']);
        $this->insert('{{%auth_item}}',['name'=>'article/setStatus','type'=>'2','description'=>'','rule_name'=>'article/setStatus','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'Article/sort','type'=>'2','description'=>'','rule_name'=>'Article/sort','data'=>'','created_at'=>'1460027927','updated_at'=>'1460027927']);
        $this->insert('{{%auth_item}}',['name'=>'article/update','type'=>'2','description'=>'','rule_name'=>'article/update','data'=>'','created_at'=>'1460027926','updated_at'=>'1460027926']);
        $this->insert('{{%auth_item}}',['name'=>'attribute/add','type'=>'2','description'=>'','rule_name'=>'attribute/add','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        $this->insert('{{%auth_item}}',['name'=>'attribute/edit','type'=>'2','description'=>'','rule_name'=>'attribute/edit','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        $this->insert('{{%auth_item}}',['name'=>'attribute/index1','type'=>'2','description'=>'','rule_name'=>'attribute/index1','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        $this->insert('{{%auth_item}}',['name'=>'attribute/setStatus','type'=>'2','description'=>'','rule_name'=>'attribute/setStatus','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        $this->insert('{{%auth_item}}',['name'=>'attribute/update','type'=>'2','description'=>'','rule_name'=>'attribute/update','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        $this->insert('{{%auth_item}}',['name'=>'auth/access','type'=>'2','description'=>'','rule_name'=>'auth/access','data'=>'','created_at'=>'1460031879','updated_at'=>'1460031879']);
        $this->insert('{{%auth_item}}',['name'=>'auth/add','type'=>'2','description'=>NULL,'rule_name'=>'auth/add','data'=>NULL,'created_at'=>'1472528089','updated_at'=>'1472528089']);
        $this->insert('{{%auth_item}}',['name'=>'auth/addToCategory','type'=>'2','description'=>'','rule_name'=>'auth/addToCategory','data'=>'','created_at'=>'1460031880','updated_at'=>'1460031880']);
        $this->insert('{{%auth_item}}',['name'=>'auth/addToGroup','type'=>'2','description'=>'','rule_name'=>'auth/addToGroup','data'=>'','created_at'=>'1460031880','updated_at'=>'1460031880']);
        $this->insert('{{%auth_item}}',['name'=>'auth/addToModel','type'=>'2','description'=>'','rule_name'=>'auth/addToModel','data'=>'','created_at'=>'1460031880','updated_at'=>'1460031880']);
        $this->insert('{{%auth_item}}',['name'=>'auth/auth','type'=>'2','description'=>'','rule_name'=>'auth/auth','data'=>'','created_at'=>'1460031879','updated_at'=>'1460031879']);
        $this->insert('{{%auth_item}}',['name'=>'auth/category','type'=>'2','description'=>'','rule_name'=>'auth/category','data'=>'','created_at'=>'1460031880','updated_at'=>'1460031880']);
        $this->insert('{{%auth_item}}',['name'=>'auth/changeStatus?method=deleteGroup','type'=>'2','description'=>'','rule_name'=>'auth/changeStatus?method=deleteGroup','data'=>'','created_at'=>'1460031879','updated_at'=>'1460031879']);
        $this->insert('{{%auth_item}}',['name'=>'auth/changeStatus?method=forbidGroup','type'=>'2','description'=>'','rule_name'=>'auth/changeStatus?method=forbidGroup','data'=>'','created_at'=>'1460031879','updated_at'=>'1460031879']);
        $this->insert('{{%auth_item}}',['name'=>'auth/changeStatus?method=resumeGroup','type'=>'2','description'=>'','rule_name'=>'auth/changeStatus?method=resumeGroup','data'=>'','created_at'=>'1460031879','updated_at'=>'1460031879']);
        $this->insert('{{%auth_item}}',['name'=>'auth/createGroup','type'=>'2','description'=>'','rule_name'=>'auth/createGroup','data'=>'','created_at'=>'1460031879','updated_at'=>'1460031879']);
        $this->insert('{{%auth_item}}',['name'=>'auth/delete','type'=>'2','description'=>NULL,'rule_name'=>'auth/delete','data'=>NULL,'created_at'=>'1472528089','updated_at'=>'1472528089']);
        $this->insert('{{%auth_item}}',['name'=>'auth/edit','type'=>'2','description'=>NULL,'rule_name'=>'auth/edit','data'=>NULL,'created_at'=>'1472528089','updated_at'=>'1472528089']);
        $this->insert('{{%auth_item}}',['name'=>'auth/editGroup','type'=>'2','description'=>'','rule_name'=>'auth/editGroup','data'=>'','created_at'=>'1460031879','updated_at'=>'1460031879']);
        $this->insert('{{%auth_item}}',['name'=>'auth/index','type'=>'2','description'=>'','rule_name'=>'auth/index','data'=>'','created_at'=>'1200000000','updated_at'=>'1300000000']);
        $this->insert('{{%auth_item}}',['name'=>'auth/modelauth','type'=>'2','description'=>'','rule_name'=>'auth/modelauth','data'=>'','created_at'=>'1460031880','updated_at'=>'1460031880']);
        $this->insert('{{%auth_item}}',['name'=>'auth/removeFromGroup','type'=>'2','description'=>'','rule_name'=>'auth/removeFromGroup','data'=>'','created_at'=>'1460031880','updated_at'=>'1460031880']);
        $this->insert('{{%auth_item}}',['name'=>'auth/user','type'=>'2','description'=>'','rule_name'=>'auth/user','data'=>'','created_at'=>'1460031880','updated_at'=>'1460031880']);
        $this->insert('{{%auth_item}}',['name'=>'auth/writeGroup','type'=>'2','description'=>'','rule_name'=>'auth/writeGroup','data'=>'','created_at'=>'1460031879','updated_at'=>'1460031879']);
        $this->insert('{{%auth_item}}',['name'=>'category/add','type'=>'2','description'=>'','rule_name'=>'category/add','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'category/edit','type'=>'2','description'=>'','rule_name'=>'category/edit','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'category/index','type'=>'2','description'=>'','rule_name'=>'category/index','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'category/operate/type/merge','type'=>'2','description'=>'','rule_name'=>'category/operate/type/merge','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'category/operate/type/move','type'=>'2','description'=>'','rule_name'=>'category/operate/type/move','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'category/remove','type'=>'2','description'=>'','rule_name'=>'category/remove','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'certificate/delete','type'=>'2','description'=>NULL,'rule_name'=>'certificate/delete','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'certificate/edit','type'=>'2','description'=>NULL,'rule_name'=>'certificate/edit','data'=>NULL,'created_at'=>'1476437983','updated_at'=>'1476437983']);
        $this->insert('{{%auth_item}}',['name'=>'certificate/index','type'=>'2','description'=>NULL,'rule_name'=>'certificate/index','data'=>NULL,'created_at'=>'1476437983','updated_at'=>'1476437983']);
        $this->insert('{{%auth_item}}',['name'=>'channel/add','type'=>'2','description'=>'','rule_name'=>'channel/add','data'=>'','created_at'=>'1460031884','updated_at'=>'1460031884']);
        $this->insert('{{%auth_item}}',['name'=>'channel/del','type'=>'2','description'=>'','rule_name'=>'channel/del','data'=>'','created_at'=>'1460031885','updated_at'=>'1460031885']);
        $this->insert('{{%auth_item}}',['name'=>'channel/edit','type'=>'2','description'=>'','rule_name'=>'channel/edit','data'=>'','created_at'=>'1460031884','updated_at'=>'1460031884']);
        $this->insert('{{%auth_item}}',['name'=>'channel/index','type'=>'2','description'=>'','rule_name'=>'channel/index','data'=>'','created_at'=>'1460031884','updated_at'=>'1460031884']);
        $this->insert('{{%auth_item}}',['name'=>'config/add','type'=>'2','description'=>'','rule_name'=>'config/add','data'=>'','created_at'=>'1460031883','updated_at'=>'1460031883']);
        $this->insert('{{%auth_item}}',['name'=>'config/del','type'=>'2','description'=>'','rule_name'=>'config/del','data'=>'','created_at'=>'1460031883','updated_at'=>'1460031883']);
        $this->insert('{{%auth_item}}',['name'=>'config/edit','type'=>'2','description'=>'','rule_name'=>'config/edit','data'=>'','created_at'=>'1460031883','updated_at'=>'1460031883']);
        $this->insert('{{%auth_item}}',['name'=>'config/group','type'=>'2','description'=>'','rule_name'=>'config/group','data'=>'','created_at'=>'1452653200','updated_at'=>'1452653210']);
        $this->insert('{{%auth_item}}',['name'=>'config/index','type'=>'2','description'=>'','rule_name'=>'config/index','data'=>'','created_at'=>'1452653200','updated_at'=>'1452653210']);
        $this->insert('{{%auth_item}}',['name'=>'config/save','type'=>'2','description'=>'','rule_name'=>'config/save','data'=>'','created_at'=>'1460031883','updated_at'=>'1460031883']);
        $this->insert('{{%auth_item}}',['name'=>'Config/sort','type'=>'2','description'=>'','rule_name'=>'Config/sort','data'=>'','created_at'=>'1460031884','updated_at'=>'1460031884']);
        $this->insert('{{%auth_item}}',['name'=>'database/del','type'=>'2','description'=>'','rule_name'=>'database/del','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'database/export','type'=>'2','description'=>'','rule_name'=>'database/export','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        $this->insert('{{%auth_item}}',['name'=>'database/import','type'=>'2','description'=>'','rule_name'=>'database/import','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'database/index?type=export','type'=>'2','description'=>'数据库导出','rule_name'=>'database/index?type=export','data'=>'','created_at'=>'120000000','updated_at'=>'130000000']);
        $this->insert('{{%auth_item}}',['name'=>'database/index?type=import','type'=>'2','description'=>'数据库导入','rule_name'=>'database/index?type=import','data'=>'','created_at'=>'1200000000','updated_at'=>'1300000000']);
        $this->insert('{{%auth_item}}',['name'=>'database/optimize','type'=>'2','description'=>'','rule_name'=>'database/optimize','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        $this->insert('{{%auth_item}}',['name'=>'database/repair','type'=>'2','description'=>'','rule_name'=>'database/repair','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        $this->insert('{{%auth_item}}',['name'=>'editor','type'=>'1','description'=>'editor 网站编辑角色','rule_name'=>NULL,'data'=>'','created_at'=>'1356232000','updated_at'=>'1400000000']);
        $this->insert('{{%auth_item}}',['name'=>'group/add','type'=>'2','description'=>NULL,'rule_name'=>'group/add','data'=>NULL,'created_at'=>'1476437986','updated_at'=>'1476437986']);
        $this->insert('{{%auth_item}}',['name'=>'group/delete','type'=>'2','description'=>NULL,'rule_name'=>'group/delete','data'=>NULL,'created_at'=>'1476437986','updated_at'=>'1476437986']);
        $this->insert('{{%auth_item}}',['name'=>'group/edit','type'=>'2','description'=>NULL,'rule_name'=>'group/edit','data'=>NULL,'created_at'=>'1476437986','updated_at'=>'1476437986']);
        $this->insert('{{%auth_item}}',['name'=>'group/index','type'=>'2','description'=>NULL,'rule_name'=>'group/index','data'=>NULL,'created_at'=>'1476437986','updated_at'=>'1476437986']);
        $this->insert('{{%auth_item}}',['name'=>'index/index','type'=>'2','description'=>'','rule_name'=>'index/index','data'=>'','created_at'=>'1356542542','updated_at'=>'1425652320']);
        $this->insert('{{%auth_item}}',['name'=>'log/index','type'=>'2','description'=>NULL,'rule_name'=>'log/index','data'=>NULL,'created_at'=>'1472528090','updated_at'=>'1472528090']);
        $this->insert('{{%auth_item}}',['name'=>'log/view','type'=>'2','description'=>NULL,'rule_name'=>'log/view','data'=>NULL,'created_at'=>'1472528090','updated_at'=>'1472528090']);
        $this->insert('{{%auth_item}}',['name'=>'login/logout','type'=>'2','description'=>'','rule_name'=>'login/logout','data'=>'','created_at'=>'1356565230','updated_at'=>'1452653210']);
        $this->insert('{{%auth_item}}',['name'=>'menu/add','type'=>'2','description'=>'','rule_name'=>'menu/add','data'=>'','created_at'=>'1460031884','updated_at'=>'1460031884']);
        $this->insert('{{%auth_item}}',['name'=>'menu/edit','type'=>'2','description'=>'','rule_name'=>'menu/edit','data'=>'','created_at'=>'1460031884','updated_at'=>'1460031884']);
        $this->insert('{{%auth_item}}',['name'=>'Menu/import','type'=>'2','description'=>'','rule_name'=>'Menu/import','data'=>'','created_at'=>'1460031884','updated_at'=>'1460031884']);
        $this->insert('{{%auth_item}}',['name'=>'menu/index','type'=>'2','description'=>'','rule_name'=>'menu/index','data'=>'','created_at'=>'1452653200','updated_at'=>'1452653210']);
        $this->insert('{{%auth_item}}',['name'=>'Menu/sort','type'=>'2','description'=>'','rule_name'=>'Menu/sort','data'=>'','created_at'=>'1460031884','updated_at'=>'1460031884']);
        $this->insert('{{%auth_item}}',['name'=>'model/add','type'=>'2','description'=>'','rule_name'=>'model/add','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'model/edit','type'=>'2','description'=>'','rule_name'=>'model/edit','data'=>'','created_at'=>'1460031883','updated_at'=>'1460031883']);
        $this->insert('{{%auth_item}}',['name'=>'Model/generate','type'=>'2','description'=>'','rule_name'=>'Model/generate','data'=>'','created_at'=>'1460031019','updated_at'=>'1460031019']);
        $this->insert('{{%auth_item}}',['name'=>'Model/index','type'=>'2','description'=>'','rule_name'=>'Model/index','data'=>'','created_at'=>'1460031882','updated_at'=>'1460031882']);
        $this->insert('{{%auth_item}}',['name'=>'model/setStatus','type'=>'2','description'=>'','rule_name'=>'model/setStatus','data'=>'','created_at'=>'1460031883','updated_at'=>'1460031883']);
        $this->insert('{{%auth_item}}',['name'=>'model/update','type'=>'2','description'=>'','rule_name'=>'model/update','data'=>'','created_at'=>'1460031883','updated_at'=>'1460031883']);
        $this->insert('{{%auth_item}}',['name'=>'order/add','type'=>'2','description'=>NULL,'rule_name'=>'order/add','data'=>NULL,'created_at'=>'1476438050','updated_at'=>'1476438050']);
        $this->insert('{{%auth_item}}',['name'=>'order/delete','type'=>'2','description'=>NULL,'rule_name'=>'order/delete','data'=>NULL,'created_at'=>'1476438050','updated_at'=>'1476438050']);
        $this->insert('{{%auth_item}}',['name'=>'order/edit','type'=>'2','description'=>NULL,'rule_name'=>'order/edit','data'=>NULL,'created_at'=>'1476438049','updated_at'=>'1476438049']);
        $this->insert('{{%auth_item}}',['name'=>'order/index','type'=>'2','description'=>NULL,'rule_name'=>'order/index','data'=>NULL,'created_at'=>'1472528088','updated_at'=>'1472528088']);
        $this->insert('{{%auth_item}}',['name'=>'other','type'=>'2','description'=>NULL,'rule_name'=>'other','data'=>NULL,'created_at'=>'1472528090','updated_at'=>'1472528090']);
        $this->insert('{{%auth_item}}',['name'=>'shop/add','type'=>'2','description'=>NULL,'rule_name'=>'shop/add','data'=>NULL,'created_at'=>'1476437985','updated_at'=>'1476437985']);
        $this->insert('{{%auth_item}}',['name'=>'shop/delete','type'=>'2','description'=>NULL,'rule_name'=>'shop/delete','data'=>NULL,'created_at'=>'1476437985','updated_at'=>'1476437985']);
        $this->insert('{{%auth_item}}',['name'=>'shop/edit','type'=>'2','description'=>NULL,'rule_name'=>'shop/edit','data'=>NULL,'created_at'=>'1476437985','updated_at'=>'1476437985']);
        $this->insert('{{%auth_item}}',['name'=>'shop/group','type'=>'2','description'=>NULL,'rule_name'=>'shop/group','data'=>NULL,'created_at'=>'1472528088','updated_at'=>'1472528088']);
        $this->insert('{{%auth_item}}',['name'=>'shop/index','type'=>'2','description'=>NULL,'rule_name'=>'shop/index','data'=>NULL,'created_at'=>'1481279433','updated_at'=>'1481279433']);
        $this->insert('{{%auth_item}}',['name'=>'shop/index&type=1','type'=>'2','description'=>NULL,'rule_name'=>'shop/index&type=1','data'=>NULL,'created_at'=>'1472528087','updated_at'=>'1472528087']);
        $this->insert('{{%auth_item}}',['name'=>'shop/index&type=2','type'=>'2','description'=>NULL,'rule_name'=>'shop/index&type=2','data'=>NULL,'created_at'=>'1472528087','updated_at'=>'1472528087']);
        $this->insert('{{%auth_item}}',['name'=>'shop/index&type=3','type'=>'2','description'=>NULL,'rule_name'=>'shop/index&type=3','data'=>NULL,'created_at'=>'1472528087','updated_at'=>'1472528087']);
        $this->insert('{{%auth_item}}',['name'=>'shop/index&type=4','type'=>'2','description'=>NULL,'rule_name'=>'shop/index&type=4','data'=>NULL,'created_at'=>'1472528088','updated_at'=>'1472528088']);
        $this->insert('{{%auth_item}}',['name'=>'shop/index?type=1','type'=>'2','description'=>NULL,'rule_name'=>'shop/index?type=1','data'=>NULL,'created_at'=>'1476437985','updated_at'=>'1476437985']);
        $this->insert('{{%auth_item}}',['name'=>'shop/index?type=2','type'=>'2','description'=>NULL,'rule_name'=>'shop/index?type=2','data'=>NULL,'created_at'=>'1476437986','updated_at'=>'1476437986']);
        $this->insert('{{%auth_item}}',['name'=>'shop/index?type=3','type'=>'2','description'=>NULL,'rule_name'=>'shop/index?type=3','data'=>NULL,'created_at'=>'1476437986','updated_at'=>'1476437986']);
        $this->insert('{{%auth_item}}',['name'=>'shop/index?type=4','type'=>'2','description'=>NULL,'rule_name'=>'shop/index?type=4','data'=>NULL,'created_at'=>'1476437986','updated_at'=>'1476437986']);
        $this->insert('{{%auth_item}}',['name'=>'think/add','type'=>'2','description'=>'','rule_name'=>'think/add','data'=>'','created_at'=>'1460031883','updated_at'=>'1460031883']);
        $this->insert('{{%auth_item}}',['name'=>'think/edit','type'=>'2','description'=>'','rule_name'=>'think/edit','data'=>'','created_at'=>'1460031019','updated_at'=>'1460031019']);
        $this->insert('{{%auth_item}}',['name'=>'think/lists','type'=>'2','description'=>'','rule_name'=>'think/lists','data'=>'','created_at'=>'1460031020','updated_at'=>'1460031020']);
        $this->insert('{{%auth_item}}',['name'=>'train/add','type'=>'2','description'=>NULL,'rule_name'=>'train/add','data'=>NULL,'created_at'=>'1476437985','updated_at'=>'1476437985']);
        $this->insert('{{%auth_item}}',['name'=>'train/delete','type'=>'2','description'=>NULL,'rule_name'=>'train/delete','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'train/edit','type'=>'2','description'=>NULL,'rule_name'=>'train/edit','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'train/index','type'=>'2','description'=>NULL,'rule_name'=>'train/index','data'=>NULL,'created_at'=>'1472528088','updated_at'=>'1472528088']);
        $this->insert('{{%auth_item}}',['name'=>'traintype/delete','type'=>'2','description'=>NULL,'rule_name'=>'traintype/delete','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'traintype/edit','type'=>'2','description'=>NULL,'rule_name'=>'traintype/edit','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'traintype/index','type'=>'2','description'=>NULL,'rule_name'=>'traintype/index','data'=>NULL,'created_at'=>'1476437984','updated_at'=>'1476437984']);
        $this->insert('{{%auth_item}}',['name'=>'user/action','type'=>'2','description'=>'','rule_name'=>'user/action','data'=>'','created_at'=>'1460031878','updated_at'=>'1460031878']);
        $this->insert('{{%auth_item}}',['name'=>'user/add','type'=>'2','description'=>'','rule_name'=>'user/add','data'=>'','created_at'=>'1460031878','updated_at'=>'1460031878']);
        $this->insert('{{%auth_item}}',['name'=>'user/addaction','type'=>'2','description'=>'','rule_name'=>'user/addaction','data'=>'','created_at'=>'1460031878','updated_at'=>'1460031878']);
        $this->insert('{{%auth_item}}',['name'=>'user/auth','type'=>'2','description'=>'','rule_name'=>'user/auth','data'=>'','created_at'=>'1460031878','updated_at'=>'1460031878']);
        $this->insert('{{%auth_item}}',['name'=>'User/changeStatus?method=deleteUser','type'=>'2','description'=>'','rule_name'=>'User/changeStatus?method=deleteUser','data'=>'','created_at'=>'1460031879','updated_at'=>'1460031879']);
        $this->insert('{{%auth_item}}',['name'=>'user/changeStatus?method=forbidUser','type'=>'2','description'=>'','rule_name'=>'user/changeStatus?method=forbidUser','data'=>'','created_at'=>'1460031878','updated_at'=>'1460031878']);
        $this->insert('{{%auth_item}}',['name'=>'user/changeStatus?method=resumeUser','type'=>'2','description'=>'','rule_name'=>'user/changeStatus?method=resumeUser','data'=>'','created_at'=>'1460031878','updated_at'=>'1460031878']);
        $this->insert('{{%auth_item}}',['name'=>'user/delete','type'=>'2','description'=>NULL,'rule_name'=>'user/delete','data'=>NULL,'created_at'=>'1476438050','updated_at'=>'1476438050']);
        $this->insert('{{%auth_item}}',['name'=>'user/edit','type'=>'2','description'=>NULL,'rule_name'=>'user/edit','data'=>NULL,'created_at'=>'1476438051','updated_at'=>'1476438051']);
        $this->insert('{{%auth_item}}',['name'=>'user/editaction','type'=>'2','description'=>'','rule_name'=>'user/editaction','data'=>'','created_at'=>'1460031878','updated_at'=>'1460031878']);
        $this->insert('{{%auth_item}}',['name'=>'user/index','type'=>'2','description'=>'','rule_name'=>'user/index','data'=>'','created_at'=>'1200000000','updated_at'=>'1230000000']);
        $this->insert('{{%auth_item}}',['name'=>'user/saveAction','type'=>'2','description'=>'','rule_name'=>'user/saveAction','data'=>'','created_at'=>'1460031878','updated_at'=>'1460031878']);
        $this->insert('{{%auth_item}}',['name'=>'user/setStatus','type'=>'2','description'=>'','rule_name'=>'user/setStatus','data'=>'','created_at'=>'1460031878','updated_at'=>'1460031878']);
        $this->insert('{{%auth_item}}',['name'=>'user/updateNickname','type'=>'2','description'=>'','rule_name'=>'user/updateNickname','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        $this->insert('{{%auth_item}}',['name'=>'user/updatePassword','type'=>'2','description'=>'','rule_name'=>'user/updatePassword','data'=>'','created_at'=>'1460031881','updated_at'=>'1460031881']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%auth_item}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

