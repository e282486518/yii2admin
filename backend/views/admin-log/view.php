<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '详细行为日志';
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
        
        <div class="form-view">
            <div class="form-group">
                <div>
                    <label>标题</label>
                    <span class="help-inline">（标题描述）</span>
                </div>
                <input type="text" class="form-control c-md-2" name="param[name]" value="<?=$model->title?>" readonly/>
            </div>
            
            <div class="form-group">
                <div>
                    <label>控制器</label>
                    <span class="help-inline">（控制器描述）</span>
                </div>
                <input type="text" class="form-control c-md-2" name="param[name]" value="<?=$model->controller?>" readonly/>
            </div>
            
            <div class="form-group">
                <div>
                    <label>动作</label>
                    <span class="help-inline">（动作描述）</span>
                </div>
                <input type="text" class="form-control c-md-2" name="param[name]" value="<?=$model->action?>" readonly/>
            </div>
            
            <div class="form-group">
                <div>
                    <label>查询字符串</label>
                    <span class="help-inline">（查询字符串描述）</span>
                </div>
                <input type="text" class="form-control c-md-4" name="param[name]" value="<?=$model->querystring?>" readonly/>
            </div>
            
            <div class="form-group">
                <div>
                    <label>备注</label>
                    <span class="help-inline">（备注描述）</span>
                </div>
                <input type="text" class="form-control c-md-4" name="param[name]" value="<?=$model->remark?>" readonly/>
            </div>
            
            <div class="form-group">
                <div>
                    <label>IP</label>
                    <span class="help-inline"></span>
                </div>
                <input type="text" class="form-control c-md-2" name="param[name]" value="<?=$model->ip?>" readonly/>
            </div>
            
            <div class="form-group">
                <div>
                    <label>创建时间</label>
                    <span class="help-inline"></span>
                </div>
                <input type="text" class="form-control c-md-2" name="param[name]" value="<?=$model->create_time?>" readonly/>
            </div>
            
            <div class="form-group">
                <div>
                    <label>状态</label>
                    <span class="help-inline"></span>
                </div>
                <span class="text"><?=$model->status?></span>
            </div>
            
        </div>
        
        <div class="form-actions">
            <?= Html::submitButton('<i class="icon-ok"></i> 返回', ['class' => 'btn blue','onclick'=>"javascript:history.go(-1);"]) ?>
        </div>

        <!-- END FORM-->
    </div>
</div>

<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>

$(function() {
    /* 子导航高亮 */
    highlight_subnav('admin-log/index');
    
});

<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
