<?php

use yii\db\Migration;

class m170206_022119_admin_log extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%admin_log}}', [
            'id' => 'int(8) NOT NULL AUTO_INCREMENT',
            'uid' => 'int(8) NOT NULL COMMENT \'用户uid\'',
            'title' => 'varchar(100) NOT NULL COMMENT \'标题\'',
            'controller' => 'varchar(50) NOT NULL COMMENT \'控制器\'',
            'action' => 'varchar(50) NOT NULL COMMENT \'动作\'',
            'querystring' => 'varchar(255) NOT NULL COMMENT \'查询字符串\'',
            'remark' => 'varchar(255) NOT NULL COMMENT \'备注\'',
            'ip' => 'varchar(15) NOT NULL DEFAULT \'0.0.0.0\' COMMENT \'IP\'',
            'create_time' => 'int(10) NOT NULL DEFAULT \'0\' COMMENT \'创建时间\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台日志'");
        
        /* 索引设置 */
        $this->createIndex('status','{{%admin_log}}','status',0);
        
        
        /* 表数据 */
        $this->insert('{{%admin_log}}',['id'=>'1','uid'=>'2','title'=>'修改菜单','controller'=>'menu','action'=>'index','querystring'=>'/admin.php/menu/index?id=4','remark'=>'用户修改了菜单','ip'=>'192.168.0.101','create_time'=>'1435658950','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%admin_log}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

