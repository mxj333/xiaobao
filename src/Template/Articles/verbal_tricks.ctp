<div class="col-sm-12">
    <?php $this->element('breadcrumb');?>

    <!-- First Blog Post -->
    <div id="pagination-container">
    <?php foreach ($articles as $article): ?>
        <div class="row country-item">
            <div class="col-xs-12 col-md-12">
                <h3>
                    <a href="/articles/view/<?= $article->id?>/<?= $article->art_url_alias?>.html"> 
                    <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 
                    <?= h($article->art_title) ?>    
                    <!-- <span class="glyphicon glyphicon-time" aria-hidden="true"></span>  -->
                    <?php
                        //echo fromDate($article->created);
                    ?>
                    </a>
                </h3>
                <?php
                    echo $article->art_body;
                ?>
            </div>
        </div>
        <!-- <hr> -->
    <?php endforeach; ?>

    <!-- Pager -->
    <!-- <nav> -->
        <ul class="pager paging" style="display: none;">
            <?= $this->Paginator->next(__('加载更多…')) ?>
        </ul>
    <!-- </nav> -->
    </div>
</div>

<!-- Blog Sidebar Widgets Column -->
<?php //echo $this->element('home_sidebar');?>
<?= $this->Html->script(['jquery.infinitescroll']); ?>
<script>
    $(function() {
        var $container = $('#pagination-container');

        $container.infinitescroll({
                navSelector: '.paging', // selector for the paged navigation
                nextSelector: '.next a', // selector for the NEXT link (to page 2)
                itemSelector: '.row .country-item', // selector for all items you'll retrieve
                debug: true,
                dataType: 'html',
                loading: {
                    finishedMsg: '没有更多啦!',
                    img: '/img/hourglass.gif'
                }
        });

        $('.paging-description').hide();
    });
</script>