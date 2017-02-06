<?php

use yii\db\Migration;

class m170206_022119_user extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%user}}', [
            'uid' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'用户ID\'',
            'username' => 'char(16) NOT NULL COMMENT \'用户名\'',
            'password' => 'char(60) NOT NULL COMMENT \'密码\'',
            'salt' => 'char(32) NOT NULL COMMENT \'密码干扰字符\'',
            'email' => 'char(32) NULL COMMENT \'用户邮箱\'',
            'mobile' => 'char(15) NOT NULL DEFAULT \'\' COMMENT \'用户手机\'',
            'reg_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'注册时间\'',
            'reg_ip' => 'bigint(20) NOT NULL DEFAULT \'0\' COMMENT \'注册IP\'',
            'last_login_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'最后登录时间\'',
            'last_login_ip' => 'bigint(20) NOT NULL DEFAULT \'0\' COMMENT \'最后登录IP\'',
            'update_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'更新时间\'',
            'tuid' => 'int(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'推荐人uid\'',
            'image' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'头像路径\'',
            'score' => 'int(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'当前积分\'',
            'score_all' => 'int(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'总积分\'',
            'allowance' => 'int(5) NOT NULL COMMENT \'api接口调用速率限制\'',
            'allowance_updated_at' => 'int(10) NOT NULL COMMENT \'api接口调用速率限制\'',
            'status' => 'tinyint(4) NULL DEFAULT \'0\' COMMENT \'用户状态 1正常 0禁用\'',
            'PRIMARY KEY (`uid`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表'");
        
        /* 索引设置 */
        $this->createIndex('username','{{%user}}','username',1);
        $this->createIndex('mobile','{{%user}}','mobile',1);
        $this->createIndex('email','{{%user}}','email',1);
        $this->createIndex('status','{{%user}}','status',0);
        
        
        /* 表数据 */
        $this->insert('{{%user}}',['uid'=>'6','username'=>'e282486518','password'=>'$2y$13$oO.xRlrKjMMF/bykb7476.zBIH2RkR6rtv8j5jrYgSxi71AvV3lFG','salt'=>'kXGkWeNSeoK7vakqRfUAviocq-5uy0cN','email'=>'phphome@qq.com','mobile'=>'13656568989','reg_time'=>'1456568652','reg_ip'=>'13654444444','last_login_time'=>'1456568652','last_login_ip'=>'13556464888','update_time'=>'1481279978','tuid'=>'7','image'=>'1','score'=>'10','score_all'=>'0','allowance'=>'4','allowance_updated_at'=>'1480328877','status'=>'1']);
        $this->insert('{{%user}}',['uid'=>'7','username'=>'282486518','password'=>'$2y$13$KIAenVWuR2Tgi1VCKiPegeVsQAHXyDcp9rUmzhqK6TNjL4Cqc3YPa','salt'=>'n9uguceYCqn_jQNd8F6-JRHOj21yltUo','email'=>'phphome@qq.coms','mobile'=>'13645685421','reg_time'=>'1472626509','reg_ip'=>'2130706433','last_login_time'=>'0','last_login_ip'=>'2130706433','update_time'=>'1472626719','tuid'=>'0','image'=>'3','score'=>'1','score_all'=>'1','allowance'=>'0','allowance_updated_at'=>'0','status'=>'0']);
        $this->insert('{{%user}}',['uid'=>'8','username'=>'135232323232','password'=>'$2y$13$UVA5264Qic4g8BDl940x1e0ZefVI3QqpH8tH6bttL/cF8GcU1C7Rm','salt'=>'Dg36PS0QshZ-Y2zhQJa559RSKJULGO_8','email'=>NULL,'mobile'=>'','reg_time'=>'1474112224','reg_ip'=>'2130706433','last_login_time'=>'0','last_login_ip'=>'2130706433','update_time'=>'0','tuid'=>'0','image'=>'','score'=>'0','score_all'=>'0','allowance'=>'0','allowance_updated_at'=>'0','status'=>'0']);
        $this->insert('{{%user}}',['uid'=>'13','username'=>'aabbcc','password'=>'$2y$13$46n16kagedYUXx6WXZ2QkuSGJKm3FDr6iI.KPNzAkHYRHmplqgAiC','salt'=>'OblZ1QuXGGGiXZWTPqfDrCoF_qXVIN3b','email'=>'','mobile'=>'13421839870','reg_time'=>'1474114459','reg_ip'=>'2130706433','last_login_time'=>'0','last_login_ip'=>'2130706433','update_time'=>'1477904302','tuid'=>'0','image'=>'1','score'=>'0','score_all'=>'0','allowance'=>'0','allowance_updated_at'=>'0','status'=>'1']);
        $this->insert('{{%user}}',['uid'=>'14','username'=>'bvbvbv','password'=>'$2y$13$Jm2bfhSnqcSMTaPxRRWiReqrclkApB1Dc20kLTxVNHAzl7J8DH60K','salt'=>'jrYKEga9jbp2H6bsdLjvnEd5mqsRgMMD','email'=>NULL,'mobile'=>'13013013330','reg_time'=>'1474115843','reg_ip'=>'2130706433','last_login_time'=>'0','last_login_ip'=>'2130706433','update_time'=>'0','tuid'=>'0','image'=>'','score'=>'0','score_all'=>'0','allowance'=>'0','allowance_updated_at'=>'0','status'=>'1']);
        $this->insert('{{%user}}',['uid'=>'15','username'=>'hahaha','password'=>'$2y$13$NsuZra9Z/DBaRk3R7tzvnuYrbmV5mIAKTKoksFcYHu3wUyJDaLPz.','salt'=>'BsDuGjz20Uexw6Kq_iw-s8AiqNmtec2u','email'=>NULL,'mobile'=>'13636363636','reg_time'=>'1474192435','reg_ip'=>'2130706433','last_login_time'=>'0','last_login_ip'=>'2130706433','update_time'=>'0','tuid'=>'13','image'=>'','score'=>'0','score_all'=>'0','allowance'=>'0','allowance_updated_at'=>'0','status'=>'1']);
        $this->insert('{{%user}}',['uid'=>'16','username'=>'huanglala','password'=>'$2y$13$FJGFsH1fls8m3DWuxUrN9eJcDQZScQLyYaQIXVeSPK0WMlpT1C.Ze','salt'=>'7EpKjeEwVqYQS7oV0QW7-JNy-UFchvY1','email'=>NULL,'mobile'=>'13631639420','reg_time'=>'1474197294','reg_ip'=>'2130706433','last_login_time'=>'0','last_login_ip'=>'2130706433','update_time'=>'0','tuid'=>'13','image'=>'','score'=>'0','score_all'=>'0','allowance'=>'0','allowance_updated_at'=>'0','status'=>'1']);
        $this->insert('{{%user}}',['uid'=>'17','username'=>'binbin','password'=>'$2y$13$fbFtBRQgoH2PZ3wfCG1KIu8qdXeah.4KFZWI7kAE.4fDxM4lMuJ4q','salt'=>'tjCK1O9VaCtnvlNzRobRlnNHmbADlXPM','email'=>NULL,'mobile'=>'18665354960','reg_time'=>'1474334566','reg_ip'=>'1946572948','last_login_time'=>'0','last_login_ip'=>'1946572948','update_time'=>'0','tuid'=>'6','image'=>'','score'=>'0','score_all'=>'0','allowance'=>'0','allowance_updated_at'=>'0','status'=>'1']);
        $this->insert('{{%user}}',['uid'=>'18','username'=>'lasek001','password'=>'$2y$13$qMb7n1rslyltgaCDNvy/mOcBuTfOmidi8.zXvnURHMqKkVydCj3h2','salt'=>'Fx-LBkD34aXdGkYt8a2S_6Vq991TrW6S','email'=>NULL,'mobile'=>'13316922246','reg_time'=>'1474380169','reg_ip'=>'1902700390','last_login_time'=>'0','last_login_ip'=>'1902700390','update_time'=>'0','tuid'=>'0','image'=>'','score'=>'0','score_all'=>'0','allowance'=>'0','allowance_updated_at'=>'0','status'=>'1']);
        $this->insert('{{%user}}',['uid'=>'19','username'=>'feifeifei','password'=>'$2y$13$MRvZElUImZ.8gMsNV5ZEKuIkdkEamyc1tw/FHoPgQdp5x.WIPOroi','salt'=>'KWzNd8A57uVSMeLpDUB_ol1egfLPJ58C','email'=>NULL,'mobile'=>'13631539420','reg_time'=>'1474444147','reg_ip'=>'3070991720','last_login_time'=>'0','last_login_ip'=>'3070991720','update_time'=>'0','tuid'=>'0','image'=>'','score'=>'0','score_all'=>'0','allowance'=>'0','allowance_updated_at'=>'0','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%user}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

