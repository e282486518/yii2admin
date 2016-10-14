<div class="hor-menu hidden-sm hidden-xs">
    <ul class="nav navbar-nav">
        <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
        
        <?php if(!empty($this->context->menu['main']) && is_array($this->context->menu['main'])):?>
        <?php foreach ($this->context->menu['main'] as $menu): ?>
        <li class="classic-menu-dropdown <?php if (isset($menu['class'])) {echo 'active';} ?>">
            <a href="<?=\yii\helpers\Url::toRoute($menu['url'])?>">
                <?=$menu['title']?>
                <?php if (isset($menu['class'])) {echo '<span class="selected"></span>';} ?>
            </a>
        </li>
        <?php endforeach; ?>
        <?php endif; ?>
        
        <li class="classic-menu-dropdown">
            <a href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true"> 
                其他
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-left">
                <li>
                    <a href="javascript:;"><i class="fa fa-bookmark-o"></i> 测试其他 </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
