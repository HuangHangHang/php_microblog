<?php
 require("library/function.php");
 require('library/Db.class.php');
 is_login();
 $db = new Db();
 $user_id = $_SESSION['user']['id'];
 $sex = $_POST['sex'];
 $qq = $_POST['qq'];
 $email = $_POST['email'];

 $sql = "update tb_user set sex = :sex,qq = :qq,email = :email where id = :user_id";
 $update = $db->query($sql,array("user_id" => $user_id,"sex" => $sex,"qq" => $qq,"email" => $email));

 if($update !==false){
     echo "<head><meta charset='utf-8'></head>";
     echo "<script>alert('信息保存成功');window.location.href='setting.php';</script>";
 }else{
     echo "<head><meta charset='utf-8'></head>";
     echo "<script>alert('信息保存失败');window.location.href='setting.php';</script>";
 }
