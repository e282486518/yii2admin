<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $model common\modelsgii\ArticleCat */
/* @var $dataProvider yii\data\ActiveDataProvider  */
/* @var $searchModel backend\models\search\ArticleCatSearch */

/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '分类管理';
$this->params['title_sub'] = '';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数

/* 加载页面级别资源 */
\backend\assets\TablesAsset::register($this);
\backend\assets\TreeAsset::register($this);

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
        'attribute' => 'id',
        'options' => ['width' => '50px;']
    ],
    [
        'header' => '名称',
        'attribute' => 'title'
    ],
    [
        'header' => '标识',
        'options' => ['width' => '150px;'],
        'attribute' => 'name'
    ],
    /*[
        'header' => '上级分类',
        'content' => function($model){
            $str = '';
            if ($model['pid'] == 0) {
                $str .= '<span style="color:#f00;">一级分类</span>';
            } else {
                $paths = ArticleCat::getParents($model['id']);
                foreach ($paths as $value) {
                    $str .= $value['title'] .' > ';
                }
                $str = rtrim($str, ' > ');
            }
            return $str;
        }
    ],*/
    [
        'label' => '排序',
        'value' => 'sort',
        'options' => ['width' => '50px;'],
    ],
    [
        'label' => '状态',
        'options' => ['width' => '50px;'],
        'content' => function($model){
            return '正常';
        }
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'header' => '操作',
        'template' => '{edit} {addsub} {delete}',
        'options' => ['width' => '200px;'],
        'buttons' => [
            /*'view' => function ($url, $model, $key) {
                return Html::a('<i class="icon-eye"></i>', ['index', 'pid'=>$model['id']], [
                    'title' => Yii::t('app', '下级菜单'),
                    'class' => 'btn btn-xs blue'
                ]);
            },*/
            'edit' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-edit"></i>', ['edit', 'id'=>$model['id']], [
                    'title' => Yii::t('app', '编辑'),
                    'class' => 'btn btn-xs purple'
                ]);
            },
            'addsub' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-plus"></i>', ['add', 'pid'=>$model['id']], [
                    'title' => Yii::t('app', '添加子菜单'),
                    'class' => 'btn btn-xs red'
                ]);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-times"></i>', ['delete', 'id'=>$model['id']], [
                    'title' => Yii::t('app', '删除'),
                    'class' => 'btn btn-xs red ajax-get confirm'
                ]);
            },
        ],
    ],
];

?>
<div class="row">
    <div class="col-md-3">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">Tree栏目管理</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body">
                <div id="tree_3" class="tree-demo">

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">管理信息</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <?=Html::a('添加 <i class="fa fa-plus"></i>',['add','pid'=>Yii::$app->request->get('pid',0)],['class'=>'btn green','style'=>'margin-right:10px;'])?>
                        <?=Html::a('删除 <i class="fa fa-times"></i>',['delete'],['class'=>'btn green ajax-post confirm','target-form'=>'ids','style'=>'margin-right:10px;'])?>
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
                    <?= $this->render('_search', ['model' => $searchModel]); ?>
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
    </div>
</div>



<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
jQuery(document).ready(function() {
    highlight_subnav('article-cat/index'); //子导航高亮

    /* jstree栏目管理 */
    $("#tree_3").jstree({
        "plugins" : [ "state", "types" ],
        "core" : {
            "themes" : {
                "responsive": false
            }, 
            // so that create works
            "check_callback" : true,
            'data': {
                "url" : "<?=Url::toRoute('/article-cat/tree');?>",
                "dataType" : "json"
            }
            /*'data': [
                {
                    "text": "子节点一",
                    "state": {
                        "opened": true
                    },
                    "children": [
                        {"text": "叶子节点一", "icon" : "fa fa-file icon-state-warning"}
                    ]
                }, {
                    "text": "子节点二",
                    "icon": "fa fa-folder icon-state-danger",
                    "state": {
                        "opened": true
                    },
                    "children": [
                        {"text": "叶子节点一", "icon" : "fa fa-file icon-state-warning"}
                    ]
                }, {
                    "text": "子节点三",
                    "icon": "fa fa-folder icon-state-success",
                    "state": {
                        "opened": true
                    },
                    "children": [
                        {"text": "叶子节点一", "icon" : "fa fa-file icon-state-warning"}
                    ]
                }, {
                    "text": "子节点四",
                    "icon": "fa fa-folder icon-state-warning",
                    "state": {
                        "opened": true
                    },
                    "children": [
                        {"text": "叶子节点一", "icon" : "fa fa-file icon-state-warning"}
                    ]
                }, {
                    "text": "子节点五",
                    "icon": "fa fa-folder icon-state-success",
                    "state": {
                        "disabled": true
                    },
                    "children": [
                        {"text": "叶子节点一", "icon" : "fa fa-file icon-state-warning"}
                    ]
                }, {
                    "text": "子节点六",
                    "icon": "fa fa-folder icon-state-danger",
                    "state": {
                        "opened": true
                    },
                    "children": [
                        {"text": "子节点六 1", "icon" : "fa fa-file icon-state-warning"},
                        {"text": "子节点六 2", "icon" : "fa fa-file icon-state-success"},
                        {"text": "子节点六 3", "icon" : "fa fa-file icon-state-default"},
                        {"text": "子节点六 4", "icon" : "fa fa-file icon-state-danger"},
                        {"text": "子节点六 5", "icon" : "fa fa-file icon-state-info"}
                    ]
                }
            ]*/
        },
        "types" : {
            "default" : {
                "icon" : "fa fa-folder icon-state-warning icon-lg"
            },
            "file" : {
                "icon" : "fa fa-file icon-state-warning icon-lg"
            }
        },
        "state" : { "key" : "demo2" }
    });

    $("#tree_3").on('activate_node.jstree', function(e, data){
        var currentNode = data.node;
        console.log(currentNode);
    });

});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
