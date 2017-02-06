<?php

use yii\db\Migration;

class m170206_022119_article extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%article}}', [
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'文档ID\'',
            'category_id' => 'int(10) unsigned NOT NULL COMMENT \'所属分类\'',
            'name' => 'char(40) NOT NULL DEFAULT \'\' COMMENT \'标识\'',
            'title' => 'char(80) NOT NULL DEFAULT \'\' COMMENT \'标题\'',
            'cover' => 'int(8) unsigned NULL COMMENT \'封面ID\'',
            'description' => 'char(140) NOT NULL DEFAULT \'\' COMMENT \'描述\'',
            'content' => 'text NOT NULL COMMENT \'内容\'',
            'extend' => 'text NULL COMMENT \'扩展内容array\'',
            'link' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'外链\'',
            'up' => 'int(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'支持数\'',
            'down' => 'int(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'反对数\'',
            'view' => 'int(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'浏览数\'',
            'sort' => 'int(4) NOT NULL DEFAULT \'0\' COMMENT \'排序值\'',
            'create_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'创建时间\'',
            'update_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'更新时间\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'状态0回收站 1正常\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文章表'");
        
        /* 索引设置 */
        $this->createIndex('idx_category_status','{{%article}}','category_id, status',0);
        $this->createIndex('idx_status_type_pid','{{%article}}','status',0);
        
        
        /* 表数据 */
        $this->insert('{{%article}}',['id'=>'3','category_id'=>'1','name'=>'jieshao','title'=>'帆海汇介绍','cover'=>'4','description'=>'帆海汇介绍','content'=>'<p><img src=\"/storage/web/image/201610/1476271961130042.png\" title=\"1476271961130042.png\" alt=\"icon_nav_button.png\"/></p>','extend'=>'','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1473606822','update_time'=>'1476272167','status'=>'1']);
        $this->insert('{{%article}}',['id'=>'2','category_id'=>'1','name'=>'aboutus','title'=>'关于我们','cover'=>'7','description'=>'关于我们','content'=>'<p><img src=\"http://www.yii2.cn/storage/web/image/201611/editor1477984899430443.png\" title=\"editor1477984899430443.png\" alt=\"qrcode.png\"/>这里是关于我们的内容</p>','extend'=>'a:4:{i:1;s:3:"222";i:3;s:4:"3434";i:6;s:5:"sdfsa";s:1:"s";s:4:"sdsf";}','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1472611249','update_time'=>'1477984905','status'=>'1']);
        $this->insert('{{%article}}',['id'=>'4','category_id'=>'1','name'=>'julebu','title'=>'帆船俱乐部','cover'=>'0','description'=>'帆船俱乐部','content'=>'<p>帆船俱乐部帆船俱乐部帆船俱乐部帆船俱乐部帆船俱乐部帆船俱乐部帆船俱乐部</p>','extend'=>'','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1473606857','update_time'=>'0','status'=>'1']);
        $this->insert('{{%article}}',['id'=>'5','category_id'=>'1','name'=>'peixun','title'=>'培训中心','cover'=>'0','description'=>'培训中心','content'=>'<p>培训中心培训中心培训中心培训中心培训中心培训中心培训中心培训中心培训中心培训中心培训中心</p>','extend'=>'','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1473606890','update_time'=>'0','status'=>'1']);
        $this->insert('{{%article}}',['id'=>'6','category_id'=>'1','name'=>'lianxi','title'=>'联系我们','cover'=>'0','description'=>'联系我们','content'=>'<p>联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们</p>','extend'=>'','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1473606916','update_time'=>'0','status'=>'1']);
        $this->insert('{{%article}}',['id'=>'7','category_id'=>'1','name'=>'hezuo','title'=>'合作伙伴','cover'=>'0','description'=>'合作伙伴','content'=>'<p>合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴</p>','extend'=>'','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1473606940','update_time'=>'0','status'=>'1']);
        $this->insert('{{%article}}',['id'=>'8','category_id'=>'3','name'=>'','title'=>'活动内容1111111','cover'=>'0','description'=>'活动内容1111111','content'=>'<p>活动内容1111111活动内容1111111活动内容1111111活动内容1111111活动内容1111111活动内容1111111活动内容1111111活动内容1111111</p>','extend'=>'','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1473607011','update_time'=>'1473608688','status'=>'1']);
        $this->insert('{{%article}}',['id'=>'9','category_id'=>'3','name'=>'','title'=>'活动内容222222','cover'=>'0','description'=>'活动内容222222','content'=>'<p>活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222</p>','extend'=>'','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1473607032','update_time'=>'1473608697','status'=>'1']);
        $this->insert('{{%article}}',['id'=>'10','category_id'=>'3','name'=>'','title'=>'活动内容333333','cover'=>'11','description'=>'活动内容333333','content'=>'<p><img src=\"http://www.yii2.cn/storage/image/201610/editor1477901835457115.png\" title=\"editor1477901835457115.png\" alt=\"icon_nav_dialog.png\"/>活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333</p>','extend'=>'','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1473607048','update_time'=>'1480907210','status'=>'1']);
        $this->insert('{{%article}}',['id'=>'11','category_id'=>'1','name'=>'testabout','title'=>'测试关于我们','cover'=>'13','description'=>'文章描述','content'=>'<p>文章内容<img src=\"/storage/image/201612/editor1481280050913260.png\" title=\"editor1481280050913260.png\" alt=\"ad.png\"/></p>','extend'=>'','link'=>'','up'=>'0','down'=>'0','view'=>'0','sort'=>'0','create_time'=>'1480907480','update_time'=>'1481280055','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%article}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

