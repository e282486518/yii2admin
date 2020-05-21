<?php

namespace common\core;

use Yii;
use yii\base\UserException;
use yii\web\HttpException;

class ErrorHandler extends \yii\web\ErrorHandler
{

    /**
     * Converts an exception into an array.
     * @param \Exception|\Error $exception the exception being converted
     * @return array the array representation of the exception.
     */
    protected function convertExceptionToArray($exception)
    {
        if (!YII_DEBUG && !$exception instanceof UserException && !$exception instanceof HttpException) {
            $exception = new HttpException(500, Yii::t('yii', 'An internal server error occurred.'));
        }

        $array = [
            'msg' => $exception->getMessage(),
            'err' => $exception->getCode(),
            'obj' => [],
        ];
        if ($exception instanceof HttpException) {
            $array['httpcode'] = $exception->statusCode;
        }

        return $array;
    }

}
