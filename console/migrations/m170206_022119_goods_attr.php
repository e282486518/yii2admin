<?php

use yii\db\Migration;

class m170206_022119_goods_attr extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%goods_attr}}', [
            'goods_attr_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'goods_id' => 'mediumint(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'商品ID\'',
            'attr_id' => 'smallint(5) unsigned NOT NULL DEFAULT \'0\' COMMENT \'属性ID\'',
            'attr_value' => 'text NOT NULL COMMENT \'属性值\'',
            'PRIMARY KEY (`goods_attr_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品属性'");
        
        /* 索引设置 */
        $this->createIndex('goods_id','{{%goods_attr}}','goods_id',0);
        $this->createIndex('attr_id','{{%goods_attr}}','attr_id',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%goods_attr}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

