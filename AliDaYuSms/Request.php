<?php
/**
 * 请求类
 * User: 苏近之
 * Date: 2018/10/22
 * Time: 12:33
 */

namespace JinZhiSu\ALiDaYuSms;

class Request
{

    public function send($requestUrl, $sign)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_URL, Enums::REQUEST_HOST . '?' . $requestUrl . '&Signature=' . $sign);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);

        curl_close($ch);
        return $ret;
    }
}