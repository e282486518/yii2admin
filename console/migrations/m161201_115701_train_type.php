<?php

use yii\db\Migration;

class m161201_115701_train_type extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%train_type}}', [
            'id' => 'int(4) NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(50) NOT NULL DEFAULT \'\' COMMENT \'类型名称\'',
            'cover' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'封面\'',
            'ctime' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'添加时间\'',
            'certif_ids' => 'varchar(100) NOT NULL DEFAULT \'\' COMMENT \'证书id\'',
            'description' => 'varchar(255) NOT NULL COMMENT \'内容描述\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='房间类型表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%train_type}}',['id'=>'1','name'=>'帆船','cover'=>'1','ctime'=>'0','certif_ids'=>'1,2,3','description'=>'阿迪法师打发多少阿斯顿发生的发生的发达asd']);
        $this->insert('{{%train_type}}',['id'=>'2','name'=>'海钓','cover'=>'4','ctime'=>'0','certif_ids'=>'1,2,3','description'=>'阿斯顿法师打发规划法国恢复电话打工行']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%train_type}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

