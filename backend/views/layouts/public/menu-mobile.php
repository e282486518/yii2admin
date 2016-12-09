<div class="page-sidebar-wrapper">
    <!-- BEGIN RESPONSIVE MENU FOR HORIZONTAL & SIDEBAR MENU -->
    <ul class="page-sidebar-menu visible-sm visible-xs  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
        <!-- DOC: This is mobile version of the horizontal menu. The desktop version is defined(duplicated) in the header above -->
        <li class="sidebar-search-wrapper">
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
            <form class="sidebar-search sidebar-search-bordered" action="" method="GET">
                <a href="javascript:;" class="remove">
                    <i class="icon-close"></i>
                </a>
                <div class="input-group">
                    <input name="s" type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn submit">
                            <i class="icon-magnifier"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        
        <?php if(!empty($allMenu['main']) && is_array($allMenu['main'])):?>
        <?php foreach ($allMenu['main'] as $menu): ?>
        <li class="nav-item <?php if (isset($menu['class'])) {echo 'active open';} ?>">
            <a href="<?=\yii\helpers\Url::toRoute($menu['url'])?>" class="nav-link nav-toggle">
                <?=$menu['title']?>
                <?php if (isset($menu['class'])) {echo '<span class="selected"></span>';} ?>
                <span class="arrow <?php if (isset($menu['class'])) {echo 'open';} ?>"> </span>
            </a>
            <?php if (!isset($menu['class'])) { continue;} ?>
            <ul class="sub-menu">
                
                <?php if(!empty($allMenu['child']) && is_array($allMenu['child'])):?>
                <?php foreach ($allMenu['child'] as $menu): ?>
                <li class="nav-item <?php if (isset($menu['class'])) {echo 'active open';} ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="<?=$menu['icon']?>"></i>
                        <span class="title"><?=$menu['name']?></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if(!empty($menu['_child']) && is_array($menu['_child'])):?>
                        <?php foreach ($menu['_child'] as $v): ?>
                        <li class="nav-item <?php if (isset($v['class'])) {echo 'active open';} ?>">
                            <a href="<?=\yii\helpers\Url::toRoute($v['url'])?>" nav="<?=$v['url']?>" class="nav-link ">
                                <!--<i class="icon-bar-chart"></i>-->
                                <span class="title"><?=$v['title']?></span>
                            </a>
                        </li>
                        <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </li>
                <?php endforeach ?>
                <?php endif ?>
                
            </ul>
        </li>
        <?php endforeach; ?>
        <?php endif; ?>
        
    </ul>
    <!-- END RESPONSIVE MENU FOR HORIZONTAL & SIDEBAR MENU -->
</div>