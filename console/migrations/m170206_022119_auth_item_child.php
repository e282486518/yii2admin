<?php

use yii\db\Migration;

class m170206_022119_auth_item_child extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%auth_item_child}}', [
            'parent' => 'varchar(64) NOT NULL',
            'child' => 'varchar(64) NOT NULL',
            'PRIMARY KEY (`parent`,`child`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        $this->createIndex('child','{{%auth_item_child}}','child',0);
        
        /* 外键约束设置 */
        $this->addForeignKey('fk_auth_item_4718_00','{{%auth_item_child}}', 'parent', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE' );
        $this->addForeignKey('fk_auth_item_4718_01','{{%auth_item_child}}', 'child', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'ad/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'ad/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'ad/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'ad/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'ad/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'ad/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'ad/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'ad/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'admin/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/autoSave']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/autoSave']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/clear']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/clear']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/move']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/move']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/permit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/permit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/recycle']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/recycle']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/setStatus']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/setStatus']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'article/update']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'article/update']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'attribute/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'attribute/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'attribute/index1']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'attribute/setStatus']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'attribute/update']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'auth/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'category/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'category/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'category/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'category/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'category/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'category/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'category/operate/type/merge']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'category/operate/type/merge']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'category/operate/type/move']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'category/remove']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'category/remove']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'certificate/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'certificate/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'certificate/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'certificate/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'certificate/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'certificate/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'config/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'config/del']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'config/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'config/group']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'config/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'config/save']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'Config/sort']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'database/del']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'database/export']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'database/import']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'database/index?type=export']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'database/index?type=import']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'database/optimize']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'database/repair']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'group/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'group/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'group/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'group/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'group/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'group/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'group/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'group/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'index/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'index/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'log/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'log/view']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'menu/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'menu/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'Menu/import']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'menu/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'Menu/sort']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'order/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'order/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'order/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'order/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'other']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'shop/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'shop/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'shop/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'shop/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'shop/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'shop/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'shop/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'shop/index?type=1']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'shop/index?type=1']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'shop/index?type=2']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'shop/index?type=2']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'shop/index?type=3']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'shop/index?type=3']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'shop/index?type=4']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'shop/index?type=4']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'train/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'train/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'train/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'train/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'train/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'train/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'train/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'train/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'traintype/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'traintype/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'traintype/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'traintype/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'traintype/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'editor','child'=>'traintype/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'user/add']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'user/delete']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'user/edit']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'user/index']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'user/updateNickname']);
        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'user/updatePassword']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%auth_item_child}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

