<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\core;

use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\UnauthorizedHttpException;
use yii\web\Response;
use yii\web\Request;
use yii\web\User;

/**
 * HttpBearerAuth is an action filter that supports the authentication method based on HTTP Bearer token.
 *
 * You may use HttpBearerAuth by attaching it as a behavior to a controller or module, like the following:
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *         'tokenAuth' => [
 *             'class' => \common\core\TokenAuth::className(),
 *         ],
 *     ];
 * }
 * ```
 *
 * @author longfei <phphome@qq.com>
 * @since 2.0
 */
class TokenAuth extends HttpBearerAuth
{

    //public $optional = ['*'];

    /**
     * ---------------------------------------
     * 功能说明
     *
     * @param \yii\base\Action $action
     * @return bool
     * @throws UnauthorizedHttpException
     * @author hlf <phphome@qq.com> 2020/5/21
     * ---------------------------------------
     */
    public function beforeAction($action)
    {
        $response = $this->response ?: Yii::$app->getResponse();

        try {
            $identity = $this->authenticate(
                $this->user ?: Yii::$app->getUser(),
                $this->request ?: Yii::$app->getRequest(),
                $response
            );
        } catch (UnauthorizedHttpException $e) {
            if ($this->isOptional($action)) {
                return true;
            }

            throw $e;
        }

        if ($identity !== null || $this->isOptional($action)) {
            return true;
        }

        $this->challenge($response);
        $this->handleFailure($response);

        return false;
    }

    /**
     * ---------------------------------------
     * 验证当前用户
     *
     * @param User $user
     * @param Request $request
     * @param Response $response
     * @return null|\yii\web\IdentityInterface
     * @throws UnauthorizedHttpException
     * @author hlf <phphome@qq.com> 2020/5/21
     * ---------------------------------------
     */
    public function authenticate($user, $request, $response)
    {
        // 当 $identity = null 时表示无法获取的认证信息或者认证失败
        // $identity = null 时为游客
        // $identity = parent::authenticate($user, $request, $response);
        $authHeader = $request->getHeaders()->get($this->header);

        if ($authHeader !== null) {
            if ($this->pattern !== null) {
                if (preg_match($this->pattern, $authHeader, $matches)) {
                    $authHeader = $matches[1];
                } else {
                    return null;
                }
            }

            $identity = $user->loginByAccessToken($authHeader, get_class($this));
            if ($identity === null) {
                $this->challenge($response);
                $this->handleFailure($response);
            }

            return $identity;
        }

        return null;

    }

    /**
     * ---------------------------------------
     * 身份认证失败时
     * 例如，可以生成一些适当的HTTP头。
     *
     * @param Response $response
     * @author hlf <phphome@qq.com> 2020/5/21
     * ---------------------------------------
     */
    public function challenge($response)
    {
        $response->getHeaders()->set('WWW-Authenticate', "Bearer realm=\"{$this->realm}\"");

    }

    /**
     * ---------------------------------------
     * 处理身份认证失败
     * 通常应该抛出UnauthorizedHttpException以指示身份验证失败。
     *
     * @param Response $response
     * @throws UnauthorizedHttpException
     * @author hlf <phphome@qq.com> 2020/5/21
     * ---------------------------------------
     */
    public function handleFailure($response)
    {
        throw new UnauthorizedHttpException(Yii::t('api', 'Token权限认证失败'));
    }
}
