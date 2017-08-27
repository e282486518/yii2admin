<?php


use yii\helpers\Html;
use yii\helpers\Url;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;
//use backend\models\Train;
//use backend\models\Shop;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = ($this->context->action->id == 'add' ? '添加' : '编辑') . '订单';
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
        <!-- 这里注意了，不能使用pjax，因为第三方库中有行内js，会导致js加载失败 -->
        <!-- BEGIN FORM-->
        <?php $form = ActiveForm::begin([
            'options'=>[
                'class'=>"form-aaa"
            ]
        ]); ?>

        <?=$form->field($model, 'order_sn')->textInput(['class' => 'form-control c-md-2'])->label('订单号')->hint('订单号由系统自动生成')?>

        <?=$form->field($model, 'name')->textInput(['class' => 'form-control c-md-2'])->label('姓名')->hint('购买人的姓名')?>

        <?=$form->field($model, 'tel')->textInput(['class' => 'form-control c-md-2'])->label('电话')->hint('购买人的电话')?>

        <?php $type = Yii::$app->request->get('type') ?>
        <?php /*echo $form->field($model, 'aid')->widget(\kartik\widgets\Select2::classname(), [
            'data' => $type == 'shop'?Shop::listsKv():Train::listsKv(),
            'options' => ['placeholder' => '选择商品','class'=>'c-md-3'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ],['class' => 'c-md-3'])->label('商品名称')->hint('商品的名称');*/?>

        <?=$form->field($model, 'start_time')->widget(\kartik\widgets\DateTimePicker::classname(),[
            'language' => 'zh-CN',
            'type' => \kartik\widgets\DateTimePicker::TYPE_INPUT,
            'value' => '2016-07-15',
            'options' => ['class' => 'form-control'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:ii',
            ]
        ],['class' => 'c-md-2'])->label('开始时间')->hint('租赁开始时间，或订购时间')?>
        
        <?=$form->field($model, 'end_time')->widget(\kartik\widgets\DateTimePicker::classname(),[
            'language' => 'zh-CN',
            'type' => \kartik\widgets\DateTimePicker::TYPE_INPUT,
            //'convertFormat' => 'yyyy-mm-dd',
            'value' => '2016-07-15',
            'options' => ['class' => 'form-control'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:ii'
            ]
        ],['class' => 'c-md-2'])->label('结束时间')->hint('租赁结束时间')?>

        <div class="form-group">
            <div>
                <label>省 市 区</label>
                <span class="help-inline"></span>
            </div>
            <div class="col-md-2" style="padding-left:0px;">
                <?=\kartik\widgets\Select2::widget([
                    'model' => $model,
                    'attribute' => 'province',
                    //'data' => '',
                    'data' => ArrayHelper::map(\common\modelsgii\Region::find()->where(['parent_code'=>0])->asArray()->all(), 'code', 'fullname')
                ]);?>
            </div>
            <div class="col-md-2">
                <?=\kartik\widgets\DepDrop::widget([
                    'model' => $model,
                    'attribute' => 'city',
                    'options' => ['placeholder' => '选择'],
                    'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                    'pluginOptions'=>[
                        //'initialize' => true,
                        //'initDepends'=>['order-province'],
                        'depends'=>['order-province'],
                        'url' => Url::to(['/public/region','sid'=>$model['city']]),
                        'loadingText' => '加载中',
                    ]
                ]);?>
            </div>
            <div class="col-md-2">
                <?=\kartik\widgets\DepDrop::widget([
                    'model' => $model,
                    'attribute' => 'area',
                    'options' => ['placeholder' => '选择'],
                    'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                    'pluginOptions'=>[
                        'initialize' => true,
                        'initDepends'=>['order-province'],
                        'depends'=>['order-city'],
                        'url' => Url::to(['/public/region','sid'=>$model['area']]),
                        'loadingText' => '加载中',
                    ]
                ]);?>
            </div>
            <div style="clear:both;"></div>
        </div>

        
        <?=$form->field($model, 'num')->textInput(['class' => 'form-control c-md-1'])->label('数量')->hint('订购数量')?>
        
        <?=$form->field($model, 'pay_status')->radioList(['1'=>'已支付','0'=>'未支付'])->label('支付状态') ?>

        <?=$form->field($model, 'pay_time')->textInput(['value'=>date('Y-m-d H:i'),'class' => 'form-control c-md-2'])->label('支付时间')->hint('支付时间')?>

        <?=$form->field($model, 'pay_type')->radioList(\Yii::$app->params['pay_type'])->label('支付类型');?>

        <?=$form->field($model, 'pay_source')->radioList(['1'=>'网站','2'=>'微信','3'=>'后台'])->label('支付途径');?>

        <?=$form->field($model, 'status')->radioList(['1'=>'显示','0'=>'隐藏'])->label('是否显示'); ?>
        
        <div class="form-actions">
            <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
            <?= Html::button('取消', ['class' => 'btn','onclick'=>'JavaScript:history.go(-1)']) ?>
        </div>
        
        <?php ActiveForm::end(); ?>

        <!-- END FORM-->
    </div>
</div>

<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>

$(function() {
    /* 子导航高亮 */
    highlight_subnav('order/index');
});

<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
