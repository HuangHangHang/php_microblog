<?php
 require('library/Db.class.php');
 require("library/function.php");
 is_login();

 $db = new Db();
 $old_password = $_POST['old_password'];
 $new_password = $_POST['new_password'];
 $user_id = $_SESSION['user']['id'];
 //error_log($user_id,'3','errors.log');
 $password = $db->single("select password from tb_user where id = :user_id",array("user_id" => $user_id));
 //error_log($password,'3','errors.log');
 if($old_password == $password){
     $sql = "update tb_user set password = :newPassword where id= :userId";
     $update = $db->query($sql,array("newPassword" => $new_password,"userId" => $user_id));
     if($update){
         echo 1;
     }else{
         echo 0;
     }
 }else{
     echo -1;
 }