<?php
namespace common\actions;

use Yii;

class UEditorAction extends \kucha\ueditor\UEditorAction
{
    /**
     * 处理action
     */
    protected function handleAction()
    {
        $action = Yii::$app->request->get('action');
        switch ($action) {
            case 'config':
                $result = $this->config;
                break;

            /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                $result = $this->actionUpload();
                //处理返回的URL
                if (substr($result['url'], 0, 1) != '/') {
                    $result['url'] = '/' . $result['url'];
                }
                //$result['url'] = Yii::getAlias('@web'.$result['url']);
                break;
            /* 列出图片 */
            case 'listimage':
                /* 列出文件 */
            case 'listfile':
                $result = $this->actionList();
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                $result = $this->actionCrawler();
                break;

            default:
                $result = [
                    'state' => '请求地址出错'
                ];
                break;
        }
        /* 输出结果 */
        //var_dump($result);
        return $result;

    }

}