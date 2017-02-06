<?php

use yii\db\Migration;

class m170206_022119_nav extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%nav}}', [
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'文档ID\'',
            'title' => 'varchar(50) NOT NULL DEFAULT \'\' COMMENT \'标题\'',
            'url' => 'char(255) NOT NULL DEFAULT \'\' COMMENT \'链接地址\'',
            'pid' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'上级分类ID\'',
            'sort' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'排序（同级有效）\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'状态1正常0隐藏\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='前台栏目'");
        
        /* 索引设置 */
        $this->createIndex('pid','{{%nav}}','pid',0);
        $this->createIndex('status','{{%nav}}','status',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%nav}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

