<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-info-circle"></i> 你好，<strong><?= empty($user['nickname']) ? $user['username'] : $user['nickname']?></strong>，到期时间：<?= fromDate($user['u_end'], 'yyyy-MM-dd HH:mm');?> <a href="/ucenter/vips" class="btn btn-danger">续费</a>
        </div>
    </div>
</div>