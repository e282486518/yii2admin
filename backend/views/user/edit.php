<?php

use yii\helpers\Html;
use common\core\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '添加用户';
$this->params['title_sub'] = '添加前台用户';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

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

        <?php $form = ActiveForm::begin([
            'options'=>[
                'class'=>"form-aaa "
            ]
        ]); ?>

        <?= $form->field($model, 'username')->iconTextInput([
            'class'=>'form-control c-md-2',
            'iconPos' => 'left',
            'iconClass' => 'icon-user',
            'placeholder' => 'username'
        ])->label('用户名') ?>

        <div class="form-group">
            <label>密码</label>
            <div class="">
                <div class="input-icon left">
                    <i class="icon-lock"></i>
                    <input type="password" class="form-control c-md-2" name="User[password]" placeholder="密码不变请留空" />
                </div>
            </div>
        </div>

        <?= $form->field($model, 'email')->iconTextInput([
            'class'=>'form-control c-md-2',
            'iconPos' => 'left',
            'iconClass' => 'icon-envelope',
            'placeholder' => 'Email Address'
        ])->label('邮箱') ?>

        <?= $form->field($model, 'mobile')->iconTextInput([
            'class'=>'form-control c-md-2',
            'iconPos' => 'left',
            'iconClass' => 'fa fa-mobile',
            'placeholder' => 'Mobile'
        ])->label('电话') ?>
        
        <!-- 单图 -->
        <?=$form->field($model, 'image')->widget('\common\widgets\images\Images',[
            //'type' => \backend\widgets\images\Images::TYPE_IMAGE, // 单图
            'saveDB'=>1, //图片是否保存到picture表，默认不保存
        ],['class'=>'c-md-12'])->label('头像')->hint('单图图片尺寸为：300*300');?>
        
        <?=$form->field($model, 'score')->textInput(['class'=>'form-control c-md-1'])->label('当前积分')->hint('可用于积分消费')?>
        
        <?=$form->field($model, 'score_all')->textInput(['class'=>'form-control c-md-1'])->label('总积分')->hint('消费积分时，总积分不会变')?>
        
        <?= $form->field($model, 'status')->radioList(['1'=>'正常','0'=>'隐藏'])->label('用户状态') ?>

        <div class="form-actions">
            <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
            <?= Html::button('取消', ['class' => 'btn']) ?>
        </div>
        <?php ActiveForm::end(); ?>

        <!-- END FORM-->
    </div>
</div>

<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
jQuery(document).ready(function() {
    highlight_subnav('user/index'); //子导航高亮
});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
