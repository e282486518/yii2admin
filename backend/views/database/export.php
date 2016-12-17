<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $list array */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '数据库管理';
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
                <?=Html::a('立即备份 <i class="icon-plus"></i>','javascript:;',['id'=>'export', 'class'=>'btn green','style'=>'margin-right:10px;'])?>
                <?=Html::a('优化表 <i class="icon-check"></i>',['optimize'],['id'=>'optimize', 'class'=>'btn green','style'=>'margin-right:10px;'])?>
                <?=Html::a('修复表 <i class="icon-medkit"></i>',['repair'],['id'=>'repair','class'=>'btn green','style'=>'margin-right:10px;'])?>
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
            <form id="export-form" method="post" action="<?=Url::toRoute(['export'])?>" class="table-scrollable">
            <table class="table table-striped table-bordered table-hover" id="sample_11">
                <thead>
                    <tr>
                        <th style="width:8px;"><input type="checkbox" class="group-checkable" checked="chedked" data-set="#sample_11 .checkboxes" /></th>
                        <th>表名</th>
                        <th class="hidden-480">数据量</th>
                        <th style="width:140px;">数据大小</th>
                        <th style="width:160px;">创建时间</th>
                        <th style="width:140px;">备份状态</th>
                        <th class="hidden-480">操作</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php foreach ($list as $key => $value): ?>
                <tr class="odd gradeX">
                    <td><input type="checkbox" class="checkboxes" checked="chedked" name="tables[]" value="<?=$value['name']?>" /></td>
                    <td><?=$value['name']?></td>
                    <td><?=$value['rows']?></td>
                    <td><?=Yii::$app->formatter->asShortSize($value['data_length'])?></td>
                    <td><?=$value['create_time']?></td>
                    <td class="info">未备份</td>
                    <td>
                        <a href="<?=Url::toRoute(['optimize', 'tables'=>$value['name']])?>" class="ajax-get btn btn-xs purple"><i class="fa fa-check"></i> 优化表</a>
                        <a href="<?=Url::toRoute(['repair', 'tables'=>$value['name']])?>" class="ajax-get btn btn-xs purple"><i class="fa fa-medkit"></i> 修复表</a>
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
    highlight_subnav('database/index?type=export'); //子导航高亮
    
    /* 列表一键多选 */
    jQuery('#sample_11 .group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
            if (checked) {
                $(this).attr("checked", true);
            } else {
                $(this).attr("checked", false);
            }
        });
        jQuery.uniform.update(set);
    });
    
    /* 批量 优化表and修复表 */
    var $form = $("#export-form"), $export = $("#export"), tables;
    
    $("#optimize").add($("#repair")).click(function(){
        $.post(this.href, $form.serialize(), function(data){
            if(data.status){
                updateAlert(data.info,'alert-success');
            } else {
                updateAlert(data.info,'alert-error');
            }
            setTimeout(function(){
                $('#top-alert').find('button').click();
                $(this).removeClass('disabled').prop('disabled',false);
            },1500);
        }, "json");
        return false;
    });
    
    /* 批量 备份表 */
    $export.click(function(){
        $export.parent().children().addClass("disabled");
        $export.html("正在发送备份请求...");
        $.post(
            $form.attr("action"),
            $form.serialize(),
            function(data){
                if(data.status){
                    tables = data.tables;
                    $export.html(data.info + "开始备份，请不要关闭本页面！");
                    backup(data.tab);
                    window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
                } else {
                    updateAlert(data.info,'alert-error');
                    $export.parent().children().removeClass("disabled");
                    $export.html("立即备份");
                    setTimeout(function(){
                        $('#top-alert').find('button').click();
                        $(this).removeClass('disabled').prop('disabled',false);
                    },1500);
                }
            },
            "json"
        );
        return false;
    });
    
    function backup(tab, status){
        status && showmsg(tab.id, "开始备份...(0%)");
        $.get($form.attr("action"), tab, function(data){
            if(data.status){
                showmsg(tab.id, data.info);

                if(!$.isPlainObject(data.tab)){
                    $export.parent().children().removeClass("disabled");
                    $export.html("备份完成，点击重新备份");
                    window.onbeforeunload = function(){ return null }
                    return;
                }
                backup(data.tab, tab.id != data.tab.id);
            } else {
                updateAlert(data.info,'alert-error');
                $export.parent().children().removeClass("disabled");
                $export.html("立即备份");
                setTimeout(function(){
                    $('#top-alert').find('button').click();
                    $(this).removeClass('disabled').prop('disabled',false);
                },1500);
            }
        }, "json");

    }

    function showmsg(id, msg){
        $form.find("input[value=" + tables[id] + "]").closest("tr").find(".info").html(msg);
    }
    
});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>

