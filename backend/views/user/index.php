<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $model common\modelsgii\User */
/* @var $dataProvider yii\data\ActiveDataProvider  */
/* @var $searchModel backend\models\search\UserSearch */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '用户管理';
$this->params['title_sub'] = '管理用户信息';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

/* 加载页面级别资源 */
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
        'header' => 'UID',
        'attribute' => 'uid',
        'options' => ['width' => '50px;']
    ],
    [
        'header' => '用户名',
        'attribute' => 'username',
        'options' => ['width' => '150px;']
    ],
    [
        'header' => '邮箱',
        'attribute' => 'email',
        'options' => ['width' => '150px;']
    ],
    [
        'header' => '手机',
        'attribute' => 'mobile',
        'options' => ['width' => '100px;']
    ],
    [
        'header' => '最后登录时间',
        'attribute' => 'last_login_time',
        'options' => ['width' => '150px;'],
        'format' => ['date', 'php:Y-m-d H:i']
    ],
    [
        'header' => '最后登录IP',
        'attribute' => 'last_login_ip',
        'options' => ['width' => '120px;'],
        'content' => function($model){
            return long2ip($model['last_login_ip']);
        }
    ],
    [
        'header' => '当前积分',
        'attribute' => 'score',
        'options' => ['width' => '80px;'],
    ],
    [
        'header' => '总积分',
        'attribute' => 'score_all',
        'options' => ['width' => '80px;'],
    ],
    [
        'header' => '状态',
        'attribute' => 'status',
        'options' => ['width' => '50px;'],
        'content' => function($model){
            return $model['status'] ?
                Html::tag('span','正常',['class'=>'badge badge-success']) :
                Html::tag('span','删除',['class'=>'badge badge-important']);
        }
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'header' => '操作',
        'template' => '{edit} {tuijian} {delete}',
        //'options' => ['width' => '200px;'],
        'buttons' => [
            'edit' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-edit"></i> 编辑', ['edit','uid'=>$key], [
                    'title' => Yii::t('app', '编辑'),
                    'class' => 'btn btn-xs purple'
                ]);
            },
            'tuijian' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-jpy"></i> 推荐', ['order/index', 'tuid'=>$key], [
                    'title' => Yii::t('app', '推荐人订单查询'),
                    'class' => 'btn btn-xs red'
                ]);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-times"></i>', ['delete', 'id'=>$key], [
                    'title' => Yii::t('app', '删除'),
                    'class' => 'btn btn-xs red ajax-get confirm'
                ]);
            }
        ],
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
                <?=Html::a('添加 <i class="icon-plus"></i>',['add'],['class'=>'btn green'])?>
                <?=Html::a('所有用户 <i class="icon-user"></i>',['','is_all'=>'1'],['class'=>'btn green'])?>
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
            <?php echo $this->render('_search', ['model' => $searchModel]); ?> <!-- 条件搜索-->
        </div>
        <div class="table-container">
            <form class="ids">
            <?= GridView::widget([
                'dataProvider' => $dataProvider, // 列表数据
                //'filterModel' => $searchModel, // 搜索模型
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
    highlight_subnav('user/index'); //子导航高亮
});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
