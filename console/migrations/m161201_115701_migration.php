<?php

use yii\db\Migration;

class m161201_115701_migration extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%migration}}', [
            'version' => 'varchar(180) NOT NULL',
            'apply_time' => 'int(11) NULL',
            'PRIMARY KEY (`version`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%migration}}',['version'=>'m000000_000000_base','apply_time'=>'1480593333']);
        $this->insert('{{%migration}}',['version'=>'m161201_115249_auth_rule','apply_time'=>'1480593337']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%migration}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

