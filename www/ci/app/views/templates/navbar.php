<link href="public/css/public/header.css" rel="stylesheet" type="text/css" />
<header class="header">
    <div class="title left">
<!--        最小说-->
        <div style="width: 200px;height: 50px;background-color: #eee"></div>
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