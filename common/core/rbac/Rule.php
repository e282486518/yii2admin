<?php

namespace common\core\rbac;


/**
 *
 */
class Rule extends \yii\rbac\Rule
{

    /**
     * Executes the rule.
     *
     * @param string|integer $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[ManagerInterface::checkAccess()]].
     * @return boolean a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params){
        //var_dump($user);
        //var_dump($item);
        //var_dump($params);
        return true;
    }
}
