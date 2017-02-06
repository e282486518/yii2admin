<?php

use yii\db\Migration;

class m170206_022119_goods_tag extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%goods_tag}}', [
            'goods_id' => 'int(8) NOT NULL COMMENT \'商品ID\'',
            'tag_id' => 'int(8) NOT NULL COMMENT \'标签ID\'',
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='文章标签映射表'");
        
        /* 索引设置 */
        $this->createIndex('goods_id','{{%goods_tag}}','goods_id',0);
        $this->createIndex('tag_id','{{%goods_tag}}','tag_id',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%goods_tag}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

