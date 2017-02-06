<?php

use yii\db\Migration;

class m170206_022119_admin extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%admin}}', [
            'uid' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'用户ID\'',
            'username' => 'char(16) NOT NULL COMMENT \'用户名\'',
            'password' => 'char(60) NOT NULL COMMENT \'密码\'',
            'salt' => 'char(32) NOT NULL COMMENT \'密码干扰字符\'',
            'email' => 'char(32) NOT NULL COMMENT \'用户邮箱\'',
            'mobile' => 'char(15) NOT NULL DEFAULT \'\' COMMENT \'用户手机\'',
            'reg_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'注册时间\'',
            'reg_ip' => 'bigint(20) NOT NULL DEFAULT \'0\' COMMENT \'注册IP\'',
            'last_login_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'最后登录时间\'',
            'last_login_ip' => 'bigint(20) NOT NULL DEFAULT \'0\' COMMENT \'最后登录IP\'',
            'update_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'更新时间\'',
            'status' => 'tinyint(4) NULL DEFAULT \'0\' COMMENT \'用户状态 1正常 0禁用\'',
            'PRIMARY KEY (`uid`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表'");
        
        /* 索引设置 */
        $this->createIndex('username','{{%admin}}','username',1);
        $this->createIndex('email','{{%admin}}','email',1);
        $this->createIndex('status','{{%admin}}','status',0);
        
        
        /* 表数据 */
        $this->insert('{{%admin}}',['uid'=>'1','username'=>'admin','password'=>'$2y$13$0UVcG.mXF6Og0rnjfwJd2.wixT2gdn.wDO9rN44jGtIGc6JvBqR7i','salt'=>'SbSY36BLw3V2lU-GB7ZAzCVJKDFx82IJ','email'=>'phphome111@qq.com','mobile'=>'13565231112','reg_time'=>'1457922160','reg_ip'=>'2130706433','last_login_time'=>'1457922174','last_login_ip'=>'2130706433','update_time'=>'1481278788','status'=>'1']);
        $this->insert('{{%admin}}',['uid'=>'2','username'=>'feifei','password'=>'$2y$13$jqWGlVo8T3qtnWUX0kTX/ON5ctvokzkQ7RAvKuNRjN.WvxgBlFK4u','salt'=>'tzDsmCSLbtktnvbgn1YeEqslYOBo1Cn9','email'=>'php11111@qq.com','mobile'=>'13631568985','reg_time'=>'1458028401','reg_ip'=>'2130706433','last_login_time'=>'1458028401','last_login_ip'=>'2130706433','update_time'=>'1468230085','status'=>'1']);
        $this->insert('{{%admin}}',['uid'=>'6','username'=>'guanli','password'=>'$2y$13$QK.CEi7HHuTSIMbq5RbzeOfTNgrX8mUTl/noBkHtD/zKEf7y.SQO6','salt'=>'_4F9_ptxkohU247kgi7UB4rg3UMYqo14','email'=>'phphome222@qq.com','mobile'=>'13565656565','reg_time'=>'1476438209','reg_ip'=>'2130706433','last_login_time'=>'0','last_login_ip'=>'2130706433','update_time'=>'0','status'=>'1']);
        $this->insert('{{%admin}}',['uid'=>'7','username'=>'huang','password'=>'$2y$13$SO1qMnykM3MJuNizsqzQH.QBjPPDZ7U556yUtmSU3optwZ1EdWm0W','salt'=>'nkqZMhWkbIsjZrF1J8laC1UxWoXPRobA','email'=>'phphome@qqqqq.com','mobile'=>'13656589562','reg_time'=>'1481000197','reg_ip'=>'3232243969','last_login_time'=>'0','last_login_ip'=>'2130706433','update_time'=>'1481003421','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%admin}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

