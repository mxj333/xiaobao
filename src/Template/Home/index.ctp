<div class="col-sm-12">
    <?php $this->element('breadcrumb');?>
    <div id="pagination-container">
        <div class="jumbotron">
            <h1><img src="/img/logo.png" height="60"> <?= C('WEB_SITENAME')?></h1>
            <p><?= C('WEB_DESCRIPTION');?></p>
            <p><a class="btn btn-lg btn-danger" href="/users/register" role="button"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> 现在注册，开始考试<!-- 送<?= C('GIVE_N_DAY_VIP')?>天VIP --></a></p>
            <p><span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>
            分红险与万能险保险销售资质考试全真题库</p>  
            <!-- <p><span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span> 现在注册送<?= C('GIVE_N_DAY_VIP')?>天VIP会员,VIP会员考试次数不限</p> -->
            <p><span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span> 从海量的全真题库中随机抽取100道进行测试</p>
            <!-- <p><span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span> 单选题35道，多选题55道，判断题10道</p> -->
            <p><span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span> 针对错题重考，巩固知识点</p>
        </div>
        <?= $this->element('articles');?>
    </div>
</div>