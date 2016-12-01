<?php

use yii\db\Migration;

class m161201_115701_shop_type extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%shop_type}}', [
            'id' => 'int(4) NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(50) NOT NULL COMMENT \'类型名称\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='房间类型表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%shop_type}}',['id'=>'1','name'=>'房间']);
        $this->insert('{{%shop_type}}',['id'=>'2','name'=>'帆船']);
        $this->insert('{{%shop_type}}',['id'=>'3','name'=>'潜水']);
        $this->insert('{{%shop_type}}',['id'=>'4','name'=>'海钓']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%shop_type}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

