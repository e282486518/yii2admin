<?php

use yii\db\Migration;

class m170206_022119_goods_position extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%goods_position}}', [
            'goods_id' => 'int(8) unsigned NOT NULL COMMENT \'商品ID\'',
            'position_id' => 'int(4) unsigned NOT NULL COMMENT \'推荐位ID\'',
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='文章推荐位映射表'");
        
        /* 索引设置 */
        $this->createIndex('goods_id','{{%goods_position}}','goods_id',0);
        $this->createIndex('position_id','{{%goods_position}}','position_id',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%goods_position}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

