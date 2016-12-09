<?php

namespace common\core\rbac;

use Yii;
use yii\rbac\Item;


/**
 * 重写rbac数据库管理
 */
class DbManager extends \yii\rbac\DbManager
{
    /**
     * ---------------------------------------
     * 当Rule不存在时添加
     * 同时将auth_item添加或更新
     * @param  string  $name  rule名称
     * @param  object  $rule  规则对象
     * ---------------------------------------
     */
    public function saveRule($name){
        /* 判断auth_rule表是否存在 */
        if ($rule = $this->getRule($name)) {
            /* 更新 */

        } else {
            /* 添加 */
            $rule = new Rule();
            $rule->name = $name;
            $this->add($rule);
        }

        /* 判断auth_item表是否存在 */
        if ($item = $this->getItem($name)) {
            /* 更新 */

        } else {
            /* 添加 */
            $item = new Item();
            $item->name = $name;
            $item->type = 2;
            $item->ruleName = $name;
            $this->add($item);
        }
    }

    /**
     * ---------------------------------------
     * 保存角色的权限分配
     * @param  string  $parent  角色name
     * @param  string  $child   权限name
     * ---------------------------------------
     */
    public function saveChild($parent, $child){
        /* 判断auth_item_child表是否存在 */
        $parent = $this->getRole($parent);
        $child  = $this->getItem($child);
        if (!$this->hasChild($parent, $child)) {
            $this->addChild($parent, $child);
        }

    }

    /**
     * ---------------------------------------
     * 更新auth_item
     * ---------------------------------------
     */
    protected function updateRule($name, $rule)
    {
        if ($rule->name !== $name && !$this->supportsCascadeUpdate()) {
            $this->db->createCommand()
                ->update($this->itemTable, [
                    'rule_name' => $rule->name,
                    'name' => $rule->name,
                ], [
                    'rule_name' => $name
                ])->execute();
        }

        $rule->updatedAt = time();

        $this->db->createCommand()
            ->update($this->ruleTable, [
                'name' => $rule->name,
                'data' => serialize($rule),
                'updated_at' => $rule->updatedAt,
            ], [
                'name' => $name,
            ])->execute();

        $this->invalidateCache();

        return true;
    }

}
