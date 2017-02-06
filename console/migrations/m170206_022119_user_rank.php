<?php

use yii\db\Migration;

class m170206_022119_user_rank extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%user_rank}}', [
            'id' => 'int(3) NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(30) NOT NULL COMMENT \'等级名称\'',
            'score' => 'int(8) NOT NULL COMMENT \'积分界限\'',
            'discount' => 'decimal(6,2) NOT NULL DEFAULT \'0.00\' COMMENT \'折扣百分比\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员等级配置'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%user_rank}}',['id'=>'1','title'=>'普通会员','score'=>'0','discount'=>'0.00','status'=>'1']);
        $this->insert('{{%user_rank}}',['id'=>'2','title'=>'一级会员','score'=>'2000','discount'=>'3.00','status'=>'1']);
        $this->insert('{{%user_rank}}',['id'=>'3','title'=>'二级会员','score'=>'5000','discount'=>'6.00','status'=>'1']);
        $this->insert('{{%user_rank}}',['id'=>'4','title'=>'VIP会员','score'=>'10000','discount'=>'10.00','status'=>'1']);
        $this->insert('{{%user_rank}}',['id'=>'5','title'=>'钻石会员','score'=>'100000','discount'=>'20.00','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%user_rank}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

