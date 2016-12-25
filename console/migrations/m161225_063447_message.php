<?php

use yii\db\Migration;

class m161225_063447_message extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%message}}', [
            'message_id' => 'int(8) NOT NULL AUTO_INCREMENT COMMENT \'消息ID\'',
            'appid' => 'varchar(30) NOT NULL COMMENT \'应用ID，格式goods-123\'',
            'from_uid' => 'int(8) unsigned NOT NULL COMMENT \'消息发送者uid，0系统\'',
            'to_uid' => 'int(8) unsigned NOT NULL COMMENT \'消息接收者uid，0广播\'',
            'content' => 'varchar(255) NOT NULL COMMENT \'消息内容\'',
            'create_time' => 'int(10) unsigned NOT NULL COMMENT \'创建时间\'',
            'is_read' => 'tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'是否阅读 0未读 1已读 广播消息始终已读红色文字\'',
            'PRIMARY KEY (`message_id`)'
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='站内消息'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%message}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

