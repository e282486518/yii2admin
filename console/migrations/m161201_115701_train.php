<?php

use yii\db\Migration;

class m161201_115701_train extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%train}}', [
            'id' => 'int(8) unsigned NOT NULL AUTO_INCREMENT',
            'type' => 'int(11) NOT NULL COMMENT \'培训类型\'',
            'title' => 'varchar(100) NOT NULL COMMENT \'排序标题\'',
            'description' => 'varchar(255) NOT NULL COMMENT \'描述\'',
            'price' => 'decimal(8,2) NOT NULL COMMENT \'价格\'',
            'num' => 'tinyint(3) NOT NULL DEFAULT \'1\' COMMENT \'最少人数\'',
            'cover' => 'varchar(255) NOT NULL COMMENT \'封面\'',
            'sort' => 'int(4) NOT NULL DEFAULT \'0\' COMMENT \'排序值\'',
            'create_time' => 'int(10) unsigned NULL COMMENT \'创建时间\'',
            'update_time' => 'int(10) unsigned NULL COMMENT \'更新时间\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='培训表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%train}}',['id'=>'1','type'=>'1','title'=>'测试培训标题1','description'=>'测试培训标题1：

帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，
双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，

还是商务洽谈等都可以满足您的需要。
帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议
或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，
将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ','price'=>'523.23','num'=>'127','cover'=>'1','sort'=>'0','create_time'=>'1472643081','update_time'=>'1477903793','status'=>'1']);
        $this->insert('{{%train}}',['id'=>'2','type'=>'2','title'=>'测试培训标题','description'=>'帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，
双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，

还是商务洽谈等都可以满足您的需要。
帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议
或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，
将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ','price'=>'231.12','num'=>'100','cover'=>'2','sort'=>'1','create_time'=>'1472643186','update_time'=>'1474529429','status'=>'1']);
        $this->insert('{{%train}}',['id'=>'3','type'=>'1','title'=>'帆船培训2','description'=>'帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，
双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，

还是商务洽谈等都可以满足您的需要。
帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议
或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，
将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ','price'=>'322.20','num'=>'1','cover'=>'4','sort'=>'0','create_time'=>'1473611927','update_time'=>'1474529318','status'=>'1']);
        $this->insert('{{%train}}',['id'=>'4','type'=>'1','title'=>'帆船培训3','description'=>'帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，
双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，

还是商务洽谈等都可以满足您的需要。
帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议
或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，
将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ','price'=>'222.22','num'=>'122','cover'=>'4','sort'=>'0','create_time'=>'1473611964','update_time'=>'1474529341','status'=>'1']);
        $this->insert('{{%train}}',['id'=>'5','type'=>'2','title'=>'潜水培训2','description'=>'帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，
双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，

还是商务洽谈等都可以满足您的需要。
帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议
或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，
将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ','price'=>'100.02','num'=>'100','cover'=>'5','sort'=>'0','create_time'=>'1473612010','update_time'=>'1474529378','status'=>'1']);
        $this->insert('{{%train}}',['id'=>'6','type'=>'2','title'=>'潜水培训3','description'=>'帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，
双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，

还是商务洽谈等都可以满足您的需要。
帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议
或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，
将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ','price'=>'123.23','num'=>'100','cover'=>'6','sort'=>'0','create_time'=>'1473612026','update_time'=>'1474529403','status'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%train}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

