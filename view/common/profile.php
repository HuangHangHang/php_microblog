<?php
    $sql    = 'select * from tb_user where id = :user_id';
    $user   = $db->row($sql,array('user_id'=>$_SESSION['user']['id']));
?>
<div class="profile">
    <!--    新增右侧个人部分-->
    <div class="my_info">
        <img class="my_info_head" height="90px" width="90px" src="<?php echo get_cover_path($user['avatar']) ?>">
        <h4><?php echo $user['username'] ?></h4>
        <div class="my_info_list">
            <ul>
                <a href="friends.php">
                    <li><span><?php echo $user['follows_num'] ?></span></li>
                    <li>关注</li>
                </a>
            </ul>
            <ol></ol>
            <ul>
                <a href="myFans.php">
                    <li><span><?php echo $user['fans_num'] ?></span></li>
                    <li>粉丝</li>
                </a>
            </ul>
            <ol></ol>
            <ul>
                <a href="myPost.php">
                    <li><span><?php echo $user['posts_num'] ?></span></li>
                    <li>微博</li>
                </a>
            </ul>
        </div>
    </div>

    <!--明天图书推荐开始-->
    <div class="mr_book">
        <h4>新闻热搜</h4>
        <div class="mr_boox_list">
            <a href="https://item.btime.com/32cbv5dd4ru94case90aekm05pk?from=gjl">
            <img src="public/images/news1.jpg">
            <ul>
                <li>杨幂演技被北京日...</li>
                <li><span>时间：2018年10月4日</span></li>
                <li><p>自从一部电视《宫》...</p></li>
            </ul>
            </a>
        </div>
        <div class="mr_boox_list">
            <a href="https://item.btime.com/m_97efe9b6c49ce957d?from=gjl">
            <img src="public/images/news2.jpg">
            <ul>
                <li>刘强东：京东发布重大...</li>
                <li><span>时间：2018年9月29ri</span></li>
                <li><p>在刘强东事件还未...</p></li>
            </ul>
            </a>
        </div>
        <div class="mr_boox_list">
            <a href="https://item.btime.com/370vin3ai57918b3phnjd15ogqg">
            <img src="public/images/news3.png">
            <ul>
                <li>这个假期，高铁车厢...</li>
                <li><span>时间：2018年10月4日</span></li>
                <li><p>10月4日，在高铁列车上的...</p></li>
            </ul>
            </a>
        </div>
    </div>
    <!--明天图书推荐结束-->
</div>