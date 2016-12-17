<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\MenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin([
    'action' => ['index','pid'=>Yii::$app->request->get('pid',0)],
    'method' => 'get',
    'options'=>[
        //'class'=>"form-inline",
        'data-pjax' => true, //开启pjax搜索
    ]
]); ?>
<div class="row">
    <div class="col-md-2">
    <?= $form->field($model, 'title')->textInput()->label('标题') ?>
    </div>
    
    <div class="col-md-1">
    <?=$form->field($model, 'hide')->dropDownList([''=>'全部',1=>'隐藏',0=>'正常'],['class'=>'form-control'])->label('状态'); ?>
    </div>
    
    <div class="col-md-2">
        <div class="form-group" style="margin-top: 24px;">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
