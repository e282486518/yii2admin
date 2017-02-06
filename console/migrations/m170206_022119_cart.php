<?php

use yii\db\Migration;

class m170206_022119_cart extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%cart}}', [
            'rec_id' => 'mediumint(8) unsigned NOT NULL AUTO_INCREMENT',
            'uid' => 'mediumint(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'用户UID，来自goods表\'',
            'goods_id' => 'mediumint(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'商品ID，来自goods表\'',
            'goods_sn' => 'varchar(60) NOT NULL DEFAULT \'\'',
            'goods_name' => 'varchar(120) NOT NULL DEFAULT \'\' COMMENT \'商品名称，来自goods表\'',
            'market_price' => 'decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\' COMMENT \'市场售价，来自goods表\'',
            'goods_price' => 'decimal(10,2) NOT NULL DEFAULT \'0.00\' COMMENT \'本店售价，来自goods表\'',
            'goods_number' => 'smallint(5) unsigned NOT NULL DEFAULT \'0\' COMMENT \'购买数量\'',
            'goods_attr' => 'text NOT NULL COMMENT \'选择商品的属性\'',
            'PRIMARY KEY (`rec_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%cart}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

