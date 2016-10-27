<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */
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
        
        <?=$form->field($model, 'name')->textInput()->label('类型');?>

        <?=$form->field($model, 'certif_ids')->checkboxList(\common\models\TrainCertificate::getAll())->label('选择证书')?>

        <?=$form->field($model, 'description')->textarea(['rows'=>4])->label('证书描述'); ?>
        
        <!-- 单图 -->
        <?=$this->renderFile('@app/views/public/_image.php',[
            'data'=>$model->cover,
            'field'=>'TrainType[cover]',
            'saveDB'=>1, //图片是否保存到picture表，默认不保存
            'title'=>'封面图片',
            'tishi'=>'单图图片尺寸为：300*300'
        ])?>
        
        <div class="form-actions">
            <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
            <?= Html::Button('取消', ['class' => 'btn']) ?>
        </div>
        
        <?php ActiveForm::end(); ?>
        
        <!-- END FORM-->
    </div>
</div>



<?php
/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = !$model->id ? '添加' : '编辑' . '培训类型';
$this->context->title_sub = '';

/* 渲染其他文件 */
//echo $this->renderFile('@app/views/public/login.php');


?>

<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>

$(function() {
    /* 子导航高亮 */
    highlight_subnav('traintype/index');
});

<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
