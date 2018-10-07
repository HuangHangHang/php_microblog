<?php

require("library/function.php");
require('library/Db.class.php');
is_login();
$db = new Db();
$user_id = $_SESSION['user']['id'];
$user = $db->row("select * from tb_user where id = :user_id",array('user_id' => $user_id));
include 'view/setting-list.php';