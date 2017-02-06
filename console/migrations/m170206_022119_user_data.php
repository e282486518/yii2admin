<?php

use yii\db\Migration;

class m170206_022119_user_data extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%user_data}}', [
            'uid' => 'int(10) unsigned NOT NULL COMMENT \'用户id\'',
            'type' => 'tinyint(3) unsigned NOT NULL COMMENT \'类型标识\'',
            'target_id' => 'int(10) unsigned NOT NULL COMMENT \'目标id\'',
            'PRIMARY KEY (`uid`,`type`,`target_id`)'
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('uid','{{%user_data}}','uid, type, target_id',1);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%user_data}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

