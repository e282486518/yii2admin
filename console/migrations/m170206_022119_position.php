<?php

use yii\db\Migration;

class m170206_022119_position extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%position}}', [
            'position_id' => 'int(4) NOT NULL COMMENT \'推荐位ID\'',
            'name' => 'char(30) NOT NULL COMMENT \'推荐位名称\'',
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='推荐位'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%position}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

