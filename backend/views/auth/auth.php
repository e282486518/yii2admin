<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */
/* @var $node_list array */
/* @var $role string */
/* @var $auth_rules array */

/* ===========================以下为本页配置信息=========================== */
/* 页面基本属性 */
$this->title = '角色授权管理';
$this->params['title_sub'] = '';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

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
        <form action="<?=\yii\helpers\Url::toRoute(['auth','role'=>$role])?>" method="post" class="form-aaa ">

            <?php foreach ($node_list as $node): ?>
            <div style="margin-bottom:10px;">
                <div class="form-group" style="margin-bottom:0px;background:#eee;padding:5px;">
                    <div class="mt-checkbox-inline" style="padding:2px 0;">
                        <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom:0px;">
                            <input type="checkbox" name="rules[]" value="<?=$node['url']?>" <?php echo in_array($node['url'],$auth_rules) ?'checked':''; ?> />
                            <span></span>
                            <?=$node['title']?>
                        </label>
                    </div>
                </div>
                <div style="padding:5px;border:1px #eee solid;">
                    <?php if (isset($node['child'])) : ?>
                    <?php foreach ($node['child'] as $child): ?>

                        <div class="form-group" style="margin-bottom:0px;">
                            <div class="mt-checkbox-inline" style="padding:2px 0;">
                                <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom:0px;">
                                    <input type="checkbox" name="rules[]" value="<?php echo $child['url'] ?>" <?php echo in_array($child['url'],$auth_rules) ?'checked':''; ?> />
                                    <span></span>
                                    <?=$child['title']?>
                                </label>
                            </div>
                        </div>
                        
                        <div>
                        <?php if (!empty($child['child'])) : ?>
                            <div class="form-group" style="margin-left:50px;margin-bottom:0px;">
                                <div class="mt-checkbox-inline" style="padding:2px 0;">
                                    <?php foreach ($child['child'] as $op): ?>
                                    <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom:5px;">
                                        <input type="checkbox" name="rules[]" value="<?php echo $op['url'] ?>" <?php echo in_array($op['url'],$auth_rules) ?'checked':''; ?> />
                                        <span></span>
                                        <?=$op['title']?>
                                    </label>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endif ?>
                        </div>
                    <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
            <?php endforeach ?>

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
