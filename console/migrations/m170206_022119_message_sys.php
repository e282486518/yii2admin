<?php

use yii\db\Migration;

class m170206_022119_message_sys extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%message_sys}}', [
            'sys_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'自增\'',
            'uid' => 'int(8) unsigned NOT NULL COMMENT \'用户uid\'',
            'message_id' => 'int(10) unsigned NOT NULL COMMENT \'消息ID\'',
            'is_read' => 'tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'是否阅读 0未读 1已读 -1删除\'',
            'PRIMARY KEY (`sys_id`)'
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='站内广播/组消息已读状态'");
        
        /* 索引设置 */
        $this->createIndex('uid','{{%message_sys}}','uid, message_id',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%message_sys}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

