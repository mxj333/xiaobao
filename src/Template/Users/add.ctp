<div class="col-md-6">
    <form class="form-horizontal" action="javascript:void(0);" method="POST" id="register">
      <fieldset>
        <div id="legend">
          <legend class=""><?= __('注册')?></legend>
        </div>
        <div class="control-group">
            <!-- <label class="control-label" for="username"><?= __('手机号')?></label> -->
            <div class="controls">
                <input type="text" id="username" name="username" value="" placeholder="请输入手机号" class="form-control input-lg" autocomplete="off" required="" title="<?= __('Please provide your Mobile phone')?>">
                <p class="help-block"><!-- <?= __('Please provide your Mobile phone')?> --></p>
            </div>
        </div>
        <div class="control-group">
            <!-- <label class="control-label" for="password">Password</label> -->
            <div class="controls">
                <input type="password" id="password" name="password" value=""  placeholder="<?= __('请输入密码')?>" class="form-control input-lg">
                <p class="help-block"></p>
            </div>
        </div>
        <div class="control-group">
            <!-- <label class="control-label" for="password_confirm">Password (Confirm)</label> -->
            <div class="controls">
                <input type="password" id="password_confirm" name="password_confirm" placeholder="<?= __('确认密码')?>" class="form-control input-lg">
                <p class="help-block"></p>
            </div>
        </div>
        <!-- <div class="control-group">
            <label class="control-label" for="username_again"><?= __('Mobile phone (Confirm)')?></label>
            <div class="controls">
                <input type="text" id="username_again" name="username_again" placeholder="Mobile phone" class="form-control input-lg">
                <p class="help-block"><?= __('Please provide your Mobile phone')?> </p>
            </div>
        </div> -->
        <div class="control-group">
            <!-- <label label-default="" class="control-label">Card CVV</label> -->
            <div class="controls">
                <div class="row">
                    <div class="col-xs-4">
                        <input type="text" class="form-control" autocomplete="off" maxlength="4" pattern="\d{4}" title="<?= __('Three digits at back of your card')?>" required="" name="card">
                    </div>
                    <div class="col-xs-4">
                        <a  class="btn btn-info codeBtn" >
                            <label></label>
                            <span><?= __('获取验证码')?></span>
                        </a>
                    </div>
                </div>
                <p class="help-block"><!-- Please confirm Carc CVV --></p>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-success register"><?= __('注册')?></button>
                <span class="btn pull-right"><a href="/ucenter/users/login">已有账号，直接登录</a></span>
            </div>
        </div>
      </fieldset>
    </form>
</div>
<?= $this->Html->script([
'ucenter/public']) ?>
<!-- 'validation/jquery.validate.min', 
'validation/additional-methods.min', 
'validation/localization/messages_zh',  -->
<script>
    $(function(){
        //60秒倒计时
        $(".codeBtn").bind("click",start_time);
        
        //提交表单
        $(".register").bind("click", function(event) {
            var username = chMobile($('input[name=username]'));
            if(!username){
                showMessage('请输入正确手机号！');
            }

            var password = $("input[name=password]").val();
            if (password == '') {
                showMessage('请输入密码');
            }

            var password_confirm = $("input[name=password_confirm]").val();
            if (password_confirm == '') {
                showMessage('请输入确认密码');
            }

            if (password != password_confirm) {
                showMessage('两次输入的密码不一致');
            }

            var card = $("input[name=card]").val();
            if (card == '') {
                showMessage('请输入验证码');
            }
            var pram = {
                'mobile': $('input[name=username]').val(),
                'verify': card,
                'password':password
            };
            $.post('/users/register', pram, function(json){
                // console.log(json);
                if (json.status == 1) {
                    showMessage(json.info);
                    window.location.href = '/';
                } else {
                    showMessage(json.info);
                }
            }, 'json');


            event.preventDefault();
        });

    });
</script>