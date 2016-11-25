<?php

namespace api\models;

use Yii;
use yii\web\IdentityInterface;
use yii\filters\RateLimitInterface;

/**
 * 实现User组件中的身份识别类 参见 yii\web\user
 * This is the model class for table "{{%user}}".
 *
 */
class User extends \common\models\User implements IdentityInterface,RateLimitInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE  = 1;

    /**
     * --------------------------------------------------------------
     * 实现IdentityInterface
     * 资料参考：http://www.yiichina.com/doc/guide/2.0/rest-authentication
     * --------------------------------------------------------------
     */

    /**
     * 根据UID获取账号信息
     */
    public static function findIdentity($uid)
    {
        return static::findOne(['uid' => $uid, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * ---------------------------------------
     * 由token获取用户信息
     * @param mixed $token
     * @param null $type
     * @return null|static
     * ---------------------------------------
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /* 这里为了简便将数据库token字段设置成username */
        /* 使用 /api/v1/user?access-token=e282486518 即可访问 */
        return static::findOne(['username' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->salt;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * --------------------------------------------------------------
     * 实现RateLimitInterface
     * 以下是接口调用速率限制信息，记得在数据库中添加两个字段allowance,allowance_updated_at
     * 资料参考：http://www.yiichina.com/doc/guide/2.0/rest-rate-limiting
     * --------------------------------------------------------------
     */

    // 返回某一时间允许请求的最大数量，比如设置10秒内最多5次请求（小数量方便我们模拟测试）
    public  function getRateLimit($request, $action){
        return [5, 10];
    }

    // 回剩余的允许的请求和相应的UNIX时间戳数 当最后一次速率限制检查时
    public  function loadAllowance($request, $action){
        return [$this->allowance, $this->allowance_updated_at];
    }

    // 保存允许剩余的请求数和当前的UNIX时间戳
    public  function saveAllowance($request, $action, $allowance, $timestamp){
        $this->allowance = $allowance;
        $this->allowance_updated_at = $timestamp;
        $this->save();
    }



}
