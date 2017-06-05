<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Page */
/* @var $form common\core\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'options'=>[
        'class'=>"form-aaa ",
        'enctype'=>"multipart/form-data",
    ]
]); ?>

<?=$form->field($model, 'name')->textInput(['class'=>'form-control c-md-2'])->label('文章标识')->hint('英文标识，只允许含有:英文、数字和中划线');?>

<?=$form->field($model, 'title')->textInput(['class'=>'form-control c-md-5'])->label('文章标题')->hint('单页文章标题');?>

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

<?=$form->field($model, 'status')->radioList(['1'=>'正常','0'=>'隐藏'])->label('状态') ?>

<div class="form-actions">
    <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
    <?= Html::button('取消', ['class' => 'btn']) ?>
</div>

<?php ActiveForm::end(); ?>

