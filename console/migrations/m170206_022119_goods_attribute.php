<?php

use yii\db\Migration;

class m170206_022119_goods_attribute extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%goods_attribute}}', [
            'attr_id' => 'smallint(5) unsigned NOT NULL AUTO_INCREMENT',
            'attr_name' => 'varchar(60) NOT NULL DEFAULT \'\' COMMENT \'属性名\'',
            'attr_type' => 'tinyint(1) unsigned NOT NULL DEFAULT \'0\' COMMENT \'类型：0单选（颜色、尺码）1多选（配件）\'',
            'attr_values' => 'text NOT NULL COMMENT \'可选属性值，多个逗号相隔\'',
            'sort' => 'tinyint(3) unsigned NOT NULL DEFAULT \'0\' COMMENT \'排序，按顺序排\'',
            'PRIMARY KEY (`attr_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品属性值约束'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%goods_attribute}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

