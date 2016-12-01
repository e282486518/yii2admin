<?php

use yii\db\Migration;

class m161201_115701_shop_price extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%shop_price}}', [
            'id' => 'int(8) NOT NULL AUTO_INCREMENT',
            'shop_id' => 'int(8) NOT NULL',
            'day' => 'int(10) NOT NULL',
            'price' => 'decimal(8,2) NOT NULL',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='每日价格列表'");
        
        /* 索引设置 */
        $this->createIndex('hotel_id','{{%shop_price}}','shop_id',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%shop_price}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

