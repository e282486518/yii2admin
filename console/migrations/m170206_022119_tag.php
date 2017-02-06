<?php

use yii\db\Migration;

class m170206_022119_tag extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%tag}}', [
            'id' => 'int(8) NOT NULL AUTO_INCREMENT',
            'name' => 'char(30) NOT NULL COMMENT \'标签名\'',
            'num' => 'int(8) NOT NULL DEFAULT \'0\' COMMENT \'有该标签内容数量\'',
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
        $this->dropTable('{{%tag}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

