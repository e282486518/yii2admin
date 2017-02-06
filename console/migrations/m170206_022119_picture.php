<?php

use yii\db\Migration;

class m170206_022119_picture extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%picture}}', [
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'主键id自增\'',
            'path' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'路径\'',
            'md5' => 'char(32) NOT NULL DEFAULT \'\' COMMENT \'文件md5\'',
            'create_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'创建时间\'',
            'status' => 'tinyint(2) NOT NULL DEFAULT \'0\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('md5','{{%picture}}','md5',0);
        
        
        /* 表数据 */
        $this->insert('{{%picture}}',['id'=>'1','path'=>'201610/1477562926256.png','md5'=>'f1510ddb99606c5aa75fdf9c9e245136','create_time'=>'1477562926','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'2','path'=>'201610/1477564226300.png','md5'=>'86375d934477a20aaf0f446b12a17cfb','create_time'=>'1477564226','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'7','path'=>'201611/1477984758635.png','md5'=>'90b4da99d2fc0ea4435b19e674e2ddf0','create_time'=>'1477984758','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'4','path'=>'201610/1477567061651.png','md5'=>'db09e4d570a5d46bda6782cff9ead020','create_time'=>'1477567061','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'5','path'=>'201610/1477894552955.png','md5'=>'3c680300f3ae5c417f1eec06e8e012ca','create_time'=>'1477894552','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'6','path'=>'201610/1477895930794.png','md5'=>'4f9a57edb7971bdcf5195cc79a9ab4f2','create_time'=>'1477895930','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'8','path'=>'201611/1477986537333.png','md5'=>'8a7102fa0ed5cdea5a359f5d068e3838','create_time'=>'1477986537','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'9','path'=>'201611/1478850859946.jpg','md5'=>'b80a764cc220b8044e933df30774b218','create_time'=>'1478850859','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'11','path'=>'201611/1478854002500.jpg','md5'=>'04e145672b976fb47164dd96e0090fd1','create_time'=>'1478854002','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'12','path'=>'201611/1478854666137.jpg','md5'=>'1f611a254f541830ab3a3490e32368c2','create_time'=>'1478854666','status'=>'1']);
        $this->insert('{{%picture}}',['id'=>'13','path'=>'201612/1480907348789.png','md5'=>'6d83a00e11eb16e95fa9200fd7ddc2e2','create_time'=>'1480907348','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%picture}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

