<style>
    .pad150{padding: 150px 0};
    .red{color: red}
    .font14{font-size: 14px;line-height: 30px;}
</style>
<div class="container pad150">
    <div class="rows">
        <div class="col-md-4 col-md-offset-4">
            <?php echo form_open('auth/register'); ?>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="passwd">Password</label>
                    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Password">
                </div>
            <div class="form-group">
                <p class="red font14"><?php echo $error;?></p>
            </div>
                <button type="submit" class="btn btn-default btn-block">Register</button>
            </form>
        </div>
    </div>
</div>