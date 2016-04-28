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
    function AdminUserCreateFromOauth() {
        $params = array();

        $url = sprintf("%s/admin/create/oauth", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//admin 更新用户token
    function AdminUserTokenUpdate($id,$origin="") {
        $params = array(
            "id" => $id,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/admin/token/update", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//api token get user info
    function InfoByToken($token,$origin="") {
        $params = array(
            "token" => $token,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/account/info", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//admin uid by token
    function AdminUidByToken($token,$origin="") {
        $params = array(
            "token" => $token,
            "origin" => empty($origin) ? self::$config["origin"] : $origin
        );

        $url = sprintf("%s/admin/token/uid", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//admin uid by token
    function AdminInfoById($id) {
        $params = array(
            "id" => $id
        );

        $url = sprintf("%s/admin/info/id", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//发送用户注册验证码 email or phone
    function UserRegisterCode($account){
        $params = array(
            "account" => $account
        );

        $url = sprintf("%s/account/signup/code", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//忘记密码验证码
    function PwdSendCode($account){
        $params = array(
            "account" => $account
        );

        $url = sprintf("%s/account/resetpwd/code", self::$config["account"]["server"]);

        $r = self::HttpLib()->post($url, $params);

        return $r;
    }

//忘记密码验证码
    function ResetPwd($account,$pass,$code,$origin=""){
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
    function SignUp($account,$pwd,$code,$origin=""){
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

    //get instance of httpLib
    public static function HttpLib(){
        return  new \Kekek\Sdk\HttpLib(self::$config["key"],self::$config["secret"],self::$config["duration"]);
    }
}