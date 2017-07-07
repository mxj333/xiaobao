<div id="loginModal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center"><?= __('Login')?></h1>
            </div>
            <div class="modal-body">
                <form class="form col-md-12 center-block">
                <div class="form-group">
                    <input type="text" class="form-control input-lg" placeholder="<?= __('Mobile phone')?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control input-lg" placeholder="<?= __('Password')?>">
                </div>
                <div class="form-group">
                    <span class="login-checkbox">
                        <input type="checkbox" tabindex="4" value="1" class="field login-checkbox" name="remember_me" id="remember_me">
                        <label for="remember_me" class="choice"> <?= __('Remember me')?></label>
                    </span>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-danger btn-block"><?= __('Sign In')?></button>
                    <span class="pull-right"><a href="/cuenter/users/register"><?= __('Register')?></a></span><span><a href="javascript:void(0);"><?= __('Retrieve password')?></a></span>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><?= __('Cancel')?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        
        $("input[name=vip]").on("click", function(){
            $('#loginModal').modal('show');
        });
    });
</script>