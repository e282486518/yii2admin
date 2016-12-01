<?php

use yii\db\Migration;

class m161201_115701_train_certificate extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%train_certificate}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(100) NOT NULL DEFAULT \'\' COMMENT \'证书名\'',
            'cover' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'证书图片\'',
            'description' => 'varchar(1000) NOT NULL DEFAULT \'\' COMMENT \'证书简介\'',
            'ctime' => 'int(11) NOT NULL DEFAULT \'0\' COMMENT \'添加时间\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='培训证书表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%train_certificate}}',['id'=>'1','title'=>'AAA认证证书','cover'=>'1','description'=>'证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明','ctime'=>'0']);
        $this->insert('{{%train_certificate}}',['id'=>'2','title'=>'BBB认证证书','cover'=>'4','description'=>'证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明','ctime'=>'0']);
        $this->insert('{{%train_certificate}}',['id'=>'3','title'=>'CCC认证证书','cover'=>'5','description'=>'证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明 ','ctime'=>'0']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%train_certificate}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

