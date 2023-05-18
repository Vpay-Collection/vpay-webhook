## Vpay WebHook Demo
该项目是演示Vpay商城的Webhook能力，适合动态生成注册码/QQ付费入群等需要二次开发场景。

## 简单使用

`base.php`是基础类，这里进行签名校验，直接传入POST数组及WebHook地址即可。

```php
function sign($array,$key): string
{
    ksort($array);
    return hash_hmac('sha256', http_build_query($array), $key);
}
```

`AutoPro/index.php`是业务逻辑处理，第一步先校验Key

```php
checkKey("uoaMZgbo7Eq05sLutFZM6k1cDeGJgeMy");
```

然后再根据传入的POST参数生成数据返回

```php
if(isset($_POST['机器码'])){
    $expirationDate = '3023-12-31';
    $registrationCode = generateRegistrationCode($_POST['机器码'], $expirationDate);
     json(200,"OK","<p>您的注册码为：<b>".$registrationCode."</b><br>感谢您对自动记账的支持！</p>");
}else{
     json(403,"非常抱歉您缺少机器码信息");
}

```

*注意*

这里需要返回如下格式的数据：

```json
{
  "code": 200,
  "msg": "OK",
  "data": ""
}
```

其中，code如果不是200则表示出错，msg则是传递错误信息，data表示处理成功后发送给用户的邮件内容。

## Webhook地址

```shell
https://your.domain/AutoPro/index.php?key=uoaMZgbo7Eq05sLutFZM6k1cDeGJgeMy
```
