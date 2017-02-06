<?php

use yii\db\Migration;

class m170206_022119_goods_sku extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%goods_sku}}', [
            'sku_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'自增ID\'',
            'goods_id' => 'mediumint(8) unsigned NOT NULL COMMENT \'商品ID\'',
            'properties' => 'varchar(100) NOT NULL COMMENT \'商品特性组合,多个逗号分隔\'',
            'price' => 'decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\' COMMENT \'额外价格\'',
            'number' => 'smallint(5) unsigned NOT NULL DEFAULT \'100\' COMMENT \'库存数量\'',
            'PRIMARY KEY (`sku_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='SKU库存管理表'");
        
        /* 索引设置 */
        $this->createIndex('goods_id','{{%goods_sku}}','goods_id',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%goods_sku}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

