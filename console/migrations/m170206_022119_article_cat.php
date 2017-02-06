<?php

use yii\db\Migration;

class m170206_022119_article_cat extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%article_cat}}', [
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'分类ID\'',
            'pid' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'上级分类ID\'',
            'name' => 'varchar(30) NOT NULL COMMENT \'标志\'',
            'title' => 'varchar(50) NOT NULL COMMENT \'标题\'',
            'link' => 'varchar(250) NULL DEFAULT \'\' COMMENT \'外链\'',
            'extend' => 'text NULL COMMENT \'扩展设置\'',
            'meta_title' => 'varchar(50) NULL DEFAULT \'\' COMMENT \'SEO的网页标题\'',
            'keywords' => 'varchar(255) NULL DEFAULT \'\' COMMENT \'关键字\'',
            'description' => 'varchar(255) NULL DEFAULT \'\' COMMENT \'描述\'',
            'create_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'创建时间\'',
            'update_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'更新时间\'',
            'sort' => 'int(10) NOT NULL DEFAULT \'0\' COMMENT \'排序（同级有效）\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'数据状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='分类表'");
        
        /* 索引设置 */
        $this->createIndex('uk_name','{{%article_cat}}','name',1);
        $this->createIndex('pid','{{%article_cat}}','pid',0);
        
        
        /* 表数据 */
        $this->insert('{{%article_cat}}',['id'=>'1','pid'=>'0','name'=>'about','title'=>'关于我们','link'=>'','extend'=>'','meta_title'=>'','keywords'=>'','description'=>'','create_time'=>'1379474947','update_time'=>'1479373724','sort'=>'10','status'=>'1']);
        $this->insert('{{%article_cat}}',['id'=>'3','pid'=>'0','name'=>'event','title'=>'活动','link'=>'','extend'=>'a:2:{s:2:"sd";s:2:"11";s:4:"sdfs";s:3:"222";}','meta_title'=>'测试标题','keywords'=>'测试seo关键词','description'=>'测试描述','create_time'=>'1471947194','update_time'=>'1473604631','sort'=>'1','status'=>'1']);
        $this->insert('{{%article_cat}}',['id'=>'4','pid'=>'1','name'=>'lianxi','title'=>'联系我们','link'=>'','extend'=>'','meta_title'=>'','keywords'=>'','description'=>'','create_time'=>'1479368832','update_time'=>'0','sort'=>'0','status'=>'1']);
        $this->insert('{{%article_cat}}',['id'=>'5','pid'=>'3','name'=>'xin','title'=>'最新活动','link'=>'','extend'=>'','meta_title'=>'','keywords'=>'','description'=>'','create_time'=>'1479368867','update_time'=>'1479373985','sort'=>'10','status'=>'1']);
        $this->insert('{{%article_cat}}',['id'=>'6','pid'=>'3','name'=>'hot','title'=>'热门活动','link'=>'','extend'=>'','meta_title'=>'','keywords'=>'','description'=>'','create_time'=>'1479373707','update_time'=>'1481280086','sort'=>'9','status'=>'1']);
        $this->insert('{{%article_cat}}',['id'=>'7','pid'=>'4','name'=>'lianxi3','title'=>'联系我们3','link'=>'','extend'=>'','meta_title'=>'','keywords'=>'','description'=>'','create_time'=>'1479374778','update_time'=>'0','sort'=>'0','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%article_cat}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

