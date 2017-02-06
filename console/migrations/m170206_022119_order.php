<?php

use yii\db\Migration;

class m170206_022119_order extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%order}}', [
            'order_id' => 'int(8) NOT NULL AUTO_INCREMENT',
            'order_sn' => 'char(10) NOT NULL COMMENT \'订单号\'',
            'uid' => 'int(8) NULL DEFAULT \'0\' COMMENT \'用户id\'',
            'name' => 'char(30) NULL DEFAULT \'\' COMMENT \'姓名\'',
            'tel' => 'char(20) NULL DEFAULT \'\' COMMENT \'电话\'',
            'sfz' => 'char(20) NULL DEFAULT \'\' COMMENT \'身份证号\'',
            'type' => 'char(10) NOT NULL COMMENT \'订单类型 shop或train\'',
            'aid' => 'int(8) NOT NULL COMMENT \'商品或培训ID\'',
            'title' => 'varchar(100) NOT NULL COMMENT \'商品名称\'',
            'province' => 'int(6) NULL DEFAULT \'0\' COMMENT \'省\'',
            'city' => 'int(6) NULL DEFAULT \'0\' COMMENT \'市\'',
            'area' => 'int(6) NULL DEFAULT \'0\' COMMENT \'区\'',
            'start_time' => 'int(10) NOT NULL COMMENT \'起租时间\'',
            'end_time' => 'int(10) NOT NULL COMMENT \'退租时间\'',
            'num' => 'int(4) NOT NULL DEFAULT \'1\' COMMENT \'数量\'',
            'pay_status' => 'tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'支付状态 0未支付 1已支付\'',
            'pay_time' => 'int(10) NOT NULL COMMENT \'支付时间\'',
            'pay_type' => 'tinyint(1) unsigned NOT NULL DEFAULT \'1\' COMMENT \'支付类型 1微信 2支付宝 3银联\'',
            'pay_source' => 'tinyint(1) unsigned NOT NULL DEFAULT \'1\' COMMENT \'支付途径 1网站 2微信 3后台\'',
            'create_time' => 'int(10) NOT NULL COMMENT \'订单创建时间\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`order_id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='订单表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%order}}',['order_id'=>'1','order_sn'=>'135555111','uid'=>'6','name'=>'','tel'=>'','sfz'=>'','type'=>'shop','aid'=>'1','title'=>'商品名称','province'=>'150000','city'=>'152200','area'=>'152221','start_time'=>'1345678920','end_time'=>'1345688940','num'=>'1','pay_status'=>'0','pay_time'=>'1486347000','pay_type'=>'1','pay_source'=>'1','create_time'=>'1486347086','status'=>'1']);
        $this->insert('{{%order}}',['order_id'=>'2','order_sn'=>'135555111','uid'=>'7','name'=>'','tel'=>'','sfz'=>'','type'=>'shop','aid'=>'1','title'=>'商品名称1111','province'=>'0','city'=>'0','area'=>'0','start_time'=>'1345678940','end_time'=>'1345688940','num'=>'1','pay_status'=>'1','pay_time'=>'1365668940','pay_type'=>'2','pay_source'=>'2','create_time'=>'1365678940','status'=>'1']);
        $this->insert('{{%order}}',['order_id'=>'3','order_sn'=>'1473787901','uid'=>'0','name'=>'','tel'=>'','sfz'=>'','type'=>'shop','aid'=>'1','title'=>'大床双人房特价','province'=>'0','city'=>'0','area'=>'0','start_time'=>'1473811200','end_time'=>'1474416000','num'=>'1','pay_status'=>'1','pay_time'=>'1473787901','pay_type'=>'1','pay_source'=>'1','create_time'=>'1473787924','status'=>'1']);
        $this->insert('{{%order}}',['order_id'=>'4','order_sn'=>'1473788097','uid'=>'0','name'=>'龙凤','tel'=>'15956985698','sfz'=>'','type'=>'train','aid'=>'3','title'=>'帆船培训2','province'=>'5','city'=>'65','area'=>'629','start_time'=>'1473811200','end_time'=>'1474416000','num'=>'1','pay_status'=>'0','pay_time'=>'1478145300','pay_type'=>'1','pay_source'=>'1','create_time'=>'1473788126','status'=>'1']);
        $this->insert('{{%order}}',['order_id'=>'5','order_sn'=>'1474094023','uid'=>'0','name'=>'111','tel'=>'222','sfz'=>'','type'=>'shop','aid'=>'3','title'=>'大床双人房特价','province'=>'6','city'=>'80','area'=>'748','start_time'=>'1474529400','end_time'=>'1344600','num'=>'1','pay_status'=>'1','pay_time'=>'1480910460','pay_type'=>'2','pay_source'=>'1','create_time'=>'1474094061','status'=>'1']);
        $this->insert('{{%order}}',['order_id'=>'6','order_sn'=>'1480917844','uid'=>'0','name'=>'啥打法是否','tel'=>'13632565266','sfz'=>'','type'=>'shop','aid'=>'3','title'=>'测试酒店1','province'=>'110000','city'=>'110100','area'=>'110106','start_time'=>'1481165400','end_time'=>'1480575000','num'=>'1','pay_status'=>'0','pay_time'=>'1486347060','pay_type'=>'4','pay_source'=>'3','create_time'=>'1486347104','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%order}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

