<?php

use yii\db\Migration;

class m161201_115701_shop extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%shop}}', [
            'id' => 'int(8) unsigned NOT NULL AUTO_INCREMENT',
            'type' => 'int(4) NOT NULL COMMENT \'房间类型\'',
            'title' => 'varchar(100) NOT NULL COMMENT \'标题\'',
            'description' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'描述\'',
            'cover' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'封面图\'',
            'images' => 'varchar(255) NOT NULL COMMENT \'图组\'',
            'imagess' => 'varchar(255) NULL',
            'num' => 'int(3) NOT NULL COMMENT \'房间总数量\'',
            'price' => 'decimal(8,2) NOT NULL COMMENT \'通常价格，格式231.02\'',
            'extend' => 'text NULL COMMENT \'扩展数据\'',
            'sort' => 'int(4) NOT NULL DEFAULT \'0\' COMMENT \'排序值\'',
            'create_time' => 'int(10) unsigned NULL COMMENT \'创建时间\'',
            'update_time' => 'int(10) unsigned NULL COMMENT \'更新时间\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='酒店表'");
        
        /* 索引设置 */
        $this->createIndex('type','{{%shop}}','type',0);
        
        
        /* 表数据 */
        $this->insert('{{%shop}}',['id'=>'1','type'=>'1','title'=>'大床双人房特价','description'=>'111111','cover'=>'1','images'=>'2,1','imagess'=>'','num'=>'111','price'=>'520.12','extend'=>'a:3:{i:111;s:3:"111";i:222;s:3:"222";i:333;s:3:"333";}','sort'=>'1','create_time'=>'1472638475','update_time'=>'1477967729','status'=>'1']);
        $this->insert('{{%shop}}',['id'=>'2','type'=>'4','title'=>'海钓管理测试测试测试','description'=>'测试测试测试','cover'=>'','images'=>'1,2','imagess'=>'','num'=>'133','price'=>'421.00','extend'=>'a:3:{i:11;s:2:"11";i:22;s:2:"22";i:33;s:2:"33";}','sort'=>'3','create_time'=>'1472639234','update_time'=>NULL,'status'=>'1']);
        $this->insert('{{%shop}}',['id'=>'3','type'=>'1','title'=>'测试酒店1','description'=>'测试酒店1','cover'=>'1','images'=>'1,2,12','imagess'=>'1,2,6,8,11','num'=>'4','price'=>'420.23','extend'=>'a:1:{s:3:"sss";s:5:"sadfa";}','sort'=>'0','create_time'=>'1473835350','update_time'=>'1478854674','status'=>'1']);
        $this->insert('{{%shop}}',['id'=>'4','type'=>'2','title'=>'测试帆船标题','description'=>'测试商品描述测试商品描述测试商品描述测试商品描述测试商品描述','cover'=>'5','images'=>'1,2','imagess'=>'','num'=>'111','price'=>'333.00','extend'=>'a:1:{i:0;s:0:"";}','sort'=>'0','create_time'=>'1474176248','update_time'=>'1477984726','status'=>'1']);
        $this->insert('{{%shop}}',['id'=>'5','type'=>'3','title'=>'测试潜水标题','description'=>'商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述','cover'=>'7','images'=>'1,2,4','imagess'=>'','num'=>'200','price'=>'900.00','extend'=>'a:1:{i:0;s:0:"";}','sort'=>'0','create_time'=>'1474176308','update_time'=>'1477984761','status'=>'1']);
        $this->insert('{{%shop}}',['id'=>'6','type'=>'1','title'=>'666666','description'=>'666666666666','cover'=>'1','images'=>'1','imagess'=>'','num'=>'6','price'=>'2288.00','extend'=>'a:1:{i:0;s:15:"dssdfsfsdfdsfsa";}','sort'=>'1','create_time'=>'1474213219','update_time'=>'1477967739','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%shop}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

