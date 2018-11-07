# 阿里大于短信 SDK #

现在很多项目都需要接入的短信服务，其中很多采用了阿里大于短信。但是官方的SDK太过于臃肿，引入了一个完完整整的框架。鉴于此，
预计阿里的官方文档封装了这个小的类库，以方便项目中引入使用。

## 安装 ##

建议使用 composer 进行安装:

```
composer require jinzhisu/a-lida-yu-sms dev-master
```

## 使用 ##

```
requestPrams->getSign());
$ak = 'LTAIjoHwX******';
$sk = 'fsJeM1J2mnI************';
$auth = new Auth($ak, $sk);
$requestParams = new RequestParams($auth);
$sign = $requestParams->setPhoneNumbers(13910733521)
    ->setTemplateCode('SMS_148613598')
    ->setTemplateParam(['content' => mt_rand(1000, 9999)])
    ->setSignName('Test')
    ->getSign();
$result = (new Request)->send($requestParams->getFinalRequestUrl(), $sign);
var_dump($result);
```