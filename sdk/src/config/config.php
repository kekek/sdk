<?php
// +----------------------------------------------------------------------
// |	@desc       Class sdk.php
// +----------------------------------------------------------------------
// |	@author     jinyifeng
// +----------------------------------------------------------------------
// |	@package    ktkt
// +----------------------------------------------------------------------
// |	@version    $Id:sdk.php v1.0 16/4/27 下午3:04 $
// +----------------------------------------------------------------------

return array(

    "key" => "api",            //app secret
    "secret" => "e96d3ea8c38b96a4b39f1a28bf692b9f",      //app key
    "duration" => "30 days",        //jwt key 过期时间
    "origin" => "ktkt",

    //api 主机配置
    "account" => array(
        "server" => "http://localhost:1334",
    ),

    "sender" => array(
        "server" => "http://wps.ktkt.com:8006",
    ),

    "login" => array(
        "server" => "http://localhost:1340"
    )
);