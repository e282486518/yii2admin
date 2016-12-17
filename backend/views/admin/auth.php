<?php

use yii\helpers\Html;
use common\core\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */
/** @var $roles array */
/** @var $group array */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '用户组授权';
$this->params['title_sub'] = '';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

/* 渲染其他文件 */
//echo $this->renderFile('@app/views/public/login.php');

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
        <form action="<?=\yii\helpers\Url::toRoute(['auth','uid'=>$model->uid])?>" method="post" class="form-aaa ">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

            <div class="form-group">
                <label>用户组</label>
                <div class="mt-radio-list">
                    <?php foreach ($roles as $role) : ?>
                    <label class="mt-radio mt-radio-outline">
                        <input type="radio" name="param" value="<?=$role->name?>" <?php echo in_array($role->name, $group) ?'checked':''; ?> />
                        <span></span>
                        <?=$role->name?> (<?=$role->description?>)
                    </label>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="form-actions">
                <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>

<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
jQuery(document).ready(function() {
    highlight_subnav('admin/index'); //子导航高亮
});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
