<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>零点微博注册</title>

    <link rel="stylesheet" type="text/css" href="public/css/semantic.css" />
    <link rel="stylesheet" type="text/css" href="public/css/login.css" />
    <script type="text/javascript" src="public/js/jquery.js"></script>
    <script type="text/javascript" src="public/static/layer/layer.js"></script>
    <style type="text/css">
        #u_m a:hover{
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="header" title="头部">
    <img src="public/images/login_logo1.png">
</div>

<div class="main">
    <div class="left">
        <div class="login-bg">
            <img src="public/images/log_ban.jpg">
        </div>
    </div>
    <div class="content">

        <div class="ui big form">
            <div class="ui stacked segment blue">
                <div class="field">
                    <div class="ui icon input">
                        <i class="user icon"></i>
                        <input type="text" name="username" placeholder="用户名">
                    </div>
                </div>
                <div class="field">
                    <div class="ui icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="密码">
                    </div>
                </div>
                <div class="field">
                    <div class="ui icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password2" placeholder="确认密码">
                    </div>
                </div>
                <button id="login" class="ui fluid large teal submit  button" >注册</button>
            </div>
            <div class="ui message" id="u_m">
                已有账号，直接&nbsp;<a href="login.php" style="font-size: 16px;">登录</a>
            </div>
        </div>

        <div class="recommend">
            <div class="ui horizontal divider">
                <h4 class="ui teal">推荐用户</h4>
            </div>
            <div class="ui tiny images">
                <img class="ui medium circular image" src="public/images/t_header01.jpeg">
                <img class="ui medium circular image" src="public/images/t_header02.jpg">
                <img class="ui medium circular image" src="public/images/t_header03.jpg">
                <img class="ui medium circular image" src="public/images/t_header04.jpg">
                <img class="ui medium circular image" src="public/images/t_header05.jpg">
                <img class="ui medium circular image" src="public/images/t_header06.jpg">
                <img class="ui medium circular image" src="public/images/t_header07.jpg">
                <img class="ui medium circular image" src="public/images/t_header08.jpg">
                <img class="ui medium circular image" src="public/images/t_header09.jpg">
            </div>
        </div>

    </div>
</div>
<div class="clear"></div>
<div class="footer">
    版权所有：@零点科技
</div>

<script>
    $('#login').click(function(){
        var username  = $("input[name='username']").val();
        var password  = $("input[name='password']").val();
        var password2  = $("input[name='password2']").val();

        if(username == ''){
            layer.msg('请填写用户名!');
            return false;
        }
        if(password == ''){
            layer.msg('请填写密码!');
            return false;
        }
        if(password !== password2){
            layer.msg('两次输入密码不一致！');
            return false;
        }

        $.post("ajaxRegister.php", {username: username,password:password}, function(data) {
            if (data == -1) {
                layer.msg('用户名已存在');
                return false;
            }
            if (data == 1){
                layer.msg('注册成功',{time:1000},function () {
                    window.location.href = "index.php";
                });
            }else {
                layer.msg('注册失败');
            }
        });
        return false;
    });
</script>
</body>
</html>