<?php

use yii\db\Migration;

class m170206_022119_goods extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%goods}}', [
            'goods_id' => 'mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT \'商品id\'',
            'cat_id' => 'smallint(5) unsigned NOT NULL DEFAULT \'0\' COMMENT \'商品所属商品分类id，取值category的cat_id\'',
            'goods_sn' => 'varchar(60) NOT NULL DEFAULT \'\' COMMENT \'商品的唯一货号\'',
            'goods_name' => 'varchar(120) NOT NULL DEFAULT \'\' COMMENT \'商品的名称\'',
            'goods_number' => 'smallint(5) unsigned NOT NULL DEFAULT \'0\' COMMENT \'商品总库存数量，由各sku相加\'',
            'market_price' => 'decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\' COMMENT \'市场售价\'',
            'shop_price' => 'decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\' COMMENT \'本店售价，总价需加sku价\'',
            'goods_cover' => 'int(8) NOT NULL COMMENT \'封面单图，关联图片表\'',
            'goods_album' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'商品相册图组，逗号相隔，关联图片表\'',
            'keywords' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'商品关键字\'',
            'description' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'网站描述\'',
            'content' => 'text NOT NULL COMMENT \'商品详情\'',
            'attribute' => 'text NOT NULL COMMENT \'商品基本属性，序列化数据，这里涉及商品少且不用于搜索\'',
            'warn_number' => 'tinyint(3) unsigned NOT NULL DEFAULT \'1\' COMMENT \'商品报警数量\'',
            'is_promote' => 'tinyint(1) unsigned NOT NULL DEFAULT \'0\' COMMENT \'是否促销 1是 0否\'',
            'promote_price' => 'decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\' COMMENT \'促销价格\'',
            'promote_start_date' => 'int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'促销价格开始日期\'',
            'promote_end_date' => 'int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'促销价格结束日期\'',
            'is_real' => 'tinyint(2) unsigned NOT NULL DEFAULT \'1\' COMMENT \'是否是实物，1是 0否\'',
            'integral' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'花费积分，暂供积分商城用\'',
            'give_integral' => 'int(8) NOT NULL DEFAULT \'0\' COMMENT \'购买后赠送的积分数量\'',
            'view' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'查看数\'',
            'up' => 'int(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'喜欢数\'',
            'down' => 'int(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'不喜欢数\'',
            'create_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'添加时间\'',
            'update_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'修改时间\'',
            'sort' => 'smallint(4) NOT NULL DEFAULT \'10\' COMMENT \'顺序排序值\'',
            'status' => 'tinyint(1) unsigned NOT NULL DEFAULT \'0\' COMMENT \'状态0回收站 1正常\'',
            'PRIMARY KEY (`goods_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品详情'");
        
        /* 索引设置 */
        $this->createIndex('goods_sn','{{%goods}}','goods_sn',0);
        $this->createIndex('cat_id','{{%goods}}','cat_id',0);
        $this->createIndex('last_update','{{%goods}}','update_time',0);
        $this->createIndex('promote_end_date','{{%goods}}','promote_end_date',0);
        $this->createIndex('promote_start_date','{{%goods}}','promote_start_date',0);
        $this->createIndex('goods_number','{{%goods}}','goods_number',0);
        $this->createIndex('sort_order','{{%goods}}','sort',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%goods}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

