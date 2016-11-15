<?php
namespace backend\controllers;

use Yii;
use common\helpers\ArrayHelper;
use common\core\Controller;
use backend\models\Menu;
use backend\models\Config;
use yii\base\Model;
use yii\helpers\Url;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

/*
 * ---------------------------------------
 * 后台父类控制器 
 * 后台所有控制器都继承自该类
 * @author phphome@qq.com 
 * ---------------------------------------
 */
class BaseController extends Controller
{

    /* 控制器默认操作 */
    public $defaultAction = 'index';

    /* 布局页面 优先级 控制器中>设置中>系统默认，false关闭 */
    public $layout = 'main';

    /* 定义变量,在layout中用$this->context访问 */
    public $menu   = [];       // 当前用户允许访问的栏目
    public $breadcrumbs = [];  // 面包屑导航
    public $admins = [];       // 当前登录的管理员信息
    public $title_sub = '';    // 页面子标题或提示

    /**
     * ---------------------------------------
     * 后台构造函数
     * ---------------------------------------
     */
    public function init(){
        /* 判断是否登录 */
        if (\Yii::$app->user->getIsGuest()) {
            $this->redirect(Url::toRoute(['/login/login']));
            Yii::$app->end();
        }

        /* 获取当前登录用户信息 */
        $this->admins = Yii::$app->user->identity->getAttributes();

        /* 解析数据库配置，解析后存放在Yii::$app->params['web']中 */
        Yii::$app->params['web'] = Config::lists();

    }

    /**
     * ---------------------------------------
     * 在执行所有动作之前，先执行这个方法。用于权限验证
     * @param \yii\base\Action $action
     * @return bool true-继续执行/false-终止执行
     * ---------------------------------------
     */
    public function beforeAction($action){
        /* 后台栏目 */
        $this->menu = $this->getMenus();
        //var_dump($this->menu);

        /* 获取当前访问的 controller/action */
        $controller = $this->id;
        $action     = $this->action->id;
        $rule  = strtolower($controller.'/'.$action);

        if ( !$this->checkRule($rule) ){
            echo 'Access Denied';
            return false;
        }
        return true;
    }
    
    /**
     * ---------------------------------------
     * 权限检测
     * @param string  $rule    检测的规则
     * @return boolean
     * ---------------------------------------
     */
    final protected function checkRule($rule){

        /* 超级管理员允许访问任何页面 */
        if(Yii::$app->params['admin'] == Yii::$app->user->id){
            return true;
        }//var_dump($rule);exit();

        /* rbac */
        if (!\Yii::$app->user->can($rule)) {
            return false;
        }
        return true;

    }
    
    /**
     * ---------------------------------------
     * 标记当前位置到cookie供后续跳转调用
     * ---------------------------------------
     */
    public function setForward(){
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name'  => '__forward__',
            'value' => $_SERVER['REQUEST_URI'],
        ]));
    }

    /**
     * ---------------------------------------
     * 获取之前标记的cookie位置
     * @param string $default
     * @return mixed
     * ---------------------------------------
     */
    public function getForward($default=''){
        $default = $default ? $default : Url::toRoute([Yii::$app->controller->id.'/index']);
        return Yii::$app->request->cookies->getValue('__forward__', $default);
    }

    /**
     * ---------------------------------------
     * 传统分页列表数据集获取方法
     * @param \yii\db\ActiveRecord $model   模型名或模型实例
     * @param array $where   where查询条件
     * @param array|string $order   排序条件
     * @return array|false
     * ---------------------------------------
     */
    public function lists($model, $where=[], $order=''){
        $query = $model::find()->where($where);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10,
        ]);
        $data  = $query->orderBy($order)->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return [$data, $pages];
    }

    /**
     * ---------------------------------------
     * dataProvider列表数据集获取方法
     * @param \yii\db\ActiveRecord $model   模型名或模型实例
     * @param array        $where   where查询条件
     * @param array|string $order   排序条件
     * @return \yii\data\ActiveDataProvider
     * ---------------------------------------
     */
    public function lists1($model, $where=[], $order=''){
        $query = $model::find()->where($where)->orderBy($order)->asArray();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }

    /**
     * ---------------------------------------
     * 修改数据表一条记录的一条值
     * @param \yii\db\ActiveRecord $model 模型名称
     * @param array  $data 数据
     * @return \yii\db\ActiveRecord|boolean
     * ---------------------------------------
     */
    public function saveRow($model, $data){
        if (empty($data)) {
            return false;
        }
        if ($model->load($data, '') && $model->validate()) {
            /* 添加到数据库中,save()会自动验证rule */
            if ($model->save()) {
                return $model;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * ---------------------------------------
     * 由表主键删除数据表中的多条记录
     * @param \yii\db\ActiveRecord $model 模型名称,供M函数使用的参数
     * @param string  $pk  修改的数据
     * @return boolean
     * ---------------------------------------
     */
    public function delRow($model, $pk='id' ){
        $ids = Yii::$app->request->param($pk, 0);
        $ids = implode(',', array_unique((array)$ids));

        if ( empty($ids) ) {
            return false;
        }

        $_where = $pk.' in('.$ids.')';
        if($model::deleteAll($_where)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * ---------------------------------------
     * 获取控制器菜单数组,二级菜单元素位于一级菜单的'_child'元素中
     * @return array $menus
     * ---------------------------------------
     */
    final public function getMenus(){
        $menus = [];
        /* 获取一级栏目 pid=0 and hide=0 */
        $menus['main'] = (new \yii\db\Query())->from(Menu::tableName())
                        ->where(['pid'=>0, 'hide'=>0])
                        ->orderBy('sort ASC')
                        ->all();
        $menus['child'] = []; //设置子节点

        /* 高亮 当前栏目 及其所有父栏目 */
        $controller = $this->id;
        $action     = $this->action->id;
        $rule  = strtolower($controller.'/'.$action);
        $current = (new \yii\db\Query())->select('id')->from(Menu::tableName())
                    ->where(['and' ,'pid != 0' ,['like', 'url', $rule]])->one();
        /* 面包屑导航 */
        $this->breadcrumbs = $nav = Menu::getParentMenus($current['id']);
        //var_dump($nav);

        /* 获取一级栏目 */
        foreach ($menus['main'] as $key => $item) {
            if (!is_array($item) || empty($item['title']) || empty($item['url']) ) {
                // 弹出错误信息
            }
            /* 判断一级栏目权限 */
            if ( !$this->checkRule($item['url']) ) {
                unset($menus['main'][$key]);
                continue;//继续循环
            }
            /* 获取当前主菜单的子菜单项，其他子菜单不需要获取 */
            if ($nav[0]['id'] == $item['id']) {
                /* 设置当前菜单的一级菜单高亮 */
                $menus['main'][$key]['class']='active';

                /* 获取 二级菜单 */
                $second_menu = (new \yii\db\Query())->from(Menu::tableName())
                    ->where(['pid'=>$item['id'], 'hide'=>0])
                    ->orderBy('sort ASC')->all();

                /* 判断二级菜单权限 */
                if ($second_menu && is_array($second_menu)) {
                    foreach ($second_menu as $skey => $check_menu) {
                        if ( !$this->checkRule($check_menu['url']) ) {
                            unset($second_menu[$skey]);
                            continue;//继续循环
                        }
                    }
                }//var_dump($second_menu);

                /* 生成child树 */
                $groups = Menu::find()->select(['group'])
                    ->where(['pid'=>$item['id'], 'hide'=>0])
                    ->groupBy(['group'])->orderBy('sort ASC')->asArray()->column();
                //var_dump($groups);exit;

                /* 按照group分组，生成子菜单树 */
                foreach ($groups as $k => $g) {
                    $menuList = (new \yii\db\Query())->from(Menu::tableName())
                                ->where(['pid'=>$item['id'], 'hide'=>0, 'group'=>$g, 'url'=>$second_menu])
                                ->orderBy('sort ASC')->all();
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
    public function returnNodes($tree = true){
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
            $nodes = ArrayHelper::list_to_tree($list,$pk='id',$pid='pid',$child='operator',$root=0);
            foreach ($nodes as $key => $value) {
                if(!empty($value['operator'])){
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
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

    /**
     * ----------------------------------------------
     * 操作错误跳转的快捷方法
     * @access protected
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     * -----------------------------------------------
     */
    protected function error($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,0,$jumpUrl,$ajax);
    }

    /**
     * ----------------------------------------------
     * 操作成功跳转的快捷方法
     * @access protected
     * @param string $message 提示信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     * ----------------------------------------------
     */
    protected function success($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,1,$jumpUrl,$ajax);
    }

    /**
     * ----------------------------------------------
     * 默认跳转操作 支持错误导向和正确跳转
     * 调用模板显示 默认为public目录下面的success页面
     * 提示页面为可配置 支持模板标签
     * @param string $message 提示信息
     * @param int $status 状态
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @access private
     * @return void
     * ----------------------------------------------
     */
    private function dispatchJump($message,$status=1,$jumpUrl='',$ajax=false) {
        $jumpUrl = !empty($jumpUrl)? (is_array($jumpUrl)?Url::toRoute($jumpUrl):$jumpUrl):'';
        if(true === $ajax || Yii::$app->request->isAjax) {// AJAX提交
            $data           =   is_array($ajax)?$ajax:array();
            $data['info']   =   $message;
            $data['status'] =   $status;
            $data['url']    =   $jumpUrl;
            $this->ajaxReturn($data);
        }
        // 成功操作后默认停留1秒
        $waitSecond = 3;

        if($status) { //发送成功信息
            $message = $message ? $message : '提交成功' ;// 提示信息
            // 默认操作成功自动返回操作前页面
            echo $this->renderFile(Yii::$app->params['action_success'],[
                'message' => $message,
                'waitSecond' => $waitSecond,
                'jumpUrl' => $jumpUrl,
            ]);
        }else{
            $message = $message ? $message : '发生错误了' ;// 提示信息
            // 默认发生错误的话自动返回上页
            $jumpUrl = "javascript:history.back(-1);";
            echo $this->renderFile(Yii::$app->params['action_error'], [
                'message' => $message,
                'waitSecond' => $waitSecond,
                'jumpUrl' => $jumpUrl,
            ]);
        }
        //Yii::$app->end();
        exit;
    }

    /**
     * ------------------------------------------------
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @return void
     * ------------------------------------------------
     */
    protected function ajaxReturn($data) {
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($data);
        //Yii::$app->end();
        exit;
    }

}
