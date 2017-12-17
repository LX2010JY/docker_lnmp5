<style>
	.pad150{padding: 150px 0}
	.red{color: red}
	.font14{font-size: 14px;line-height:30px}
    .flag{text-align: center;line-height: 40px;font-weight: bolder;font-size: 25px;}
    .bggray{opacity: 0.5;background-color: #4F5155;height: 100%;color:#FFF;}
    .bggray .right{line-height: 25px;font-size: 12px;c,olor:#666;text-align: right}
    .bggray .right a{color: #FFF !important;}
</style>
<div class="container-fluid pad150 bggray">
    <div class="rows">
        <div class="col-md-4 col-md-offset-4 flag">
            登录
        </div>
        <div class="col-md-4 col-md-offset-4">
            <?php echo form_open('auth/login'); ?>
            <div class="form-group">
                <label for="email">邮箱地址</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="邮箱地址">
            </div>
            <div class="form-group">
                <label for="passwd">密码</label>
                <input type="password" class="form-control" id="passwd" name="passwd" placeholder="密码">
            </div>
            <div class="form-group">
                <p class="red font14"><?php echo $error;?></p>
            </div>
            <div class="right">
                <a href="<?php echo site_url('/auth/register')?>">还没有账号？去注册吧 ></a>
            </div>
            <button type="submit" class="btn btn-default btn-block">登录</button>
            </form>
        </div>
    </div>

</div>
