<?php

include_once '../base.php';
function generateRegistrationCode($userId, $expirationDate): string
{
    // 组合用户ID、到期日期和签名为注册码
    // 返回注册码
    return base64_encode($userId . '|' . $expirationDate . '|' );
}

checkKey("uoaMZgbo7Eq05sLutFZM6k1cDeGJgeMy");

if(isset($_POST['机器码'])){
    $expirationDate = '3023-12-31';
    $registrationCode = generateRegistrationCode($_POST['机器码'], $expirationDate);
     json(200,"OK","<p>您的注册码为：<b>".$registrationCode."</b><br>感谢您对自动记账的支持！</p>");
}else{
     json(403,"非常抱歉您缺少机器码信息");
}

