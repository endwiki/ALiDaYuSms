<?php
/**
 * 请求参数类
 * User: 苏近之
 * Date: 2018/10/22
 * Time: 10:39
 */

namespace JinZhiSu\ALiDaYuSms;

/**
 * Class RequestParams
 * @package org\ali_sms
 * @description 用于封装请求参数
 */
class RequestParams
{
    protected $params = [];
    protected $phoneNumbers = '';       // 手机号
    protected $signName = '';           // 短信签名
    protected $templateCode = '';       // 短信模板ID
    protected $templateParam = '';       // 短信参数
    protected $outId = '';              // 外部流水ID
    protected $authObj;
    protected $requestUrl;

    public function __construct(Auth $authObj)
    {
        $this->authObj = $authObj;
    }

    protected function config()
    {
        // 系统参数
        $this->params['AccessKeyId'] = $this->authObj->getAk();
        $this->params['SignatureNonce'] = $this->getSignatureNonce();
        date_default_timezone_set('GMT');
        $this->params['Timestamp'] = date(Enums::DATETIME_FORMAT);
        $this->params['Format'] = Enums::FORMAT_JSON;
        $this->params['SignatureMethod'] = Enums::SIGNATURE_METHOD;
        $this->params['SignatureVersion'] = Enums::SIGNATURE_VERSION;
        // 业务参数
        $this->params['Action'] = Enums::ACTION;
        $this->params['Version'] = Enums::SMS_VERSION;
        $this->params['RegionId'] = Enums::SMS_REGION_ID;
        $this->params['PhoneNumbers'] = $this->getPhoneNumbers();
        $this->params['SignName'] = $this->getSignName();
        $this->params['TemplateCode'] = $this->getTemplateCode();
        $this->params['TemplateParam'] = $this->getTemplateParam();
        $this->params['OutId'] = $this->getOutId();
    }

    /**
     * 获取手机
     * @return string
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * 获取短信签名
     * @return string
     */
    public function getSignName()
    {
        return $this->signName;
    }

    /**
     * 设置短信发送的手机号
     * @description 如果是群发，手机号传数组结构，最多支持1000个号码
     * @param string|array $phoneNumbers
     * @return RequestParams
     */
    public function setPhoneNumbers($phoneNumbers)
    {
        if (is_array($phoneNumbers)) {
            $this->phoneNumbers = explode(',', $phoneNumbers);
        } else {
            $this->phoneNumbers = $phoneNumbers;
        }
        return $this;
    }

    /**
     * 设置短信签名
     * @param $signName
     * @return RequestParams
     */
    public function setSignName($signName)
    {
        $this->signName = $signName;

        return $this;
    }

    /**
     * 用户请求的防重放攻击，每次请求唯一
     */
    protected function getSignatureNonce()
    {
        return uniqid(mt_rand(0, 0xffff), true);
    }

    /**
     * 设置模板ID
     * @param string $templateCode
     * @return $this
     */
    public function setTemplateCode($templateCode)
    {
        $this->templateCode = $templateCode;

        return $this;
    }

    /**
     * 设置模板参数
     * @param $templateParam
     * @return $this
     */
    public function setTemplateParam($templateParam)
    {
        $this->templateParam = json_encode($templateParam);

        return $this;
    }

    /**
     * 设置外部流水ID
     * @param string $outId
     * @return $this
     */
    public function setOutId($outId = '')
    {
        $this->outId = $outId;

        return $this;
    }

    /**
     * 获取外部流水ID
     * @return string
     */
    public function getOutId()
    {
        return $this->outId;
    }

    /**
     * 获取模板代码
     * @return string
     */
    public function getTemplateCode()
    {
        return $this->templateCode;
    }


    /**
     * 获取模板参数
     * @return string
     */
    public function getTemplateParam()
    {
        return $this->templateParam;
    }

    /**
     * 获取签名
     * @return string
     */
    public function getSign()
    {
        $this->config();
        // 根据参数的 key 排序
        ksort($this->params);
        $this->requestUrl = $this->getRequestUrl();
        $result = $this->setSign(Enums::REQUEST_METHOD . '&%2F&' . $this->specialUrlEncode($this->requestUrl));

        return $result;
    }

    /**
     * 获取请求 URL
     * @return mixed
     */
    public function getFinalRequestUrl()
    {
        return $this->requestUrl;
    }

    /**
     * 获取请求 URL
     * @return bool|string
     */
    protected function getRequestUrl()
    {
        $url = '';
        foreach ($this->params as $key => $param) {
            $url .= $this->specialUrlEncode($key) . '=' . $this->specialUrlEncode($param) . '&';
        }

        return substr($url, 0, -1);
    }

    /**
     * POP 算法特殊的规则，替换部分字符
     * @param $requestUrl
     * @return null|string|string
     */
    protected function specialUrlEncode($requestUrl)
    {
        $requestUrl = urlencode($requestUrl);
        $requestUrl = preg_replace('/\+/', '%20', $requestUrl);
        $requestUrl = preg_replace('/\*/', '%2A', $requestUrl);
        $requestUrl = preg_replace('/%7E/', '~', $requestUrl);

        return $requestUrl;
    }

    /**
     * 签名加密
     * @param $requestUrl
     * @return string
     */
    protected function setSign($requestUrl)
    {
        $result = base64_encode(hash_hmac('sha1', $requestUrl, $this->authObj->getSk() . '&', true));

        return $result;
    }
}