<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form common\core\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'options'=>[
        'class'=>"form-aaa ",
        'enctype'=>"multipart/form-data",
    ]
]); ?>
<?=$form->field($model, 'category_id')->selectList(
    ArrayHelper::listDataLevel(\backend\models\ArticleCat::find()->asArray()->all(), 'id', 'title','id','pid'),
    ['class'=>'form-control c-md-2'])->label('栏目')->hint('英文标识'); ?>

<?=$form->field($model, 'name')->textInput(['class'=>'form-control c-md-2'])->label('文章标识')->hint('英文标识，只允许含有:英文、数字和中划线');?>

<?=$form->field($model, 'title')->textInput(['class'=>'form-control c-md-5'])->label('文章标题')->hint('111111');?>

<!-- 单图 -->
<?=$form->field($model, 'cover')->widget('\common\widgets\images\Images',[
    //'type' => \backend\widgets\images\Images::TYPE_IMAGE, // 单图
    'saveDB'=>1, //图片是否保存到picture表，默认不保存
],['class'=>'c-md-12'])->label('封面图片')->hint('单图图片尺寸为：300*300');?>

<?=$form->field($model, 'description')->textarea(['class'=>'form-control c-md-4', 'rows'=>3])->label('文章描述')->hint('文章描述') ?>

<?=$form->field($model, 'content')->widget('\kucha\ueditor\UEditor',[
    'clientOptions' => [
        'serverUrl' => Url::to(['/public/ueditor']),//确保serverUrl正确指向后端地址
        'lang' =>'zh-cn', //中文为 zh-cn
        'initialFrameWidth' => '100%',
        'initialFrameHeight' => '400',
        //定制菜单，参考http://fex.baidu.com/ueditor/#start-toolbar
        'toolbars' => [
            [
                'fullscreen', 'source', 'undo', 'redo', '|',
                'fontsize',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                'forecolor', 'backcolor', '|',
                'lineheight', '|',
                'indent', '|',
            ],
            ['preview','simpleupload','insertimage','link','emotion','map','insertvideo','insertcode',]
        ]
    ]
],['class'=>'c-md-7'])->label('文章内容');?>



<?=$form->field($model, 'link')->textInput(['class'=>'form-control c-md-5'])->label('外链')->hint('外链地址必须带http')?>

<?=$form->field($model, 'extend')->textarea(['class'=>'form-control c-md-4', 'rows'=>5])->label('扩展参数')->hint('一维数组配置格式“项:值”每项之间用换行或逗号隔开，其值转化为array后serialize()存储到数据库') ?>

<?=$form->field($model, 'sort')->textInput(['class'=>'form-control c-md-1'])->label('排序值')->hint('排序值越小越前')?>

<?=$form->field($model, 'status')->radioList(['1'=>'正常','0'=>'隐藏'])->label('状态') ?>

<div class="form-actions">
    <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
    <?= Html::button('取消', ['class' => 'btn']) ?>
</div>

<?php ActiveForm::end(); ?>

