<?php

namespace backend\models;

use Yii;
use common\helpers\ArrayHelper;

class Menu extends \common\modelsgii\Menu
{
    /**
     * 配置model规则
     */
    public function rules()
    {
        return [
            [['title','url'],'required'],
            [['pid', 'sort', 'hide', 'status'], 'integer'],
            [['title', 'group'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * ---------------------------------------
     * 栏目权限检测
     * @param string  $rule    检测的规则
     * @return boolean
     * ---------------------------------------
     */
    public static function checkRule($rule){

        /* 超级管理员允许访问任何页面 */
        if(Yii::$app->params['admin'] == Yii::$app->user->id){
            return true;
        }
        /* rbac */
        if (!\Yii::$app->user->can($rule)) {
            return false;
        }
        return true;

    }

    /**
     * ---------------------------------------
     * 递归获取其所有父栏目
     * @param $id 
     * @return array
     * ---------------------------------------
     */
    public static function getParentMenus($id){
        $path = [];
        $nav = static::find()->select(['id','pid','title'])->where(['id'=>$id])->asArray()->one();
        $path[] = $nav;
        if($nav['pid'] > 0){
            $path = array_merge(static::getParentMenus($nav['pid']),$path);
        }
        return $path;
    }


    public static function getBreadcrumbs($rule = 'index/index'){
        /* 高亮 当前栏目 及其所有父栏目 */
        $rule    = strtolower($rule);
        $current = static::find()->select('id')->where(['and' ,'pid != 0' ,['like', 'url', $rule]])->asArray()->one();
        /* 面包屑导航 */
        $nav     = static::getParentMenus($current['id']);
        return $nav;
    }

    /**
     * ---------------------------------------
     * 获取控制器菜单数组,二级菜单元素位于一级菜单的'_child'元素中
     * @param string $rule
     * @return array $menus
     * ---------------------------------------
     */
    public static function getMenus($rule = 'index/index'){
        $menus = [];
        /* 获取一级栏目 pid=0 and hide=0 */
        $menus['main']  = static::find()->where(['pid'=>0, 'hide'=>0])->orderBy('sort ASC')->asArray()->all();
        $menus['child'] = []; //设置子节点

        /* 面包屑导航 */
        $nav = static::getBreadcrumbs($rule);

        /* 获取一级栏目 */
        foreach ($menus['main'] as $key => $item) {
            if (!is_array($item) || empty($item['title']) || empty($item['url']) ) {
                // 弹出错误信息
            }
            /* 判断一级栏目权限 */
            if ( !static::checkRule($item['url']) ) {
                unset($menus['main'][$key]);
                continue;//继续循环
            }
            /* 获取当前主菜单的子菜单项，其他子菜单不需要获取 */
            if ($nav[0]['id'] == $item['id']) {
                /* 设置当前菜单的一级菜单高亮 */
                $menus['main'][$key]['class']='active';

                /* 获取 二级菜单 */
                $second_menu = static::find()->where(['pid'=>$item['id'], 'hide'=>0])->orderBy('sort ASC')->asArray()->all();

                /* 判断二级菜单权限 */
                if ($second_menu && is_array($second_menu)) {
                    foreach ($second_menu as $skey => $check_menu) {
                        if ( !static::checkRule($check_menu['url']) ) {
                            unset($second_menu[$skey]);
                            continue;//继续循环
                        }
                    }
                }//var_dump($second_menu);

                /* 生成child树 */
                $groups = static::find()->select(['group','min(sort) as sort'])
                    ->where(['pid'=>$item['id'], 'hide'=>0])
                    ->groupBy(['group'])->orderBy('sort ASC')->asArray()->column();
                //var_dump($groups);exit;

                /* 按照group分组，生成子菜单树 */
                foreach ($groups as $k => $g) {
                    $menuList = static::find()
                        ->where(['pid'=>$item['id'], 'hide'=>0, 'group'=>$g, 'url'=>$second_menu])
                        ->orderBy('sort ASC')->asArray()->all();
                    /* 设置 分组名称、分组图标样式 */
                    list($g_name, $g_icon) = strpos($g, '|') ? explode('|',$g) :[$g, 'icon-cogs'];
                    $menus['child'][$k]['name'] = $g_name;
                    $menus['child'][$k]['icon'] = $g_icon;
                    /* 分组内容 */
                    $menus['child'][$k]['_child'] = ArrayHelper::list_to_tree($menuList, 'id', 'pid', 'operater', $item['id']);
                }
            }
        }
        //var_dump($menus['child'][0]);var_dump($menus['main']);exit;
        return $menus;
    }

    /**
     * ---------------------------------------
     * 根据menu库，返回权限节点，或后台菜单
     * @param boolean $tree 是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @return array
     * ---------------------------------------
     */
    public static function returnNodes($tree = true){
        /* 如果已经生成，直接调用 */
        static $tree_nodes = array();
        if ( $tree && !empty($tree_nodes[(int)$tree]) ) {
            return $tree_nodes[$tree];
        }
        /* 生成节点 */
        if((int)$tree){
            $list = (new \yii\db\Query())
                ->select(['id','pid','title','url','hide'])
                ->from(Menu::tableName())
                ->orderBy(['sort'=>SORT_ASC])->all();
            $nodes = ArrayHelper::list_to_tree($list,$pk='id',$pid='pid',$child='child',$root=0);
        }else{
            $nodes = (new \yii\db\Query())
                ->select(['title','url','tip','pid'])
                ->from(Menu::tableName())
                ->orderBy(['sort'=>SORT_ASC])->all();
        }
        /* 节点赋值到静态变量中，以供下次调用 */
        $tree_nodes[(int)$tree]   = $nodes;

        return $nodes;
    }


}
