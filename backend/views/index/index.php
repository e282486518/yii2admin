<?php
/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '测试标题';
$this->params['title_sub'] = '测试标题的子标题或提示信息';

/* 渲染其他文件 */
//echo $this->renderFile('@app/views/public/login.php');

/* 加载页面级别JS */
//$this->registerJsFile('@web/static/common/js/app.js');

?>

<div class="note note-info">
    <p> Dark mega menu style. 这里是提示信息 </p>
</div>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1349">0</span>
                </div>
                <div class="desc"> New Feedbacks </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5">0</span>M$ </div>
                <div class="desc"> Total Profit </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="549">0</span>
                </div>
                <div class="desc"> New Orders </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number"> +
                    <span data-counter="counterup" data-value="89"></span>% </div>
                <div class="desc"> Brand Popularity </div>
            </div>
        </a>
    </div>
</div>
<div class="clearfix"></div>

<div class="row-fluid margin-bottom-30">
    <div class="span6">
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </p>
        <ul class="unstyled margin-top-10 margin-bottom-10">
            <li><i class="icon-ok"></i> Nam liber tempor cum soluta</li>
            <li><i class="icon-ok"></i> Mirum est notare quam</li>
            <li><i class="icon-ok"></i> Lorem ipsum dolor sit amet</li>
            <li><i class="icon-ok"></i> Mirum est notare quam</li>
        </ul>
        <!-- Blockquotes -->
        <blockquote class="hero">
            <p>Lorem ipsum dolor sit amet, consectetuer sed diam nonummy nibh euismod tincidunt. </p>
            <small>Bob Nilson</small>
        </blockquote>
    </div>
</div>


<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
jQuery(document).ready(function() {
    highlight_subnav('index/index'); //子导航高亮
});
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
