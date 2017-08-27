<?php
namespace common\widgets\images;

use common\modelsgii\Picture;
use Yii;
use yii\base\Action;
use common\helpers\FuncHelper;

/**
 * 上传图片控制器
 */
class UploadAction extends Action
{
    /**
     * ---------------------------------------
     * 上传base64格式的图片
     * @return void
     * ---------------------------------------
     */
    public function run(){
        $json = [
            'boo'  => false,
            'msg'  => '上传失败',
            'data' => [
                'id' => 0,
                'url' => '',
            ]
        ];
        $imgbase64 = Yii::$app->request->post('imgbase64');
        $saveDB = Yii::$app->request->post('saveDB',0);
        if (empty($imgbase64)) {
            $this->ajaxReturn($json);
        }
        $url = FuncHelper::uploadImage($imgbase64);
        if ($url) {
            $json['data']['url'] = $url;
            /* 保存图片到picture表 */
            if ($saveDB) {
                $pic = $this->savePic($url);
                if (!$pic) {
                    $this->ajaxReturn($json);
                }
                $json['data']['id']  = $pic['id'];
                $json['data']['url'] = $pic['path'];
            }
            $json['boo']  = true;
            $json['msg']  = '上传成功';
        }
        $this->ajaxReturn($json);
    }

    /**
     * ----------------------------------
     * 保存一张图片到数据库
     * @param $url string 图片路径
     * @return array|boolean
     * ----------------------------------
     */
    public function savePic($url){
        $file_path = Yii::$app->params['upload']['path'].$url;
        $file_md5  = md5_file($file_path);
        $image = Picture::find()->where(['md5'=>$file_md5])->asArray()->one();
        if ($image) {
            unlink($file_path); // 图片已存在，删除该图片
            return $image;
        }
        $model = new Picture();
        $data['path'] = $url;
        $data['md5']  = $file_md5;
        $data['create_time'] = time();
        $data['status'] = 1;
        $model->setAttributes($data);
        if ($model->save()) {
            return $model->getAttributes();
        }
        return false;
    }
    
    public function ajaxReturn($data) {
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data));
    }

}
