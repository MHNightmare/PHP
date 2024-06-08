<?php
include_once("bootstrap/init.php");

if($_SERVER['REQUEST_METHOD']=='POST'){
    $action=$_GET['action'];
    if($action== 'register'){
        $new_user= $_POST;
        $result = register($new_user['name'],$new_user['password'],$new_user['email']);
        echo alert($result);
    }else if($action== 'login'){
        $user= $_POST;
        login($user['email'],$user['password']);
    }

}
include_once(BASE_PATH."tpl/tpl.auth.php");