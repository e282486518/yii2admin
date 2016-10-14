<?php

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
        <title>登录 | Yii2通用后台 by huanglongfei.cn</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?=Yii::getAlias('@web')?>/metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=Yii::getAlias('@web')?>/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=Yii::getAlias('@web')?>/metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=Yii::getAlias('@web')?>/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=Yii::getAlias('@web')?>/metronic/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=Yii::getAlias('@web')?>/metronic/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?=Yii::getAlias('@web')?>/metronic/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=Yii::getAlias('@web')?>/metronic/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=Yii::getAlias('@web')?>/metronic/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="<?=\yii\helpers\Url::toRoute('login/login')?>" method="post">
                <h3 class="form-title font-green">登录</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> 用户名或密码错误 </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">用户名</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="用户名" name="info[username]" /> 
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">密码</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="密码" name="info[password]" /> 
                </div>
                <div class="form-actions">
                    <label class="rememberme check mt-checkbox mt-checkbox-outline" style="padding-left:25px;">
                        <input type="checkbox" name="info[rememberMe]" value="1" checked/>记住我
                        <span></span>
                    </label>
                    <button type="submit" class="btn green pull-right" style="margin-top:-10px;">登录</button>
                </div>
                <div class="create-account"></div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <div class="copyright"> 2016 &copy; Metronic. huanglongfei.cn. </div>
        <!--[if lt IE 9]>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/respond.min.js"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=Yii::getAlias('@web')?>/metronic/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?=Yii::getAlias('@web')?>/metronic/pages/scripts/jquery.form.js" type="text/javascript"></script>
        <script src="<?=Yii::getAlias('@web')?>/metronic/pages/scripts/login.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
