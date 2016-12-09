<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */
/* @var $groups array $id */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '网站设置';
$this->params['title_sub'] = '';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

$id = Yii::$app->request->get('id',1);

?>
<div class="tabbable tabbable-custom boxless">
    <ul class="nav nav-tabs">
        <?php foreach (Yii::$app->params['config_group'] as $key => $value) : ?>
        <?php if ($key == 0) { continue; } ?>
        <li <?php echo $key == $id ? 'class="active"' : ''; ?>><a href="<?=\yii\helpers\Url::toRoute(['group','id'=>$key])?>"><?=$value?>设置</a></li>
        <?php endforeach ?>
    </ul>
    
    <div class="tab-content">
        
        <div>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> <?=Yii::$app->params['config_group'][$id]?>设置表单</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="<?=\yii\helpers\Url::toRoute(['group'])?>" method="post" class="form-aaa ">
                        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                        
                        <?php foreach ($groups as $group): ?>
                        <div class="form-group">
                            <div>
                                <label><?=$group['title']?></label>
                                <span class="help-inline">（<?=$group['remark']?>）</span>
                            </div>
                            
                            <?php if($group['type'] == 2 || $group['type'] == 3): ?>
                            <textarea class="form-control c-md-4" name="param[<?=$group['name']?>]" rows="5"><?=$group['value']?></textarea>
                            <?php elseif($group['type'] == 4): ?>
                            <select class="form-control c-md-1" name="param[<?=$group['name']?>]" data-placeholder="请选择一个值" tabindex="1">
                                <?php if($group['extra'] && is_array($group['extra'])): ?>
                                <?php foreach ($group['extra'] as $k => $v) : ?>
                                <option value="<?=$k?>" <?php if($group['value'] == $k){echo 'selected';} ?>><?=$v?></option>
                                <?php endforeach ?>
                                <?php endif ?>
                            </select>
                            <?php else : ?>
                            <input type="text" class="form-control c-md-4" name="param[<?=$group['name']?>]" value="<?=$group['value']?>"/>
                            <?php endif ?>
                            
                        </div>
                        <?php endforeach ?>
                        
                        <div class="form-actions">
                            <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
                            <?= Html::button('取消', ['class' => 'btn']) ?>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    
</div>

<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
jQuery(document).ready(function() {
    highlight_subnav('config/group'); //子导航高亮
});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
