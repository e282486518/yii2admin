<?php

use yii\helpers\Url;

/* @var $list array */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '还原数据库';
$this->params['title_sub'] = '';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

/* 加载页面级别资源 */
\backend\assets\TablesAsset::register($this);

?>
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">管理信息</span>
        </div>
        <div class="actions">
            <div class="btn-group btn-group-devided">
                
            </div>
            <div class="btn-group">
                <button class="btn blue btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                    工具箱
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="javascript:;"><i class="fa fa-pencil"></i> 导出Excel </a></li>
                    <li class="divider"> </li>
                    <li><a href="javascript:;"> 其他 </a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <form class="ids table-scrollable">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>备份名称</th>
                        <th class="hidden-480">卷数</th>
                        <th style="width:140px;">压缩</th>
                        <th style="width:140px;">数据大小</th>
                        <th style="width:170px;">备份时间</th>
                        <th style="width:140px;">备份状态</th>
                        <th class="hidden-480">操作</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php foreach ($list as $key => $value): ?>
                <tr class="odd gradeX">
                    <td><?=date('Ymd-His', $value['time'])?></td>
                    <td><?=$value['part']?></td>
                    <td><?=$value['compress']?></td>
                    <td><?=Yii::$app->formatter->asShortSize($value['size'])?></td>
                    <td><?=$key?></td>
                    <td>-</td>
                    <td>
                        <a href="<?=Url::toRoute(['import', 'time'=>$value['time']])?>" class="db-import btn btn-xs purple"><i class="icon-check"></i> 还原</a>
                        <a href="<?=Url::toRoute(['del', 'time'=>$value['time']])?>" class="ajax-get confirm btn btn-xs purple"><i class="icon-trash"></i> 删除</a>
                    </td>
                </tr>
                <?php endforeach ?>

                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>

<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
jQuery(document).ready(function() {
    highlight_subnav('database/index?type=import'); //子导航高亮
    
    /* 还原数据库 */
    $(".db-import").click(function(){
        var self = this, status = ".";
        $.get(self.href, success, "json");
        window.onbeforeunload = function(){ return "正在还原数据库，请不要关闭！" }
        return false;
    
        function success(data){
            if(data.status){
                if(data.gz){
                    data.info += status;
                    if(status.length === 5){
                        status = ".";
                    } else {
                        status += ".";
                    }
                }
                $(self).parent().prev().text(data.info);
                if(data.part){
                    $.get(self.href, 
                        {"part" : data.part, "start" : data.start}, 
                        success, 
                        "json"
                    );
                }  else {
                    window.onbeforeunload = function(){ return null; }
                }
            } else {
                updateAlert(data.info,'alert-error');
            }
        }
    });
    
});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>

