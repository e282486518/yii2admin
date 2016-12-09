<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = ($this->context->action->id == 'add' ? '添加' : '编辑') . '商品';
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
        <?php $form = ActiveForm::begin([
            'options'=>[
                'class'=>"form-aaa "
            ]
        ]); ?>
        
        <?=$form->field($model, 'title')->textInput()->label('商品标题');?>
        
        <?=$form->field($model, 'description')->textarea(['rows'=>3])->label('商品描述'); ?>

        <?=$form->field($model, 'cover')->widget('\common\widgets\images\Images',[
            //'type' => \backend\widgets\images\Images::TYPE_IMAGE, // 单图
            'saveDB'=>1, //图片是否保存到picture表，默认不保存
        ],['class'=>'c-md-12'])->label('封面图片')->hint('图组图片尺寸为：300*300');?>

        <?=$form->field($model, 'images')->widget('\common\widgets\images\Images',[
            'type' => \common\widgets\images\Images::TYPE_IMAGES, // 多图
            'saveDB'=>1, //图片是否保存到picture表，默认不保存
        ],['class'=>'c-md-12'])->label('商品图集')->hint('图组图片尺寸为：300*300');?>

        <?=$form->field($model, 'imagess')->widget('\common\widgets\images\Images',[
            'type' => \common\widgets\images\Images::TYPE_IMAGES, // 多图
            'saveDB'=>1, //图片是否保存到picture表，默认不保存
        ],['class'=>'c-md-12'])->label('商品图集2测试双图集')->hint('图组图片尺寸为：300*300');?>
        
        <?=$form->field($model, 'num')->textInput(['class'=>'form-control c-md-1'])->label('商品总数')->hint('商品的总数量，出售数达到这个数后将停止出售')?>
        
        <?=$form->field($model, 'price')->textInput(['class'=>'form-control c-md-1'])->label('价格')->hint('价格保留两位小数，例如420.12')?>
        
        <?=$form->field($model, 'extend')->textarea(['rows'=>5])->label('扩展参数')->hint('一维数组配置格式“项:值”每项之间用换行或逗号隔开，其值转化为array后serialize()存储到数据库') ?>
        
        <?=$form->field($model, 'sort')->textInput(['class'=>'form-control c-md-1'])->label('排序值')->hint('排序值越小越前')?>
        
        <?=$form->field($model, 'status')->radioList(['1'=>'正常','0'=>'隐藏'])->label('状态') ?>
        
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

$(function() {
    /* 子导航高亮 */
    highlight_subnav('shop/index?type=<?=Yii::$app->request->get("type")?>');
});

<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
