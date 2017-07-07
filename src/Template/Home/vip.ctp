<div class="col-sm-12">
    <?php
        echo $this->element('breadcrumb');
    ?>
    <div id="pagination-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">VIP会员</h3>
                    </div>
                    <div class="panel-body">
                    <h3><?= C('WEB_SITENAME')?></h3>
                    <p><?= C('WEB_DESCRIPTION');?></p>
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                     分红险与万能险保险销售资质考试全真题库</p>  
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> 现在注册送一个月VIP会员,VIP会员考试次数不限</p>
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> VIP会员可针对错题重考，巩固知识点</p>
                    <form class="form" action="javascript:void(0);" accept-charset="utf-8" method="post">
                        <input class="btn btn-lg btn-danger btn-block" payvip="100" name="vip" value="PAY￥100元" type="submit">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>