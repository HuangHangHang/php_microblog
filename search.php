<?php
    require('library/Db.class.php');//引入数据库操作类
    require("library/function.php");   //引入公共函数
    require('library/page.class.php'); //引入分页操作类
    is_login();
    $keyword = $_REQUEST['keyword'];
    $keyword = str_replace("%","/%",$keyword);
    $db      = new Db();
    //
    $showrow = 2; //一页显示微博条数
    $curpage = empty($_GET['page']) ? 1 : $_GET['page']; //
    $url = "?page={page}&keyword=".$keyword; //页数和关键字 ="?page={page}&q=".$_GET['q']

    $total = $db->single("select count(*) from tb_post where content like :keyword",array('keyword'=>"%$keyword%"));//根据关键字查询

    if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
        $curpage = ceil($total_rows / $showrow); //
    //
    $sql  = "select * from tb_post where content like :keyword";
    $sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";

    $post = $db->query($sql,array('keyword'=>"%$keyword%"));

    foreach($post as $vo){
        $vo['avatar']  = $db->single('select avatar from tb_user where id = :user_id',array('user_id'=>$vo['user_id']));
        $status        = $db->single('select status from tb_collect where user_id = :uid and post_id = :pid',array('uid'=>$vo['user_id'],'pid'=>$vo['id']));
        $vo['collect'] = $status ? $status : 0;

        //
        if($vo['pictures']){
            $vo['pictures'] = explode(',',$vo['pictures']);
        }
        //
        $vo['forward_count'] = $db->single('select count(*) from tb_post where post_type = 2 and pid = '.$vo['id']);

        //
        $vo['comment_count'] = $db->single('select count(*) from tb_post where post_type = 1 and pid = '.$vo['id']);

        //
        $vo['praise_count']  = $db->single('select count(*) from tb_praise where post_id = '.$vo['id']);

        //
        if(isset($vo['pid']) && $vo['post_type'] == 2){
            $parent  = array();
            $content = '';
            $pid = $vo['pid'];
            $parent  = $db->row('select * from tb_post where id = '.$pid);//
            do{
                if(isset($parent) && $parent['post_type'] == 2){
                    //
                    $content = '@'.$parent['username'].':'.$parent['content'].'//'.$content;
                    $parent  = $db->row('select * from tb_post where id = '.$parent['pid']);//
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
            $vo['sub'] = $sub;
        }
        $lists[] = $vo;
    }
    include "view/search-list.php";
