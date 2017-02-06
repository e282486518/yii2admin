<?php

use yii\db\Migration;

class m170206_022119_config extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%config}}', [
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'配置ID\'',
            'name' => 'varchar(30) NOT NULL DEFAULT \'\' COMMENT \'配置名称\'',
            'title' => 'varchar(50) NOT NULL DEFAULT \'\' COMMENT \'配置说明\'',
            'group' => 'tinyint(3) unsigned NOT NULL DEFAULT \'0\' COMMENT \'配置分组\'',
            'type' => 'tinyint(3) unsigned NOT NULL DEFAULT \'0\' COMMENT \'配置类型\'',
            'value' => 'text NULL COMMENT \'配置值\'',
            'extra' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'配置值\'',
            'remark' => 'varchar(100) NOT NULL DEFAULT \'\' COMMENT \'配置说明\'',
            'create_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'创建时间\'',
            'update_time' => 'int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'更新时间\'',
            'sort' => 'smallint(3) unsigned NOT NULL DEFAULT \'0\' COMMENT \'排序\'',
            'status' => 'tinyint(4) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('uk_name','{{%config}}','name',1);
        $this->createIndex('type','{{%config}}','type',0);
        $this->createIndex('group','{{%config}}','group',0);
        
        
        /* 表数据 */
        $this->insert('{{%config}}',['id'=>'1','name'=>'WEB_SITE_TITLE','title'=>'网站标题','group'=>'1','type'=>'1','value'=>'内容管理框架','extra'=>'','remark'=>'网站标题前台显示标题','create_time'=>'1378898976','update_time'=>'1481906498','sort'=>'0','status'=>'1']);
        $this->insert('{{%config}}',['id'=>'2','name'=>'WEB_SITE_DESCRIPTION','title'=>'网站描述','group'=>'1','type'=>'2','value'=>'内容管理框架','extra'=>'','remark'=>'网站搜索引擎描述','create_time'=>'1378898976','update_time'=>'1472528403','sort'=>'1','status'=>'1']);
        $this->insert('{{%config}}',['id'=>'3','name'=>'WEB_SITE_KEYWORD','title'=>'网站关键字','group'=>'1','type'=>'2','value'=>'黄龙飞11','extra'=>'','remark'=>'网站搜索引擎关键字','create_time'=>'1378898976','update_time'=>'1472528403','sort'=>'8','status'=>'1']);
        $this->insert('{{%config}}',['id'=>'4','name'=>'WEB_SITE_CLOSE','title'=>'关闭站点','group'=>'4','type'=>'4','value'=>'1','extra'=>'0:关闭,1:开启','remark'=>'站点关闭后其他用户不能访问，管理员可以正常访问','create_time'=>'1378898976','update_time'=>'1463024280','sort'=>'1','status'=>'0']);
        $this->insert('{{%config}}',['id'=>'9','name'=>'CONFIG_TYPE_LIST','title'=>'配置类型列表','group'=>'3','type'=>'3','value'=>'0:数字
1:字符
2:文本
3:数组
4:枚举','extra'=>'','remark'=>'主要用于数据解析和页面表单的生成','create_time'=>'1378898976','update_time'=>'1463024244','sort'=>'2','status'=>'1']);
        $this->insert('{{%config}}',['id'=>'10','name'=>'WEB_SITE_ICP','title'=>'网站备案号','group'=>'1','type'=>'1','value'=>'沪ICP备12007941号-2','extra'=>'','remark'=>'设置在网站底部显示的备案号，如“沪ICP备12007941号-2','create_time'=>'1378900335','update_time'=>'1472528403','sort'=>'9','status'=>'1']);
        $this->insert('{{%config}}',['id'=>'11','name'=>'DATA_BACKUP_PATH','title'=>'数据库备份路径','group'=>'4','type'=>'1','value'=>'/storage/web/database/','extra'=>'','remark'=>'路径必须以 / 结尾','create_time'=>'1379053380','update_time'=>'1476448404','sort'=>'3','status'=>'1']);
        $this->insert('{{%config}}',['id'=>'12','name'=>'DOCUMENT_DISPLAY','title'=>'文档可见性','group'=>'2','type'=>'3','value'=>'0:所有人可见
1:仅注册会员可见
2:仅管理员可见','extra'=>'','remark'=>'文章可见性仅影响前台显示，后台不收影响','create_time'=>'1379056370','update_time'=>'1481279789','sort'=>'4','status'=>'1']);
        $this->insert('{{%config}}',['id'=>'13','name'=>'COLOR_STYLE','title'=>'后台色系','group'=>'1','type'=>'4','value'=>'default_color','extra'=>'default_color:默认
blue_color:紫罗兰','remark'=>'后台颜色风格','create_time'=>'1379122533','update_time'=>'1472528403','sort'=>'10','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%config}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

