<?php

namespace common\glide;

use Yii;
use yii\web\NotFoundHttpException;
use yii\base\NotSupportedException;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class GlideAction extends \trntv\glide\actions\GlideAction
{

    /**
     * ------------------------------------------
     * @param $path
     * @throws NotFoundHttpException
     * @throws NotSupportedException
     * ------------------------------------------
     */
    public function run($path)
    {
        $param = Yii::$app->request->get();
        if (Yii::$app->params['storage_encrypt'] && isset($param['path'])) {
            $param = base64_decode($param['path']);
            $param = \GuzzleHttp\Psr7\parse_query($param);
        }//var_dump($param);exit;

        if (isset($param['path'])) {
            if (!$this->getServer()->sourceFileExists($param['path'])) {
                throw new NotFoundHttpException;
            }
            try {
                $this->getServer()->outputImage($param['path'], $param);
            } catch (\Exception $e) {
                throw new NotSupportedException($e->getMessage());
            }
        } else {
            echo 'no image';
        }
    }

}
