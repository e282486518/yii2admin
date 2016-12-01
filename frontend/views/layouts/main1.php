<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;


\frontend\assets\IeAsset::register($this);
\frontend\assets\CoreAsset::register($this);
\frontend\assets\ComponentsAsset::register($this);
\frontend\assets\AppAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>首页 | 前台huanglongfei.cn</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="网站描述" name="description" />
        <meta content="phphome@qq.com" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <?php $this->head() ?>
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="/favicon.ico" />
        <script language="JavaScript">
            var BaseUrl = "<?=Yii::getAlias('@web')?>";
        </script>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-md">
    <?php $this->beginBody() ?>
        <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="<?=Yii::getAlias('@web')?>">
                            <img src="<?=Yii::getAlias('@web/static/images/logo-default.jpg')?>" alt="logo" class="logo-default">
                        </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN 开始通知下拉 -->
                            <?php $this->beginContent('@app/views/layouts/public/notice.php') ?>
                            <?php $this->endContent() ?>
                            <!-- END NOTIFICATION DROPDOWN -->
                            
                            <li class="droddown dropdown-separator">
                                <span class="separator"></span>
                            </li>
                            
                            <!-- BEGIN USER LOGIN DROPDOWN 用户面板 -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?=Yii::getAlias('@web/static/images/avatar2.jpg')?>">
                                    <span class="username username-hide-mobile">Admin</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li><a href="#"><i class="icon-user"></i> 个人资料 </a></li>
                                    <li><a href="#"><i class="icon-calendar"></i> 我的日历 </a></li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-envelope-open"></i> 收件箱
                                            <span class="badge badge-danger"> 3 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-rocket"></i> 我的任务
                                            <span class="badge badge-success"> 7 </span>
                                        </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li><a href="#"><i class="icon-lock"></i> 锁屏 </a></li>
                                    <li><a href="#"><i class="icon-key"></i> 注销 </a></li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">切换快捷栏</span>
                                <i class="icon-logout"></i>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <form class="search-form" action="#" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="搜索" name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </form>
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN MEGA MENU 栏目 -->
                    <div class="hor-menu  ">
                        <?php $this->beginContent('@app/views/layouts/public/menu.php') ?>
                        <?php $this->endContent() ?>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <?=$content?>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php $this->beginContent('@app/views/layouts/public/footer.php') ?>
        <?php $this->endContent() ?>
        <!-- END FOOTER -->
    <?php \frontend\assets\LayoutAsset::register($this); ?>
    <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>