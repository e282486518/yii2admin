<?php

use yii\db\Migration;

class m161201_115701_shop_group extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%shop_group}}', [
            'id' => 'int(8) NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(50) NOT NULL COMMENT \'套餐标题\'',
            'description' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'描述\'',
            'groups' => 'text NOT NULL COMMENT \'商品组合，数字逗号分隔\'',
            'cover' => 'varchar(255) NOT NULL COMMENT \'封面图\'',
            'images' => 'text NOT NULL COMMENT \'图组\'',
            'total' => 'decimal(8,2) NOT NULL COMMENT \'总价\'',
            'price' => 'decimal(8,2) NOT NULL COMMENT \'套餐价格\'',
            'sort' => 'int(4) NOT NULL DEFAULT \'0\' COMMENT \'排序值\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='套餐设置'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%shop_group}}',['id'=>'2','title'=>'阿斯顿发顺丰','description'=>'沙发沙发啊 沙发阿斯顿发是放大师傅','groups'=>'a:1:{i:1;a:1:{i:3;a:3:{s:4:"days";s:1:"6";s:3:"num";s:1:"6";s:2:"id";s:1:"3";}}}','cover'=>'1','images'=>'1,2','total'=>'15128.28','price'=>'600.00','sort'=>'0','status'=>'1']);
        $this->insert('{{%shop_group}}',['id'=>'4','title'=>'房1天2人潜水1天2人','description'=>'房1天2人潜水1天2人','groups'=>'a:2:{i:1;a:1:{i:1;a:3:{s:4:"days";s:1:"1";s:3:"num";s:1:"2";s:2:"id";s:1:"1";}}i:3;a:1:{i:5;a:3:{s:4:"days";s:1:"1";s:3:"num";s:1:"2";s:2:"id";s:1:"5";}}}','cover'=>'1','images'=>'1,2','total'=>'2840.24','price'=>'998.00','sort'=>'0','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%shop_group}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

