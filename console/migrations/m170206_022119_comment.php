<?php

use yii\db\Migration;

class m170206_022119_comment extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%comment}}', [
            'id' => 'int(8) NOT NULL AUTO_INCREMENT',
            'appid' => 'char(30) NOT NULL COMMENT \'应用ID，格式goods-123\'',
            'uid' => 'int(11) NOT NULL COMMENT \'评论用户ID\'',
            'content' => 'int(11) NOT NULL COMMENT \'评论内容\'',
            'to_comment' => 'int(8) NOT NULL COMMENT \'回复评论ID\'',
            'up' => 'int(6) unsigned NOT NULL DEFAULT \'0\' COMMENT \'支持数\'',
            'down' => 'int(6) unsigned NOT NULL DEFAULT \'0\' COMMENT \'反对数\'',
            'create_time' => 'int(10) NOT NULL COMMENT \'创建时间\'',
            'status' => 'tinyint(2) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='评论'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%comment}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

