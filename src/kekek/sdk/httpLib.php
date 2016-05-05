<?php
// +----------------------------------------------------------------------
// |	@desc       Class Func.php
// +----------------------------------------------------------------------
// |	@author     jinyifeng
// +----------------------------------------------------------------------
// |	@package    ktkt
// +----------------------------------------------------------------------
// |	@version    $Id:Func.php v1.0 16/4/27 下午3:46 $
// +----------------------------------------------------------------------

namespace Kekek\Sdk;

use Emarref;

class HttpLib {

    public static $appKey = "";
    public static $appSecret = "";
    public static $duration = "30 days";  //3600 * 24 * 30


    public function __construct($key,$secret,$duration){
        self::$appKey = $key;
        self::$appSecret = $secret;
        self::$duration = $duration;
    }

    public static function post($url, $params) {
        $params["ip"] = \Request::ip();

        $header = [
            "Authorization:Bearer " . self::authorization(),
            "client-id:".self::$appKey
        ];

        $opts = array(
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query($params)
        );

        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
//            Log::error(sprintf("jwt post error : %s | url : %s", $error, $url));
            return $data;
        }
        return json_decode($data,true);

    }

    public static function get($url, $params) {
        $params["ip"] = \Request::ip();

        $header = [
            "Authorization:Bearer " .self::authorization(),
            "client-id:".self::$appKey
        ];

        $opts = array(
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_URL => $url . '&' . http_build_query($params),
        );

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error) {
//            Log::error(sprintf("jwt get error : %s | url : %s", $error, $url));
            return $data;
        }
        return json_decode($data,true);
    }

    protected static function authorization() {

        $token = new Emarref\Jwt\Token();

        $parameter = new Emarref\Jwt\HeaderParameter\Custom('typ', 'JWT');
        $token->addHeader($parameter, true);

        $token->addClaim(new Emarref\Jwt\Claim\Expiration(new \DateTime(self::$duration)));

        $jwt = new Emarref\Jwt\Jwt();

        $algorithm = new Emarref\Jwt\Algorithm\Hs256(self::$appSecret);
        $encryption = Emarref\Jwt\Encryption\Factory::create($algorithm);
        $serializedToken = $jwt->serialize($token, $encryption);

        return $serializedToken;
    }
}