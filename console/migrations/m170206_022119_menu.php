<?php

use yii\db\Migration;

class m170206_022119_menu extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%menu}}', [
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'文档ID\'',
            'title' => 'varchar(50) NOT NULL DEFAULT \'\' COMMENT \'标题\'',
            'pid' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'上级分类ID\'',
            'sort' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'排序（同级有效）\'',
            'url' => 'char(255) NOT NULL DEFAULT \'\' COMMENT \'链接地址\'',
            'hide' => 'tinyint(1) unsigned NOT NULL DEFAULT \'0\' COMMENT \'是否隐藏\'',
            'group' => 'varchar(50) NULL DEFAULT \'\' COMMENT \'分组\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('pid','{{%menu}}','pid',0);
        $this->createIndex('status','{{%menu}}','status',0);
        
        
        /* 表数据 */
        $this->insert('{{%menu}}',['id'=>'1','title'=>'首页','pid'=>'0','sort'=>'1','url'=>'index/index','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'2','title'=>'内容','pid'=>'0','sort'=>'2','url'=>'article/index','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'3','title'=>'文章管理','pid'=>'2','sort'=>'1','url'=>'article/index','hide'=>'0','group'=>'文章管理|icon-note','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'4','title'=>'新增','pid'=>'3','sort'=>'0','url'=>'article/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'5','title'=>'编辑','pid'=>'3','sort'=>'0','url'=>'article/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'6','title'=>'删除','pid'=>'3','sort'=>'0','url'=>'article/delete','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'172','title'=>'删除','pid'=>'138','sort'=>'0','url'=>'goods/delete','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'13','title'=>'回收站','pid'=>'2','sort'=>'99','url'=>'article/recycle','hide'=>'1','group'=>'内容','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'14','title'=>'还原','pid'=>'13','sort'=>'0','url'=>'article/permit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'15','title'=>'清空','pid'=>'13','sort'=>'0','url'=>'article/clear','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'16','title'=>'用户','pid'=>'0','sort'=>'4','url'=>'admin/index','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'17','title'=>'管理员管理','pid'=>'16','sort'=>'1','url'=>'admin/index','hide'=>'0','group'=>'后台用户|icon-user','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'18','title'=>'新增管理员','pid'=>'17','sort'=>'0','url'=>'admin/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'137','title'=>'更新','pid'=>'17','sort'=>'0','url'=>'admin/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'144','title'=>'商城套餐','pid'=>'2','sort'=>'29','url'=>'group/index','hide'=>'0','group'=>'商城管理|icon-basket','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'155','title'=>'删除','pid'=>'144','sort'=>'0','url'=>'group/delete','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'27','title'=>'权限管理','pid'=>'16','sort'=>'2','url'=>'auth/index','hide'=>'0','group'=>'后台用户|icon-user','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'28','title'=>'删除','pid'=>'27','sort'=>'0','url'=>'auth/delete','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'29','title'=>'编辑','pid'=>'27','sort'=>'0','url'=>'auth/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'30','title'=>'恢复','pid'=>'27','sort'=>'0','url'=>'auth/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'154','title'=>'编辑','pid'=>'144','sort'=>'0','url'=>'group/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'153','title'=>'添加','pid'=>'144','sort'=>'0','url'=>'group/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'34','title'=>'授权','pid'=>'27','sort'=>'0','url'=>'auth/auth','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'35','title'=>'访问授权','pid'=>'27','sort'=>'0','url'=>'auth/access','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'36','title'=>'成员授权','pid'=>'27','sort'=>'0','url'=>'auth/user','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'145','title'=>'添加','pid'=>'142','sort'=>'0','url'=>'user/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'146','title'=>'编辑','pid'=>'142','sort'=>'0','url'=>'user/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'147','title'=>'删除','pid'=>'142','sort'=>'0','url'=>'user/delete','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'43','title'=>'订单','pid'=>'0','sort'=>'3','url'=>'order/index','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'44','title'=>'订单列表','pid'=>'43','sort'=>'1','url'=>'order/index','hide'=>'0','group'=>'订单管理|fa fa-cny','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'142','title'=>'前台用户','pid'=>'16','sort'=>'20','url'=>'user/index','hide'=>'0','group'=>'前台用户|icon-users','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'55','title'=>'添加','pid'=>'44','sort'=>'0','url'=>'order/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'56','title'=>'编辑','pid'=>'44','sort'=>'0','url'=>'order/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'148','title'=>'删除','pid'=>'44','sort'=>'0','url'=>'order/delete','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'63','title'=>'属性管理','pid'=>'68','sort'=>'0','url'=>'attribute/index1','hide'=>'1','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'64','title'=>'新增','pid'=>'63','sort'=>'0','url'=>'attribute/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'65','title'=>'编辑','pid'=>'63','sort'=>'0','url'=>'attribute/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'66','title'=>'改变状态','pid'=>'63','sort'=>'0','url'=>'attribute/setStatus','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'67','title'=>'保存数据','pid'=>'63','sort'=>'0','url'=>'attribute/update','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'68','title'=>'系统','pid'=>'0','sort'=>'5','url'=>'config/group','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'69','title'=>'网站设置','pid'=>'68','sort'=>'1','url'=>'config/group','hide'=>'0','group'=>'系统设置|icon-settings','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'70','title'=>'配置管理','pid'=>'68','sort'=>'1','url'=>'config/index','hide'=>'0','group'=>'系统设置|icon-settings','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'71','title'=>'编辑','pid'=>'70','sort'=>'0','url'=>'config/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'72','title'=>'删除','pid'=>'70','sort'=>'0','url'=>'config/del','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'73','title'=>'新增','pid'=>'70','sort'=>'0','url'=>'config/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'74','title'=>'保存','pid'=>'70','sort'=>'0','url'=>'config/save','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'75','title'=>'菜单管理','pid'=>'68','sort'=>'5','url'=>'menu/index','hide'=>'0','group'=>'系统设置|icon-settings','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'80','title'=>'分类管理','pid'=>'2','sort'=>'2','url'=>'article-cat/index','hide'=>'0','group'=>'文章管理|icon-note','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'81','title'=>'编辑','pid'=>'80','sort'=>'0','url'=>'article-cat/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'82','title'=>'新增','pid'=>'80','sort'=>'0','url'=>'article-cat/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'83','title'=>'删除','pid'=>'80','sort'=>'0','url'=>'article-cat/delete','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'171','title'=>'编辑','pid'=>'138','sort'=>'0','url'=>'goods/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'170','title'=>'添加','pid'=>'138','sort'=>'0','url'=>'goods/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'86','title'=>'备份数据库','pid'=>'68','sort'=>'10','url'=>'database/index?type=export','hide'=>'0','group'=>'数据备份|fa fa-database','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'87','title'=>'备份','pid'=>'86','sort'=>'0','url'=>'database/export','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'88','title'=>'优化表','pid'=>'86','sort'=>'0','url'=>'database/optimize','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'89','title'=>'修复表','pid'=>'86','sort'=>'0','url'=>'database/repair','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'90','title'=>'还原数据库','pid'=>'68','sort'=>'11','url'=>'database/index?type=import','hide'=>'0','group'=>'数据备份|fa fa-database','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'91','title'=>'恢复','pid'=>'90','sort'=>'0','url'=>'database/import','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'92','title'=>'删除','pid'=>'90','sort'=>'0','url'=>'database/del','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'93','title'=>'其他栏目','pid'=>'0','sort'=>'5','url'=>'other','hide'=>'1','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'96','title'=>'新增','pid'=>'75','sort'=>'0','url'=>'menu/add','hide'=>'0','group'=>'系统设置|icon-legal','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'98','title'=>'编辑','pid'=>'75','sort'=>'0','url'=>'menu/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'106','title'=>'行为日志','pid'=>'16','sort'=>'30','url'=>'admin-log/index','hide'=>'0','group'=>'用户日志|icon-check','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'108','title'=>'修改密码','pid'=>'16','sort'=>'0','url'=>'user/updatePassword','hide'=>'1','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'109','title'=>'修改昵称','pid'=>'16','sort'=>'0','url'=>'user/updateNickname','hide'=>'1','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'110','title'=>'查看行为日志','pid'=>'106','sort'=>'0','url'=>'admin-log/view','hide'=>'1','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'114','title'=>'导入','pid'=>'75','sort'=>'0','url'=>'Menu/import','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'138','title'=>'商品管理','pid'=>'2','sort'=>'20','url'=>'goods/index','hide'=>'0','group'=>'商城管理|icon-basket','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'119','title'=>'排序','pid'=>'70','sort'=>'0','url'=>'Config/sort','hide'=>'1','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'120','title'=>'排序','pid'=>'75','sort'=>'0','url'=>'Menu/sort','hide'=>'1','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'129','title'=>'管理员授权','pid'=>'17','sort'=>'0','url'=>'admin/auth','hide'=>'0','group'=>'','status'=>'0']);
        $this->insert('{{%menu}}',['id'=>'131','title'=>'待完成任务','pid'=>'1','sort'=>'0','url'=>'index/index','hide'=>'0','group'=>'任务列表|icon-speech','status'=>'0']);
        $this->insert('{{%menu}}',['id'=>'159','title'=>'广告管理','pid'=>'2','sort'=>'0','url'=>'ad/index','hide'=>'0','group'=>'广告管理|icon-target','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'160','title'=>'添加','pid'=>'159','sort'=>'0','url'=>'ad/add','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'161','title'=>'编辑','pid'=>'159','sort'=>'0','url'=>'ad/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'162','title'=>'删除','pid'=>'159','sort'=>'0','url'=>'ad/delete','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'166','title'=>'商品属性','pid'=>'2','sort'=>'21','url'=>'attributes/index','hide'=>'0','group'=>'商城管理|icon-basket','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'167','title'=>'添加/修改类型','pid'=>'166','sort'=>'0','url'=>'traintype/edit','hide'=>'0','group'=>'','status'=>'1']);
        $this->insert('{{%menu}}',['id'=>'168','title'=>'删除类型','pid'=>'166','sort'=>'0','url'=>'traintype/delete','hide'=>'0','group'=>'','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%menu}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

