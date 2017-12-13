<style>
    .header{width:100%;line-height: 50px;padding:10px 50px;box-shadow: 0 3px 5px 2px #999;background-color: #2e8ece;overflow: hidden;cursor: pointer;position: fixed;top:0;left: 0;z-index: 10000;user-select: none}
    .left{float: left;font-size: 30px; color:#FFF;font-family: Monaco, Courier New, Courier, monospace, "Microsoft Sans Serif";font-weight: bolder}
    .right{float: right;font-size: 14px;color:#FFF;}
    .placeholder{height: 70px;}
    .header a{color:#EFEFEF !important;}
</style>
<header class="header">
    <div class="title left">
        最小说
    </div>
    <div class="right">
        <?php if (!empty($user)):?>
        <span>
            <?php echo $user;?>
            |
            <a href="<?php echo site_url('auth/logout');?>">登出</a>
        </span>
        <?php else: ?>
        <span>
            <a href="<?php echo site_url('auth/login');?>">登录</a>
            |
            <a href="<?php echo site_url('auth/register');?>">注册</a>
        </span>
        <?php endif ?>
    </div>
</header>
<div class="placeholder"></div>