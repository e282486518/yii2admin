<?php

namespace common\helpers;

use Yii;

/**
 * 自定义辅助函数，处理其他杂项
 */
class FuncHelper
{
    /**
     * ---------------------------------------
     * ajax标准返回格式
     * @param $code integer  错误码
     * @param $msg string  提示信息
     * @param $obj mixed  返回数据
     * @return void
     * ---------------------------------------
     */
    public static function ajaxReturn($code = 0, $msg = 'success', $obj = ''){
        /* api标准返回格式 */
        $json = array(
            'code' => $code,
            'msg'  => $msg,
            'obj'  => $obj,
        );
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($json));
    }
    
    /**
     * ---------------------------------------
     * 分析枚举类型字段值 格式 a:名称1,b:名称2
     * @param $string string  字符串
     * @return mixed
     * ---------------------------------------
     */
    public static function parse_field_attr($string) {
        if(0 === strpos($string,':')){
            // 采用函数定义
            return eval(substr($string,1).';');
        }
        $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
        if(strpos($string,':')){
            $value  =   array();
            foreach ($array as $val) {
                list($k, $v) = explode(':', $val);
                $value[$k]   = $v;
            }
        }else{
            $value  =   $array;
        }
        return $value;
    }

    /**
     * ---------------------------------------
     * 读出数据库后，经常将状态等数字转化为字符串
     * @param mixed $data  参数信息
     * @param array $map 要转化的数组信息
     * @return string
     * ---------------------------------------
     */
    public static function int_to_string($data, $map=array(1=>'正常',-1=>'删除',0=>'禁用',2=>'未审核',3=>'草稿')) {
        if($data === false || $data === null ){
            return $data;
        }
        $data = (array)$data;
        if(isset($map[$data])){
            return $map[$data];
        }
        return '';
    }
    
    /**
     * ---------------------------------------
     * 上传base64格式的图片
     * @param string $imgbase64 图片的base64编码
     * @return mixed
     * ---------------------------------------
     */
    public static function uploadImage($imgbase64){
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $imgbase64, $result)){
            $type = $result[2];
            $type = $type == 'jpeg' ? 'jpg' : $type;
            $fileName = time() . rand( 1 , 1000 ) . ".".$type;
            /* 以年月创建目录 */
            $dir = date('Ym', time());
            if (!file_exists(Yii::$app->params['upload']['path'].$dir)) {
                mkdir(Yii::$app->params['upload']['path'].$dir, 0777);
            }
            $fileName = $dir.'/'.$fileName;
            if (file_put_contents(Yii::$app->params['upload']['path'].$fileName, base64_decode(str_replace($result[1], '', $imgbase64)))){
                return $fileName;
            }
        }
        return false;
    }

    /**
     * ---------------------------------------
     * 发送短信验证码
     * @param string $mobile 手机号码
     * @param string $content 内容
     * @return bool
     * ---------------------------------------
     */
    public static function sendSMS($mobile, $content = '' ){

        if (empty($mobile) && !preg_match('/^1[34578]\d{9}$/', $mobile)) {
            return false;
        }
        
        $encode='UTF-8';  //页面编码和短信内容编码为GBK。重要说明：如提交短信后收到乱码，请将GBK改为UTF-8测试。如本程序页面为编码格式为：ASCII/GB2312/GBK则该处为GBK。如本页面编码为UTF-8或需要支持繁体，阿拉伯文等Unicode，请将此处写为：UTF-8
        $username='13316922246';  //用户名
        $password_md5=md5('123456');//'1ADBB3178591FD5BB0C248518F39BF6D';  //32位MD5密码加密，不区分大小写
        $apikey='591da0c50baf40d7317feed7d118a1c8';  //apikey秘钥（请登录 http://m.5c.com.cn 短信平台-->账号管理-->我的信息 中复制apikey）
        //$mobile='18610310068';  //手机号,只发一个号码：13800000001。发多个号码：13800000001,13800000002,...N 。使用半角逗号分隔。
        $content=$content?$content:'您好，您的验证码是：12345【美联】';  //要发送的短信内容，特别注意：签名必须设置，网页验证码应用需要加添加【图形识别码】。
        //$content = iconv("GBK","UTF-8",$content);
        $contentUrlEncode = urlencode($content);//执行URLencode编码  ，$content = urldecode($content);解码

        //发送链接（用户名，密码，apikey，手机号，内容）
        $url = "http://m.5c.com.cn/api/send/index.php?";  //如连接超时，可能是您服务器不支持域名解析，请将下面连接中的：【m.5c.com.cn】修改为IP：【115.28.23.78】
        $data=array(
            'username'=>$username,
            'password_md5'=>$password_md5,
            'apikey'=>$apikey,
            'mobile'=>$mobile,
            'content'=>$contentUrlEncode,
            'encode'=>$encode,
        );
        $result = static::curlSMS($url,$data);//echo $result;

        if(strpos($result,"success")>-1) {
            //提交成功
            //逻辑代码
            return true;
        } else {
            //提交失败
            //逻辑代码
            return false;
        }
        //echo $result;  //输出result内容，查看返回值，成功为success，错误为error，（错误内容在上面有显示）
    }

    /**
     *---------------------------------------
     * post curl
     * @param string $url
     * @param array $post_fields
     * @return mixed
     *---------------------------------------
     */
    public static function curlSMS($url,$post_fields=array())
    {
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);//用PHP取回的URL地址（值将被作为字符串）
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//使用curl_setopt获取页面内容或提交数据，有时候希望返回的内容作为变量存储，而不是直接输出，这时候希望返回的内容作为变量
        curl_setopt($ch,CURLOPT_TIMEOUT,30);//30秒超时限制
        curl_setopt($ch,CURLOPT_HEADER,1);//将文件头输出直接可见。
        curl_setopt($ch,CURLOPT_POST,1);//设置这个选项为一个零非值，这个post是普通的application/x-www-from-urlencoded类型，多数被HTTP表调用。
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);//post操作的所有数据的字符串。
        $data = curl_exec($ch);//抓取URL并把他传递给浏览器
        curl_close($ch);//释放资源
        $res = explode("\r\n\r\n",$data);//explode把他打散成为数组
        return $res[2]; //然后在这里返回数组。
    }

    /**
     *---------------------------------------
     * 导出数据为excel表格
     * @param array $data 一个二维数组,结构如同从数据库查出来的数组
     * @param array $title excel的第一行标题,一个数组,如果为空则没有标题
     * @param string $filename 文件名
     *---------------------------------------
     */
    public static function exportexcel($data=array(),$title=array(),$filename='report'){
        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=".$filename.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        //导出xls 开始
        if (!empty($title)){
            foreach ($title as $k => $v) {
                $title[$k]=iconv("UTF-8", "GB2312",$v);
            }
            $title= implode("\t", $title);
            echo "$title\n";
        }
        if (!empty($data)){
            foreach($data as $key=>$val){
                foreach ($val as $ck => $cv) {
                    $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
                }
                $data[$key]=implode("\t", $data[$key]);

            }
            echo implode("\n",$data);
        }
    }
    
}
