<?php

namespace backend\models;

use Yii;

/**
 * 图片处理模型
 *
 */
class Picture extends \common\modelsgii\Picture
{
    /**
     * ----------------------------------
     * 保存一张图片到数据库
     * @param $url string 图片路径
     * @return array|boolean
     * ----------------------------------
     */
    public static function savePic($url){
        $file_path = Yii::$app->params['upload']['path'].$url;
        $file_md5  = md5_file($file_path);
        $image = static::find()->where(['md5'=>$file_md5])->asArray()->one();
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

    /**
     * ---------------------------------------
     * 获取一张图片信息
     * @param $id int 图片ID
     * @return array
     * ---------------------------------------
     */
    public static function getPic($id){
        return static::find()->where(['id'=>$id])->asArray()->one();
    }

    /**
     * ---------------------------------------
     * 清除不在picture表中的图片
     * @param $sPath string 图片所在路径
     * ---------------------------------------
     */
    public static function clearPic($sPath){
        if(is_dir($sPath)){
            $fp = opendir($sPath);
            while(!false == ($fn = readdir($fp))){
                if($fn == '.' || $fn =='..') continue;
                if(strpos($fn, 'editor') === 0) continue; //编辑器上传的图片被忽略
                $sFilePath = $sPath.DIRECTORY_SEPARATOR.$fn;
                self::clearPic($sFilePath);
            }
        } else {
            //. ..文件直接跳过，不处理
            if($sPath != '.' && $sPath != '..'){
                $file_md5  = md5_file($sPath);
                $picModel = static::find()->where(['md5'=>$file_md5])->asArray()->one();
                /* md5和文件名都正确才不删除 */
                if (!$picModel || strpos($sPath, $picModel['path']) === false) {
                    if(@unlink($sPath) === true){
                        echo date("Y-m-d H:i:s").'成功删除文件'.$sPath.PHP_EOL;
                    } else {
                        echo date("Y-m-d H:i:s").'删除失败========ERROR========='.$sPath.PHP_EOL;
                    }
                } else {
                    echo '文件存在，id='.$picModel['id'].' '.PHP_EOL;
                }
            }
        }
    }

    /**
     * ---------------------------------------
     * 清除picture表中不存在的图片
     * ---------------------------------------
     */
    public static function clearPic1(){
        $query = static::find()->orderBy('id ASC');
        foreach ($query->each() as $value) {//var_dump($value->path);
            $file_path = Yii::$app->params['upload']['path'].$value->path;
            if (!is_file($file_path)) {
                echo '文件在磁盘中不存在，已删除 id='.$value->id.PHP_EOL;
                $value->delete();
                continue;
            }
            $file_md5  = md5_file($file_path);
            if ($file_md5 == $value['md5']) {
                continue;
            } else {
                echo '文件被修改，注意是否含木马 '.$file_path.PHP_EOL;
            }
        }
    }

}
