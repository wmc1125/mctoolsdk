<?php
namespace Wmc1125\Mctoolsdk;  

class System
{
    public function __construct(){
      //使用记录
      // $_temp_zftool = session('')
    }
    public function index(){
        return 1;
    }
     
    /*
     * 获取信息
     */
    static public function get_info(){
//获取系统类型及版本号：    php_uname()           (例：Windows NT COMPUTER 5.1 build 2600)
//只获取系统类型：          php_uname('s')        (或：PHP_OS，例：Windows NT)
//只获取系统版本号：        php_uname('r')        (例：5.1)
//获取PHP运行方式：         php_sapi_name()       (PHP run mode：apache2handler)
//获取前进程用户名：        Get_Current_User()
//获取PHP版本：             PHP_VERSION
//获取Zend版本：            Zend_Version()
//获取PHP安装路径：         DEFAULT_INCLUDE_PATH
//获取当前文件绝对路径：    __FILE__
//获取Http请求中Host值：    $_SERVER["HTTP_HOST"]                  (返回值为域名或IP)
//获取服务器IP：            GetHostByName($_SERVER['SERVER_NAME'])
//接受请求的服务器IP：      $_SERVER["SERVER_ADDR"]                (有时候获取不到，推荐用：GetHostByName($_SERVER['SERVER_NAME']))
//获取客户端IP：            $_SERVER['REMOTE_ADDR']
//获取服务器解译引擎：      $_SERVER['SERVER_SOFTWARE']
//获取服务器CPU数量：       $_SERVER['PROCESSOR_IDENTIFIER']
//获取服务器系统目录：      $_SERVER['SystemRoot']
//获取服务器域名：          $_SERVER['SERVER_NAME']                 (建议使用：$_SERVER["HTTP_HOST"])
//获取用户域名：            $_SERVER['USERDOMAIN']
//获取服务器语言：          $_SERVER['HTTP_ACCEPT_LANGUAGE']
//获取服务器Web端口：       $_SERVER['SERVER_PORT']
      $data['php_uname'] = php_uname();
      $data['php_uname_r'] = php_uname('s');
      $data['php_uname_r'] = php_uname('r') ;
      $data['php_sapi_name'] = php_sapi_name();
      $data['Get_Current_User'] = Get_Current_User();
      // $data['PHP_VERSION'] = PHP_VERSION();
      $data['Zend_Version'] = Zend_Version();
      // $data['DEFAULT_INCLUDE_PATH'] =DEFAULT_INCLUDE_PATH() ;
      $data['__file__'] = __FILE__;
      $data['HTTP_HOST'] =  $_SERVER["HTTP_HOST"];
      $data['GetHostByName'] =GetHostByName($_SERVER['SERVER_NAME']) ;//接受请求的服务器IP：
      $data['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];//获取客户端IP
      $data['SERVER_SOFTWARE'] = $_SERVER['SERVER_SOFTWARE'];
    //   $data['SystemRoot'] =  $_SERVER['SystemRoot'];
      $data['HTTP_ACCEPT_LANGUAGE'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
      $data['SERVER_PORT'] = $_SERVER['SERVER_PORT'];
      return $data;
    }

    /**
     * [check_data 检查数据]
     * @Author   子枫
     * @Email    287851074@qq.com
     * @DateTime 2019-10-24T13:39:38+0800
     * @version  v1.0
     * @param    string                   $t         [类型]
     * @param    integer                  $parm      [字段]
     * @param    string                   $error_msg [错误返回提示语句]
     * @return   [type]                              [返回结果]
     */
    static public function check_data($t='',$parm=0,$error_msg=''){
        switch ($t) {
            case 'tel':
                return check_mobile_phone($parm,$error_msg);
                break;
            case 'email':
                return check_email($parm,$error_msg);
                break;
            case 'emptyy':
                if(!isset($parm) || $parm==''){
                    return jserror($error_msg);
                }
                break;
            
            default:
                return '格式错误,或不支持';
                break;
        }
    }
    /**
     * [get_domain_urlr 拼接网址]
     * @Author   子枫
     * @Email    287851074@qq.com
     * @DateTime 2019-10-24T13:38:53+0800
     * @version  v1.0
     * @param    string                   $domain [域名]
     * @param    string                   $url    [链接]
     * @return   [type]                           [str]
     */
    static public function get_domain_urlr($domain='',$url=''){
        //判断url地址是否完整,不完整进行拼接
          $isurl=@get_headers($url);
          if(!$isurl){
              if($url[0].$url[1]=='//'){
                  return $url; // 合法
              }else{
                  if($url[0]=='/'){
                      return $domain.$url;
                  }else{
                      return $domain.'/'.$url;
                  }
              }
          }else{
              return $url;
          }

    }

    /**
     * [zf_auth_pwd 加密/解密]
     * @Author   子枫
     * @Email    287851074@qq.com
     * @DateTime 2019-10-24T13:32:40+0800
     * @version  v1.0
     * @param    string                   $string    [字符串/加密字符]
     * @param    string                   $operation [D/E]
     * @param    string                   $key       [秘钥]
     * @param    integer                  $expiry    [过期时间]
     * @return   [type]                              [str]
     */
    static public function zf_auth_pwd($string='zf', $operation='', $key='123456', $expiry=0){
        return zf_auth_pwd($string, $operation, $key, $expiry);
    }
    
    /**
     * [send_email 发送邮件]
     * @Author   子枫
     * @Email    287851074@qq.com
     * @DateTime 2019-10-24T13:34:07+0800
     * @version  v1.0
     * @param    [type]                   $data [data]
     * @param    [type]                   $key  [description]
     * @return   [type]                         [description]
     */
    static public function send_email($data,$key){
      $ret = ['data'=>json_encode($data),'key'=>$key,'pid'=>4];
      $url = 'http://mctool.wangmingchang.com/api/tool/email';
      $ret = https_post($url,$ret);
      return $ret;
    }

// 字符串是否存在于二维数组的某个字段
    static public function str_in_two_array($value, $array){
      return deep_in_array($value, $array);
    }
   
   //生成随机数 
   //长度 包含数字  后部添加时间
    static public function zf_rand_str($randLength = 6,  $includenumber = 0){
        $time = zf_rand_str($randLength  , $includenumber);
        return $time;
    }

    



}


