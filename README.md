# 阿里大于短信 SDK #

现在很多项目都需要接入的短信服务，其中很多采用了阿里大于短信。但是官方的SDK太过于臃肿，引入了一个完完整整的框架。鉴于此，
预计阿里的官方文档封装了这个小的类库，以方便项目中引入使用。

## 安装 ##

建议使用 composer 进行安装:

```
composer require "JinZhiSu\ALiDaYuSms"
```

## 使用 ##

```
$auth = new \JinZhiSu\ALiDaYuSms\Auth($ak, $sk);
$requestParams = (new \JinZhiSu\ALiDaYuSms\RequestParams($auth))
    ->setPhoneNumbers(13930733521)
    ->setSignName('XXX')
    ->setTemplateCode('XXX')
    ->setTemplateParam('XXX')
    ->setOutId('XXX');
$result = (new \JinZhiSu\ALiDaYuSms\Request($requestParams->getFinalReuqestUrl(),
    $requestPrams->getSign());
```