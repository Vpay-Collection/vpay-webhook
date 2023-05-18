<?php

function sign($array,$key): string
{
    ksort($array);
    return hash_hmac('sha256', http_build_query($array), $key);
}
function checkKey($key){
    if(!isset($_GET['key'])||trim($_GET['key'],"/")!==$key){
        json(403,"验证失败");
    }
}
function json($code=200,$msg="OK",$data=null){
    exit(json_encode(['code'=>$code,"msg"=>$msg,"data"=>$data]));
}

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$url = trim($protocol . "://" . $host . $_SERVER['REQUEST_URI'],"/");

if(!isset($_SERVER['HTTP_SIGN'])||$_SERVER['HTTP_SIGN']!==sign($_POST,$url)){
    json(403,"签名校验失败");
}
