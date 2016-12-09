<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\Shop;

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

        <?=$form->field($model, 'description')->textarea(['rows'=>4])->label('商品描述'); ?>
        
        <!-- 单图 -->
        <?=$form->field($model, 'cover')->widget('\common\widgets\images\Images',[
            //'type' => \backend\widgets\images\Images::TYPE_IMAGE, // 单图
            'saveDB'=>1, //图片是否保存到picture表，默认不保存
        ],['class'=>'c-md-12'])->label('封面图片')->hint('单图图片尺寸为：300*300');?>
        
        <!-- 多图 -->
        <?=$form->field($model, 'images')->widget('\common\widgets\images\Images',[
            'type' => \common\widgets\images\Images::TYPE_IMAGES, // 多图
            'saveDB'=>1, //图片是否保存到picture表，默认不保存
        ],['class'=>'c-md-12'])->label('商品图集')->hint('图组图片尺寸为：300*300');?>
        
        <div class="form-group">
            <label>套餐【酒店】</label>
            <?php foreach (Shop::lists(1) as $list1) :?>
                <div class="controls" style="padding: 4px;">
                    <div class="span3 m-wrap" style="line-height: 30px;"><?=$list1['id']?>、<?=$list1['title']?></div>
                    <input type="text" class="form-control c-md-1" name="ShopGroup[groups][1][<?=$list1['id']?>][days]" value="<?=isset($groups[1][$list1['id']]['days'])?$groups[1][$list1['id']]['days']:''?>" placeholder="天数">
                    <input type="text" class="form-control c-md-1" name="ShopGroup[groups][1][<?=$list1['id']?>][num]" value="<?=isset($groups[1][$list1['id']]['days'])?$groups[1][$list1['id']]['num']:''?>" placeholder="房间数">
                    <input type="hidden" name="ShopGroup[groups][1][<?=$list1['id']?>][id]" value="<?=$list1['id']?>" >
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-group">
            <label>套餐【帆船】</label>
            <?php foreach (Shop::lists(2) as $list1) :?>
                <div class="controls" style="padding: 4px;">
                    <div class="span3 m-wrap" style="line-height: 30px;"><?=$list1['id']?>、<?=$list1['title']?></div>
                    <input type="text" class="form-control c-md-1" name="ShopGroup[groups][2][<?=$list1['id']?>][days]" value="<?=isset($groups[2][$list1['id']]['days'])?$groups[2][$list1['id']]['days']:''?>" placeholder="小时数">
                    <input type="text" class="form-control c-md-1" name="ShopGroup[groups][2][<?=$list1['id']?>][num]" value="<?=isset($groups[2][$list1['id']]['num'])?$groups[2][$list1['id']]['num']:''?>" placeholder="数量">
                    <input type="hidden" name="ShopGroup[groups][2][<?=$list1['id']?>][id]" value="<?=$list1['id']?>">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-group">
            <label>套餐【潜水】</label>
            <?php foreach (Shop::lists(3) as $list1) :?>
                <div class="controls" style="padding: 4px;">
                    <div class="c-md-4" style="line-height: 30px;"><?=$list1['id']?>、<?=$list1['title']?></div>
                    <input type="text" class="form-control c-md-1" name="ShopGroup[groups][3][<?=$list1['id']?>][days]" value="<?=isset($groups[3][$list1['id']]['days'])?$groups[3][$list1['id']]['days']:''?>" placeholder="小时数">
                    <input type="text" class="form-control c-md-1" name="ShopGroup[groups][3][<?=$list1['id']?>][num]" value="<?=isset($groups[3][$list1['id']]['num'])?$groups[3][$list1['id']]['num']:''?>" placeholder="数量">
                    <input type="hidden" name="ShopGroup[groups][3][<?=$list1['id']?>][id]" value="<?=$list1['id']?>">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-group">
            <label>套餐【海钓】</label>
            <?php foreach (Shop::lists(4) as $list1) :?>
                <div class="controls" style="padding: 4px;">
                    <div class="span3 m-wrap" style="line-height: 30px;"><?=$list1['id']?>、<?=$list1['title']?></div>
                    <input type="text" class="form-control c-md-1" name="ShopGroup[groups][4][<?=$list1['id']?>][days]" value="<?=isset($groups[4][$list1['id']]['days'])?$groups[4][$list1['id']]['days']:''?>" placeholder="小时数">
                    <input type="text" class="form-control c-md-1" name="ShopGroup[groups][4][<?=$list1['id']?>][num]" value="<?=isset($groups[4][$list1['id']]['num'])?$groups[4][$list1['id']]['num']:''?>" placeholder="数量">
                    <input type="hidden" name="ShopGroup[groups][4][<?=$list1['id']?>][id]" value="<?=$list1['id']?>">
                </div>
            <?php endforeach; ?>
        </div>

        
        <?=$form->field($model, 'price')->textInput(['class'=>'form-control c-md-1'])->label('套餐价格')->hint('价格保留两位小数，例如420.12')?>
        
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
    highlight_subnav('group/index');
});

<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
