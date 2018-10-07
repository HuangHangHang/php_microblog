<?php

require('library/Db.class.php');//连接数据库
require("library/function.php");   //自定义函数
require('library/page.class.php'); //分页类

is_login();
$db = new Db();
$user_id = $_SESSION['user']['id'];


$showrow = 5;
$curpage = empty($_GET['page']) ? 1 : $_GET['page'];
$url     = "?page={page}"; //
$total   = $db->single("select count(*) from tb_praise where user_id = :user_id ",array('user_id'=>$user_id));//?????????

if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow)){
    $curpage = ceil($total / $showrow); //
}
$sql  = "select * from tb_praise where user_id = :user_id order by id desc";
$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
$praise_lists = $db->query($sql,array('user_id'=>$user_id));

if(isset($praise_lists)){
    foreach($praise_lists as $vo){
        $post   = $db->row('select * from tb_post where id = :id',array('id'=>$vo['post_id']));
        $avatar = $db->single('select avatar from tb_user where id = :user_id',array('user_id'=>$post['user_id']));
        $post['avatar']  = $avatar;
        $post['collect'] = 1; //
        //
        if($post['pictures']){
            $post['pictures'] = explode(',',$post['pictures']);
        }
        //
        $post['forward_count'] = $db->single('select count(*) from tb_post where post_type = 2 and pid = '.$post['id']);
        //
        $post['comment_count'] = $db->single('select count(*) from tb_post where post_type = 1 and pid = '.$post['id']);
        //
        $post['praise_count']  = $db->single('select count(*) from tb_praise where post_id = '.$post['id']);
        //
        if(isset($post['pid']) && $post['post_type'] == 2){
            $parent  = array();
            $content = '';
            $pid     = $post['pid'];
            $parent  = $db->row('select * from tb_post where id = '.$pid);//???????
            do{
                if(isset($parent) && $parent['post_type'] == 2){
                    //
                    $content = '@'.$parent['username'].':'.$parent['content'].'//'.$content;
                    $parent  = $db->row('select * from tb_post where id = '.$parent['pid']);//???????
                    $flag = true;
                }else{
                    //
                    if($parent['pictures']){
                        $parent['pictures'] = explode(',',$parent['pictures']);
                    }
                    $sub['parent'] = $parent;
                    $flag = false;
                }
            }while($flag === true);
            $sub['content'] = substr($content,0,-2);
            $post['sub'] = $sub;
        }
        $lists[] = $post;
    }

}

include 'view/mypraise-list.php';

