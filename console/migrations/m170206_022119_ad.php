<?php

use yii\db\Migration;

class m170206_022119_ad extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%ad}}', [
            'id' => 'int(8) NOT NULL AUTO_INCREMENT',
            'type' => 'tinyint(3) NOT NULL COMMENT \'类型\'',
            'title' => 'varchar(50) NOT NULL DEFAULT \'\' COMMENT \'标题\'',
            'image' => 'varchar(255) NOT NULL COMMENT \'图片路径\'',
            'url' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'跳转地址\'',
            'sort' => 'int(5) NOT NULL DEFAULT \'0\' COMMENT \'排序\'',
            'create_time' => 'int(10) NOT NULL DEFAULT \'0\' COMMENT \'创建时间\'',
            'update_time' => 'int(10) NOT NULL DEFAULT \'0\' COMMENT \'更新时间\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='图片广告'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%ad}}',['id'=>'1','type'=>'1','title'=>'测试广告1','image'=>'1','url'=>'http://www.imhaigui.com','sort'=>'1','create_time'=>'0','update_time'=>'0','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%ad}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

