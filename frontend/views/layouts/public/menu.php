<?php
use yii\helpers\Url;

?>
<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
<ul class="nav navbar-nav">
    <li class="menu-dropdown classic-menu-dropdown active">
        <a href="javascript:;"> 首页
            <span class="arrow"></span>
        </a>
        <ul class="dropdown-menu pull-left">
            <li class=" active">
                <a href="<?=Url::to('/')?>" class="nav-link  active">
                    <i class="icon-bar-chart"></i> 首页
                    <span class="badge badge-success">1</span>
                </a>
            </li>
            <li class=" ">
                <a href="<?=Url::to('/article')?>" class="nav-link ">
                    <i class="icon-bulb"></i> 文章内容 </a>
            </li>
            <li class=" ">
                <a href="<?=Url::to('/about/contact')?>" class="nav-link ">
                    <i class="icon-graph"></i> 联系我们
                    <span class="badge badge-danger">3</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-dropdown mega-menu-dropdown  ">
        <a href="javascript:;"> 用户界面
            <span class="arrow"></span>
        </a>
        <ul class="dropdown-menu" style="min-width: 710px">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="mega-menu-submenu">
                                <li>
                                    <a href="#"> 颜色库 </a>
                                </li>
                                <li>
                                    <a href="#"> 树形菜单 </a>
                                </li>
                                <li>
                                    <a href="#"> Google 地图 </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="mega-menu-submenu">
                                <li>
                                    <a href="#"> 菜单1 </a>
                                </li>
                                <li>
                                    <a href="#"> 菜单2 </a>
                                </li>
                                <li>
                                    <a href="#"> 菜单3 </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="mega-menu-submenu">
                                <li>
                                    <a href="#"> 菜单API </a>
                                </li>
                                <li>
                                    <a href="#"> 菜单1 </a>
                                </li>
                                <li>
                                    <a href="#"> 菜单2 </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li class="menu-dropdown classic-menu-dropdown ">
        <a href="javascript:;"> 布局
            <span class="arrow"></span>
        </a>
        <ul class="dropdown-menu pull-left">
            <li class=" ">
                <a href="#" class="nav-link  "> 高亮菜单1 </a>
            </li>
            <li class=" ">
                <a href="#" class="nav-link  "> 高亮菜单2 </a>
            </li>
            <li class=" ">
                <a href="#" class="nav-link "> 空白页 </a>
            </li>
        </ul>
    </li>
    <li class="menu-dropdown mega-menu-dropdown  mega-menu-full">
        <a href="javascript:;"> 组件
            <span class="arrow"></span>
        </a>
        <ul class="dropdown-menu" style="min-width: ">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="mega-menu-submenu">
                                <li>
                                    <h3>组件 1</h3>
                                </li>
                                <li>
                                    <a href="#"> 组件1内容 </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="mega-menu-submenu">
                                <li>
                                    <h3>组件 2</h3>
                                </li>
                                <li>
                                    <a href="#"> 组件2内容 </a>
                                </li>
                                <li>
                                    <a href="#"> 组件2内容 </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="mega-menu-submenu">
                                <li>
                                    <h3>组件 3</h3>
                                </li>
                                <li>
                                    <a href="#"> 组件3内容 </a>
                                </li>
                                <li>
                                    <a href="#"> 组件3内容 </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="mega-menu-submenu">
                                <li>
                                    <h3>组件 4</h3>
                                </li>
                                <li>
                                    <a href="#"> 组件4内容 </a>
                                </li>
                                <li>
                                    <a href="#"> 组件4内容 </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li class="menu-dropdown classic-menu-dropdown ">
        <a href="javascript:;"> 更多
            <span class="arrow"></span>
        </a>
        <ul class="dropdown-menu pull-left">
            <li class="dropdown-submenu ">
                <a href="javascript:;" class="nav-link nav-toggle ">
                    <i class="icon-settings"></i> 二级菜单
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单
                            <br>菜单补充内容 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单
                            <br>菜单补充内容 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu ">
                <a href="javascript:;" class="nav-link nav-toggle ">
                    <i class="icon-briefcase"></i> 二级菜单
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class="dropdown-submenu ">
                        <a href="javascript:;" class="nav-link nav-toggle"> 三级菜单
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a href="#" class="nav-link "> 四级菜单 </a>
                            </li>
                            <li class="">
                                <a href="#" class="nav-link "> 四级菜单 </a>
                            </li>
                            <li class="">
                                <a href="#" class="nav-link "> 四级菜单 </a>
                            </li>
                            <li class="">
                                <a href="#" class="nav-link "> 四级菜单 </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu ">
                <a href="?p=" class="nav-link nav-toggle ">
                    <i class="icon-wallet"></i> 二级菜单
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu ">
                <a href="?p=" class="nav-link nav-toggle ">
                    <i class="icon-settings"></i> 二级菜单
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu ">
                <a href="javascript:;" class="nav-link nav-toggle ">
                    <i class="icon-bar-chart"></i> 二级菜单
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 三级菜单 </a>
                    </li>
                    <li class="dropdown-submenu ">
                        <a href="javascript:;" class="nav-link nav-toggle"> 三级菜单
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a href="#" class="nav-link " target="_blank"> 四级菜单 </a>
                            </li>
                            <li class="">
                                <a href="#" class="nav-link " target="_blank"> 四级菜单 </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="menu-dropdown classic-menu-dropdown ">
        <a href="javascript:;">
            <i class="icon-briefcase"></i> 页面
            <span class="arrow"></span>
        </a>
        <ul class="dropdown-menu pull-left">
            <li class="dropdown-submenu ">
                <a href="javascript:;" class="nav-link nav-toggle ">
                    <i class="icon-basket"></i> 购物车
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-home"></i> 购物车 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-graph"></i> 编辑产品 </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu ">
                <a href="javascript:;" class="nav-link nav-toggle ">
                    <i class="icon-docs"></i> 页面
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-clock"></i> 时间轴 1 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-notebook"></i> 文件夹 </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu ">
                <a href="javascript:;" class="nav-link nav-toggle ">
                    <i class="icon-user"></i> 用户
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-user"></i> 简介 1 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-users"></i> 简介 2 </a>
                    </li>
                    <li class="dropdown-submenu ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-notebook"></i> 登录页
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a href="#" class="nav-link " target="_blank"> Login Page 1 </a>
                            </li>
                            <li class="">
                                <a href="#" class="nav-link " target="_blank"> Login Page 5 </a>
                            </li>
                        </ul>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link " target="_blank">
                            <i class="icon-lock"></i> Lock Screen 1 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link " target="_blank">
                            <i class="icon-lock-open"></i> Lock Screen 2 </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu ">
                <a href="javascript:;" class="nav-link nav-toggle ">
                    <i class="icon-social-dribbble"></i> 位置
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-info"></i> 关于我们 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-call-end"></i> 联系我们 </a>
                    </li>
                    <li class="dropdown-submenu ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-notebook"></i> 文件夹
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a href="#" class="nav-link "> 文件夹 1 </a>
                            </li>
                            <li class="">
                                <a href="#" class="nav-link "> 文件夹 4 </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-magnifier"></i> 搜索
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a href="#" class="nav-link "> 搜索 1 </a>
                            </li>
                            <li class="">
                                <a href="#" class="nav-link "> 搜索 4 </a>
                            </li>
                            <li class="">
                                <a href="#" class="nav-link "> 搜索 5 </a>
                            </li>
                        </ul>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-tag"></i> 标签 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-wrench"></i> 问题 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link ">
                            <i class="icon-envelope"></i> 信箱 2 </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu ">
                <a href="javascript:;" class="nav-link nav-toggle ">
                    <i class="icon-settings"></i> 系统
                    <span class="arrow"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" ">
                        <a href="#" class="nav-link " target="_blank"> 系统1 </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link "> 404 Page </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="nav-link " target="_blank"> 500 Page </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>