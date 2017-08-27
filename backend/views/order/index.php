<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $model common\modelsgii\Order */
/* @var $dataProvider yii\data\ActiveDataProvider  */
/* @var $searchModel backend\models\search\OrderSearch */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '订单管理';
$this->params['title_sub'] = '订单管理副标题';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

/* 先要注册表格所须的资源 */
\backend\assets\TablesAsset::register($this);

$columns = [
    [
        'class' => \common\core\CheckboxColumn::className(),
        'name'  => 'id',
        'options' => ['width' => '20px;'],
        'checkboxOptions' => function ($model, $key, $index, $column) {
            return ['value' => $key,'label'=>'<span></span>','labelOptions'=>['class' =>'mt-checkbox mt-checkbox-outline','style'=>'padding-left:19px;']];
        }
    ],
    [
        'header' => 'ID',
        'value' => 'order_id',
        'options' => ['width' => '50px;']
    ],
    [
        'header' => 'UID',
        'options' => ['width' => '50px;'],
        'attribute' => 'uid',
        'filter' => Html::input('text', 'OrderSearch[uid]', $searchModel->uid, ['class'=>'form-control'])
    ],
    [
        'header' => '商品名',
        'attribute' => 'title',
        'content' => function($model){
            return $model['title'];
        },
        'filter' => Html::input('text', 'OrderSearch[title]', $searchModel->title, ['class'=>'form-control'])
    ],
    [
        'header' => '起租时间',
        'value' => 'start_time',
        'format' => ['date', 'php:Y-m-d'],
        'options' => ['width' => '100px;'],
    ],
    [
        'header' => '退租时间',
        'value' => 'end_time',
        'format' => ['date', 'php:Y-m-d'],
        'options' => ['width' => '100px;'],
    ],
    [
        'label' => '数量',
        'value' => 'num',
        'options' => ['width' => '50px;'],
    ],
    [
        'label' => '支付状态',
        'attribute' => 'pay_status',
        'options' => ['width' => '80px;'],
        'content' => function($model){
            return Yii::$app->params['pay_status'][$model['pay_status']];
        },
        'filter' => Html::activeDropDownList($searchModel, 'pay_status', [0 => '未支付',1 => '已支付'], ['prompt'=>'全部','class'=>'form-control']),

    ],
    [
        'label' => '订单时间',
        'attribute' => 'create_time',
        'options' => ['width' => '150px;'],
        'format' =>  ['date', 'php:Y-m-d H:i'],
        'filter' => \kartik\widgets\DatePicker::widget([
            'type' => \kartik\widgets\DatePicker::TYPE_RANGE,
            'language' => 'zh-CN',
            'layout' => '{input1}<br>{input2}',
            'name' => 'OrderSearch[from_date]',
            'value' => $searchModel->from_date,
            'options' =>  ['class'=>'form-control','placeholder' => '开始时间'],
            'name2' => 'OrderSearch[to_date]',
            'value2' => $searchModel->to_date,
            'options2' => ['class'=>'form-control','placeholder' => '结束时间'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ])
    ],
    [
        'label' => '支付类型',
        'attribute' => 'pay_type',
        'options' => ['width' => '80px;'],
        'content' => function($model){
            return Yii::$app->params['pay_type'][$model['pay_type']];
        },
        'filter' => Html::activeDropDownList($searchModel, 'pay_type', [1 => '微信',2 => '支付宝',3 => '银联'], ['prompt'=>'全部','class'=>'form-control']),
    ],
    [
        'label' => '支付途径',
        'attribute' => 'pay_source',
        'options' => ['width' => '80px;'],
        'content' => function($model){
            return Yii::$app->params['pay_source'][$model['pay_source']];
        },
        'filter' => Html::activeDropDownList($searchModel, 'pay_source', [1 => '网站',2 => '微信',3 => '后台'],['prompt'=>'全部','class'=>'form-control']),
    ],
    [
        'label' => '状态',
        'options' => ['width' => '50px;'],
        'content' => function($model){
            return $model['status']?'正常':'隐藏';
        }
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'header' => '操作',
        'template' => '{edit} {delete}',
        'options' => ['width' => '200px;'],
        'buttons' => [
            'edit' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-edit"></i>', $url, [
                    'title' => Yii::t('app', '编辑'),
                    'class' => 'btn btn-xs purple'
                ]);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-times"></i>', $url, [
                    'title' => Yii::t('app', '删除'),
                    'class' => 'btn btn-xs red ajax-get confirm'
                ]);
            },
        ],
        'headerOptions' => [],
    ],
];

?>

<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">管理信息</span>
        </div>
        <div class="actions">
            <div class="btn-group btn-group-devided">
                <?=Html::a('添加商品订单 <i class="fa fa-plus"></i>',['add','type'=>'shop'],['class'=>'btn green','style'=>'margin-right:10px;'])?>
                <?=Html::a('添加培训订单 <i class="fa fa-plus"></i>',['add','type'=>'train'],['class'=>'btn green','style'=>'margin-right:10px;'])?>
                <?=Html::a('删除 <i class="fa fa-times"></i>',['delete'],['class'=>'btn green ajax-post confirm','target-form'=>'ids','style'=>'margin-right:10px;'])?>
                <?=Html::a('清空搜索 <i class="fa fa-times"></i>',['order/index'],['class'=>'btn green','style'=>'margin-right:10px;'])?>
            </div>
            <div class="btn-group">
                <button class="btn blue btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                    工具箱
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="javascript:;"><i class="fa fa-pencil"></i> 导出Excel </a></li>
                    <li class="divider"> </li>
                    <li><a href="javascript:;"> 其他 </a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <?php \yii\widgets\Pjax::begin(['options'=>['id'=>'pjax-container']]); ?>
        <div>
            <?php //echo $this->render('_search', ['model' => $searchModel]); ?> <!-- 条件搜索-->
        </div>
        <div class="table-container">
            <form class="ids">
            <?= GridView::widget([
                'dataProvider' => $dataProvider, // 列表数据
                'filterModel' => $searchModel, // 搜索模型
                'options' => ['class' => 'grid-view table-scrollable'],
                /* 表格配置 */
                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer'],
                /* 重新排版 摘要、表格、分页 */
                'layout' => '{items}<div class=""><div class="col-md-5 col-sm-5">{summary}</div><div class="col-md-7 col-sm-7"><div class="dataTables_paginate paging_bootstrap_full_number" style="text-align:right;">{pager}</div></div></div>',
                /* 配置摘要 */
                'summaryOptions' => ['class' => 'pagination'],
                /* 配置分页样式 */
                'pager' => [
                    'options' => ['class'=>'pagination','style'=>'visibility: visible;'],
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                    'firstPageLabel' => '第一页',
                    'lastPageLabel' => '最后页'
                ],
                /* 定义列表格式 */
                'columns' => $columns,
            ]); ?>
            </form>
        </div>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>


<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
jQuery(document).ready(function() {
    highlight_subnav('order/index'); //子导航高亮
});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
