<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2018/11/12
 * Time: 10:10
 */
require_once './Workerman-master/Autoloader.php';
require('./vendor/autoload.php');
use Firebase\JWT\JWT;
use Workerman\Worker;

//实例化worker
$worker = new Worker('websocket://0.0.0.0:8686');
//设置进程数
$worker->count = 1;

//定义数组保存所有的用户
/*
一维数组，里面的数据格式：
[
    1 => 'tom',
    2 => 'jack',
    ....
]
*/
$users = array();
//定义数组保存用户的id和这个客户端的关系
/*
一维数组，里面的数据格式：
[
    1 => $connection 对象,
    2 => $connection 对象,
    ....
]
*/
$userConn = array();

//客户端连接时调用
$worker->onConnect = function ($connection){
//    接收连接时的参数
    $connection->onWebSocketConnect = function ($connection, $http_header) {

        global $worker,$users,$userConn;

        try
        {
            $key = "123abc";
            $data = JWT::decode($_GET['token'], $key, array('HS256'));
            $connection->uid = $data->id;
            $connection->uname = $data->username;
            $users[] = array('id'=>$data->id,'username'=>$data->username);
            $userConn[$data->id] = $connection;
            $connection->send(json_encode(array('type'=>'users','users'=>$users,'myuser'=>$data->username)));
            foreach ($worker->connections as $c){
                if($c !== $connection)
                $c->send(json_encode(array(
                    'type'=>'newUser',
                    'newUser'=>array('id'=>$data->id,'username'=>$data->username)
                )));
            }
        }
        catch(  \Firebase\JWT\ExpiredException $e)
        {
            $connection->close();
        }
        catch( \Exception $e)
        {
            $connection->close();
        }

    };
};

$worker->onMessage = function ($connection,$data){

    $arr = explode(":",$data);
    $code = $arr[0];
    unset($arr[0]);
    $arrData = implode(":",$arr);

    //    根据id 找到对应客户端对象
    global $userConn;
//    var_dump($code);
    $userConn[$code]->send(json_encode(array(
        'send'=>$connection->uid,
        'type'=>'message',
        'to'=>$code,
        'messsage'=>$arrData
    )));

};

//当有人断开连接时调用这个函数
$worker->onClose = function ($connection){

    global $users,$worker;

//    告诉所有用户 退出聊天的客户端的id
    foreach($worker->connections as $c){
        if($c!==$connection){
            $c->send(json_encode(array(
                'type'=>'logoutUser',
                'logoutUserId'=>$connection->uid
            )));
        }
    }
//    删除保存的客户端信息
    for($i=0;$i<count($users);$i++){
        if($users[$i]['id']==$connection->uid){
            unset($users[$i]);
        }
    }
    $users = array_values($users);


};

Worker::runAll();
