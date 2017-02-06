<?php

use yii\db\Migration;

class m170206_022119_captcha extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%captcha}}', [
            'id' => 'int(8) unsigned NOT NULL AUTO_INCREMENT',
            'ip' => 'char(15) NOT NULL DEFAULT \'0.0.0.0\' COMMENT \'IP地址\'',
            'mobile' => 'char(20) NOT NULL COMMENT \'手机号\'',
            'captcha' => 'char(6) NOT NULL COMMENT \'验证码\'',
            'time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'时间\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='验证码表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%captcha}}',['id'=>'1','ip'=>'127.0.0.1','mobile'=>'13631539420','captcha'=>'7978','time'=>'1474196824']);
        $this->insert('{{%captcha}}',['id'=>'2','ip'=>'127.0.0.1','mobile'=>'13631639420','captcha'=>'6743','time'=>'1474197192']);
        $this->insert('{{%captcha}}',['id'=>'3','ip'=>'59.40.134.141','mobile'=>'13631539420','captcha'=>'8879','time'=>'1474199719']);
        $this->insert('{{%captcha}}',['id'=>'4','ip'=>'59.40.134.141','mobile'=>'13631639420','captcha'=>'1111','time'=>'1474206930']);
        $this->insert('{{%captcha}}',['id'=>'5','ip'=>'113.116.72.128','mobile'=>'13631539420','captcha'=>'2216','time'=>'1474278556']);
        $this->insert('{{%captcha}}',['id'=>'6','ip'=>'113.116.72.128','mobile'=>'13631539420','captcha'=>'6349','time'=>'1474279293']);
        $this->insert('{{%captcha}}',['id'=>'7','ip'=>'113.116.72.128','mobile'=>'13631539420','captcha'=>'8966','time'=>'1474279946']);
        $this->insert('{{%captcha}}',['id'=>'8','ip'=>'14.154.236.128','mobile'=>'13631539420','captcha'=>'4171','time'=>'1474281062']);
        $this->insert('{{%captcha}}',['id'=>'9','ip'=>'14.154.236.128','mobile'=>'13631539420','captcha'=>'3651','time'=>'1474281145']);
        $this->insert('{{%captcha}}',['id'=>'10','ip'=>'116.6.88.148','mobile'=>'18665354960','captcha'=>'8448','time'=>'1474334541']);
        $this->insert('{{%captcha}}',['id'=>'11','ip'=>'113.104.231.102','mobile'=>'13421839870','captcha'=>'3321','time'=>'1474365606']);
        $this->insert('{{%captcha}}',['id'=>'12','ip'=>'113.104.231.102','mobile'=>'13421839870','captcha'=>'8593','time'=>'1474378859']);
        $this->insert('{{%captcha}}',['id'=>'13','ip'=>'113.104.231.102','mobile'=>'13421839870','captcha'=>'6249','time'=>'1474380034']);
        $this->insert('{{%captcha}}',['id'=>'14','ip'=>'113.104.231.102','mobile'=>'13421839870','captcha'=>'9893','time'=>'1474380089']);
        $this->insert('{{%captcha}}',['id'=>'15','ip'=>'113.104.231.102','mobile'=>'13316922246','captcha'=>'9521','time'=>'1474380153']);
        $this->insert('{{%captcha}}',['id'=>'16','ip'=>'113.104.231.115','mobile'=>'13421839870','captcha'=>'1606','time'=>'1474443343']);
        $this->insert('{{%captcha}}',['id'=>'17','ip'=>'113.104.231.115','mobile'=>'13421839870','captcha'=>'9673','time'=>'1474443423']);
        $this->insert('{{%captcha}}',['id'=>'18','ip'=>'113.104.231.115','mobile'=>'13421839870','captcha'=>'3285','time'=>'1474443621']);
        $this->insert('{{%captcha}}',['id'=>'19','ip'=>'183.11.157.104','mobile'=>'13631539420','captcha'=>'6292','time'=>'1474444126']);
        $this->insert('{{%captcha}}',['id'=>'20','ip'=>'183.11.157.104','mobile'=>'13631539420','captcha'=>'3221','time'=>'1474444208']);
        $this->insert('{{%captcha}}',['id'=>'21','ip'=>'113.104.231.115','mobile'=>'13421839870','captcha'=>'9664','time'=>'1474444261']);
        $this->insert('{{%captcha}}',['id'=>'22','ip'=>'113.104.231.115','mobile'=>'13421839870','captcha'=>'6477','time'=>'1474444479']);
        $this->insert('{{%captcha}}',['id'=>'23','ip'=>'120.234.16.114','mobile'=>'13316922246','captcha'=>'2312','time'=>'1474612724']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%captcha}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

