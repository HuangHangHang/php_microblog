<?php
    session_start();  //开启session
    require('library/Db.class.php'); //连接数据库
    $username  = $_POST['username'];
    $password  = $_POST['password'];

    //验证用户名密码
    $sql  = "select * from tb_user where username = :username and password = :password";
    $db   = new Db();
    $user = $db->row($sql,array('username'=>$username,'password'=> $password));
    if($user){
        $_SESSION['user']      = $user;
        echo 1;
    }else{
        echo -1;
    }
