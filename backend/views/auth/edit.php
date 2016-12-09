<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */
/** @var $role \yii\rbac\Role*/

/* ===========================以下为本页配置信息============================ */
/* 页面基本属性 */
$this->title = '添加用户';
$this->params['title_sub'] = '添加后台用户';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

?>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-settings font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> 内容信息</span>
        </div>
        <div class="actions">
            <div class="btn-group">
                <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> 工具箱
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="javascript:;"><i class="fa fa-pencil"></i> 导出Excel </a></li>
                    <li class="divider"> </li>
                    <li><a href="javascript:;"> 其他 </a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="<?=\yii\helpers\Url::toRoute(['edit','role'=>$role->name])?>" method="post" class="form-aaa ">

            <div class="form-group">
                <div>
                    <label>角色名</label>
                    <span class="help-inline">（角色（用户组）名称）</span>
                </div>
                <input type="text" class="form-control c-md-2" name="param[name]" value="<?=$role->name?>"/>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <div>
                    <label>角色描述</label>
                    <span class="help-inline">（角色描述）</span>
                </div>
                <textarea name="param[description]" class="form-control c-md-4" rows="3"><?=$role->description?></textarea>
                <span class="help-block"></span>
            </div>

            <div class="form-actions">
                <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
                <?= Html::button('取消', ['class' => 'btn']) ?>
            </div>
        </form>
        <!-- END FORM-->
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
