<?php
// +----------------------------------------------------------------------
// |	@desc       Class sdk.php
// +----------------------------------------------------------------------
// |	@author     jinyifeng
// +----------------------------------------------------------------------
// |	@package    ktkt
// +----------------------------------------------------------------------
// |	@version    $Id:sdk.php v1.0 16/4/27 下午3:08 $
// +----------------------------------------------------------------------


namespace Kekek\Sdk;

use Config;

class Sdk {
    protected static $config;

    protected static $sdk = null;

    public static function instance(){
        if(!self::$config){
            self::$config = Config::get("sdk::config");
        }

        if (!self::$sdk) {
            $instance = new self();
            self::$sdk = $instance;
        }

        return self::$sdk;
    }

    public static function Test(){
        echo "hello world! vendor ";

        echo 'key : ';
        var_dump(Config::get("sdk::config.key"));
    }

    //用户登陆
    public static function AccountSignin($account, $password,$origin="") {
        $params = array(
            "account" => $account,
            "passwd" => $password,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/signin",self::$config["account"]["server"]);

//        $http = new \Kekek\Sdk\HttpLib(self::$appKey,self::$appSecret,self::$duration);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

    //admin user info by account
    public static function AdminUserInfoByAccount($account, $password) {
        $params = array(
            "account" => $account,
            "passwd" => $password
        );

        $url = sprintf("%s/admin/info/account", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//admin create user
    public static function AdminUserCreateFromOauth() {
        $params = array();

        $url = sprintf("%s/admin/create/oauth", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//admin 更新用户token
    public static function AdminUserTokenUpdate($id,$origin="") {
        $params = array(
            "id" => $id,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/admin/token/update", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//api token get user info
    public static function InfoByToken($token,$origin="") {
        $params = array(
            "token" => $token,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/info", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//admin uid by token
    public static function AdminUidByToken($token,$origin="") {
        $params = array(
            "token" => $token,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/admin/token/uid", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//admin uid by token
    public static function AdminInfoById($id) {
        $params = array(
            "id" => $id
        );

        $url = sprintf("%s/admin/info/id", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

    // 更新token,登陆
    public static function AdminUpdateToken($id,$origin=""){

        $params = array(
            "id" => $id,
            "origin" =>empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/admin/token/update", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

    //第三方自动创建用户
    public static function AdminCreateOauthUser($nickname,$avatar){
        $params = array(
            "nickname" => $nickname,
            "avatar" =>$avatar
        );

        $url = sprintf("%s/admin/create/oauth", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//发送用户注册验证码 email or phone
    public static function UserRegisterCode($account){
        $params = array(
            "account" => $account
        );

        $url = sprintf("%s/account/signup/code", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//忘记密码验证码
    public static function PwdSendCode($account){
        $params = array(
            "account" => $account
        );

        $url = sprintf("%s/account/resetpwd/code", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//忘记密码验证码
    public static function ResetPwd($account,$pass,$code,$origin=""){
        $params = array(
            "account" => $account,
            "passwd" => $pass,
            "code" =>$code,
            "origin" =>empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/resetpwd", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//用户注册
    public static function SignUp($account,$pwd,$code,$origin=""){
        $params = array(
            "account" => $account,
            "passwd" => $pwd,
            "code" => $code,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/signup", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

    //登录后修改密码
    public static function ChangePwd($token,$newPwd,$origin=""){
        $params = array(
            "token" => $token,
            "newpwd" => $newPwd,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/changepwd", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

    //修改用户昵称
    public static function updateNickName($token,$nickName,$origin=""){
        $params = array(
            "token" => $token,
            "nickname" => $nickName,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/change/nickname", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

    //图片验证码
    public static function ImageCaptcha(){
        $params = array();

        $url = sprintf("%s/account/captcha", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

    //忘记密码＋图片验证码
    public static function PwdSendCodeWithCaptcha($account,$key,$code){
        $params = array(
            "account" => $account,
            "captcha_key" => $key,
            "captcha_code" => $code
        );

        $url = sprintf("%s/account/resetpwd/code/captcha", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//注册密码验证码
    public static function UserRegisterCodeWithCaptcha($account,$key,$code){
        $params = array(
            "account" => $account,
            'captcha_key' => $key,
            'captcha_code' => $code
        );

        $url = sprintf("%s/account/signup/code/captcha", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//    ===绑定帐号====

//    验证码
    public static function getBindCode($token,$account,$origin=""){
        $params = array(
            "account" => $account,
            'token' => $token,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/bind/code", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//    绑定
    public static function doBind($token,$account,$code,$origin=""){
        $params = array(
            "account" => $account,
            'token' => $token,
            'code' => $code,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/bind/update", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//    解绑帐号
    public static function unbind($token,$account,$origin=""){
        $params = array(
            "account" => $account,
            'token' => $token,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/unbind", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }


    /**
     * 解绑qq或者微博时
     * 检查账号中，email、phone至少存在一项，密码存在
     *
     * @param $uid
     * @return bool
     */
    public static function checkAccount($token,$origin=""){
        $params = array(
            'token' => $token,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/unbind/check", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

    //get instance of httpLib
    public static function HttpLib(){
        return  new \Kekek\Sdk\HttpLib(self::$config["key"],self::$config["secret"],self::$config["duration"]);
    }
}