<?php

use yii\db\Migration;

class m170206_022119_message extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%message}}', [
            'message_id' => 'int(8) NOT NULL AUTO_INCREMENT COMMENT \'消息ID\'',
            'appid' => 'varchar(30) NOT NULL COMMENT \'应用ID，格式goods-123\'',
            'type' => 'char(10) NOT NULL DEFAULT \'private\' COMMENT \'消息类型，private一对一，group一对多，system一对全部\'',
            'from_uid' => 'int(8) unsigned NOT NULL COMMENT \'消息发送者uid，0系统\'',
            'to_uid' => 'int(8) unsigned NOT NULL COMMENT \'消息接收者uid，0广播/组消息须配合message_sys表\'',
            'content' => 'varchar(255) NOT NULL COMMENT \'消息内容\'',
            'create_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'创建时间\'',
            'end_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'广播消息结束时间，定期清理过期消息，0为不清理\'',
            'is_read' => 'tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'是否阅读 0未读 1已读 -1删除\'',
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

