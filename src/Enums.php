<?php
/**
 * 业务枚举类
 * User: 苏近之
 * Date: 2018/10/22
 * Time: 10:49
 */

namespace JinZhiSu\ALiDaYuSms;

class Enums
{
    const FORMAT_JSON = 'JSON';
    const FORMAT_XML = 'XML';
    const SIGNATURE_METHOD = 'HMAC-SHA1';
    const SIGNATURE_VERSION = '1.0';
    const ACTION = 'SendSms';
    const SMS_VERSION = '2017-05-25';
    const SMS_REGION_ID = 'cn-hangzhou';
    const REQUEST_METHOD = 'GET';
    const REQUEST_HOST = 'http://dysmsapi.aliyuncs.com/';
    const DATETIME_FORMAT = 'Y-m-d\TH:i:s\Z';
}