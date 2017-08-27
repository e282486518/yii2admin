<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\modelsgii\AuthAssignment */
/* @var $form ActiveForm */

/* ===========================以下为本页配置信息============================ */
/* 页面基本属性 */
$this->title = '角色管理';
$this->params['title_sub'] = '管理用户角色信息';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

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
                <?=Html::a('添加 <i class="fa fa-plus"></i>',['add'],['class'=>'btn green','style'=>'margin-right:10px;'])?>
                <?=Html::a('删除 <i class="fa fa-times"></i>',['delete'],['class'=>'btn green ajax-post confirm','target-form'=>'ids','style'=>'margin-right:10px;'])?>
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
        <div class="table-container table-scrollable">
            <!--<form class="ids">-->

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width:8px;">#</th>
                        <th>角色名</th>
                        <th class="hidden-480">描述</th>
                        <th style="width:140px;">添加时间</th>
                        <th style="width:140px;">更新时间</th>
                        <th class="hidden-480">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $nn=0;?>
                    <?php foreach ($roles as $key => $value): ?>
                    <tr class="odd gradeX">
                        <?php $nn++;?>
                        <td><?=$nn?></td>
                        <td><?=$value->name?></td>
                        <td><?=$value->description?></td>
                        <td><?=date('Y-m-d H:i',$value->createdAt)?></td>
                        <td><?=date('Y-m-d H:i',$value->updatedAt)?></td>
                        <td>
                            <a href="<?=Url::toRoute(['auth', 'role'=>$key])?>" class="btn btn-xs purple"><i class="icon-key"></i> 授权</a>
                            <a href="<?=Url::toRoute(['user', 'role'=>$key])?>" class="btn btn-xs purple"><i class="icon-user"></i> 用户</a>
                            <a href="<?=Url::toRoute(['edit', 'role'=>$key])?>" class="btn btn-xs purple"><i class="fa fa-edit"></i> 编辑</a>
                            <a href="<?=Url::toRoute(['delete', 'role'=>$key])?>" class="btn btn-xs red ajax-get confirm"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>

                    </tbody>
                </table>
                
            <!--</form>-->
        </div>
    </div>
</div>

<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
jQuery(document).ready(function() {
    highlight_subnav('auth/index'); //子导航高亮
});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
