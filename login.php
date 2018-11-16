<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2018/11/13
 * Time: 17:00
 */
require './vendor/autoload.php';
use Firebase\JWT\JWT;

//连接数据库
$pdo = new PDO("mysql:host=127.0.0.1;dbname=chatdemo","root","123456");
$pdo->exec("SET NAMES utf8");

/** 由于前端 axios 在发送 AJAX 时数据是以 JSON 格式提交的，
 * 而PHP不能直接使用 $_POST 来接收 JSON/XML等格式的数据
 * 要接收这种数据需要使用 file_get_contents('php://input')
 */
// 接收原始数据
$post = file_get_contents('php://input');
// 把JSON转成数组
$_POST = json_decode($post, TRUE);

//查询数据
$stmt = $pdo->prepare("select * from users where username=? and password=?");
$stmt->execute(array(
   $_POST['username'],
   md5($_POST['password'])
));
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if($user){
    $key = "123abc";
    $data = array(
      'id'=> $user['id'],
      'username'=>$user['username']
    );
//    为这个数据生成令牌
    $jwt = JWT::encode($data,$key);
//    返回json数据
    echo json_encode(array(
       'code' => 200,
        'jwt' => $jwt
    ));
}else{
    echo json_encode(array(
       'code' => 403,
       'error' => '用户名或者密码错误!'
    ));
}

