<?php

use yii\db\Migration;

class m170206_022119_auth_assignment extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%auth_assignment}}', [
            'item_name' => 'varchar(64) NOT NULL COMMENT \'角色名称 role\'',
            'user_id' => 'varchar(64) NOT NULL COMMENT \'用户ID\'',
            'created_at' => 'int(11) NULL',
            'PRIMARY KEY (`item_name`,`user_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        
        /* 外键约束设置 */
        $this->addForeignKey('fk_auth_item_4494_00','{{%auth_assignment}}', 'item_name', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        $this->insert('{{%auth_assignment}}',['item_name'=>'administrator','user_id'=>'1','created_at'=>'1476437918']);
        $this->insert('{{%auth_assignment}}',['item_name'=>'administrator','user_id'=>'4','created_at'=>'1460012730']);
        $this->insert('{{%auth_assignment}}',['item_name'=>'administrator','user_id'=>'6','created_at'=>'1476438227']);
        $this->insert('{{%auth_assignment}}',['item_name'=>'editor','user_id'=>'2','created_at'=>'1476437926']);
        $this->insert('{{%auth_assignment}}',['item_name'=>'editor','user_id'=>'7','created_at'=>'1481279497']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%auth_assignment}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

