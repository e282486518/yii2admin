<?php

use yii\db\Migration;

class m170206_022119_page extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%page}}', [
            'id' => 'int(8) NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(30) NOT NULL COMMENT \'英文标识\'',
            'title' => 'varchar(100) NOT NULL COMMENT \'标题\'',
            'content' => 'text NOT NULL COMMENT \'内容\'',
            'create_time' => 'int(11) NOT NULL DEFAULT \'0\' COMMENT \'创建时间\'',
            'update_time' => 'int(11) NOT NULL DEFAULT \'0\' COMMENT \'更新时间\'',
            'status' => 'tinyint(2) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='单页面'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%page}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

