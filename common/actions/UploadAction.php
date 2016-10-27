<?php
namespace common\actions;

use backend\models\Picture;
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
            'data' => ''
        ];
        $imgbase64 = Yii::$app->request->post('imgbase64');
        $saveDB = Yii::$app->request->post('saveDB',0);
        if (empty($imgbase64)) {
            $this->ajaxReturn($json);
        }
        $url = FuncHelper::uploadImage($imgbase64);
        if ($url) {
            $data = [
                'id' => 0,
                'url' => $url,
            ];
            /* 保存图片到picture表 */
            if ($saveDB) {
                $pic = Picture::savePic($url);
                if (!$pic) {
                    $this->ajaxReturn($json);
                }
                $data['id'] = $pic['id'];
            }
            $json['boo']  = true;
            $json['msg']  = '上传成功';
            $json['data'] = $data;
        }
        $this->ajaxReturn($json);
    }
    
    public function ajaxReturn($data) {
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data));
    }

}
