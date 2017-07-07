<div class="col-lg-12">
    <a href="/ucenter/users/login">退出</a>
    <?= $this->Form->create() ?>
        <fieldset>
            <div class="form-group has-error">
                <input id="disabledInput" class="form-control input-lg" name="username" type="text" value="<?= $user['username']?>" disabled>
            </div>
            <div class="form-group has-success">
                <input class="form-control input-lg" placeholder="Old Password" name="old_password" value="" type="password">
            </div>
            <div class="form-group has-success">
                <input class="form-control input-lg" placeholder="Password" name="password" value="" type="password">
            </div>
            <div class="form-group has-success">
                <input class="form-control input-lg" placeholder="Confirm Password" name="password_confirm" value="" type="password">
            </div>
            <button class="btn btn-primary btn-lg btn-block"><?= __('Submit')?></button>
            <a href="/ucenter/users/login" class="btn btn-default btn-lg btn-block"><?= __('Logout')?></a>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
<?php 
    //pr($user);
?>