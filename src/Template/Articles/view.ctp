<div class="col-sm-12">
    <?php $this->element('breadcrumb');?>
    <h3><?= $articles->art_title; ?></h3>

    <p class="header-line">
        <span class="glyphicon glyphicon-time"></span> <?= fromDate($articles->created) ?> &nbsp;&nbsp;
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <?= $articles->art_hits?>  &nbsp;&nbsp;
        <span class="glyphicon glyphicon-share-alt"></span> <?= $articles->art_source?>  &nbsp;&nbsp;
    </p>
    <?php
        if ($articles->column_id == 3) :
            echo $this->element('video');
        endif;?>
    <p><?=$articles->art_body;?> </p>

    <?php if (!is_mobile()):?>
    <p class="lead">
    <!-- JiaThis Button BEGIN -->
        <div class="jiathis_style_32x32">
            <a class="jiathis_button_qzone"></a>
            <a class="jiathis_button_tsina"></a>
            <a class="jiathis_button_tqq"></a>
            <a class="jiathis_button_weixin"></a>
            <a class="jiathis_button_cqq"></a>
        </div>
        <script type="text/javascript" >
        var jiathis_config={
            summary:"",
            shortUrl:false,
            hideMore:true
        }
        </script>
        <!-- JiaThis Button END -->
        <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    </p>
    <?php endif;?>
</div>

