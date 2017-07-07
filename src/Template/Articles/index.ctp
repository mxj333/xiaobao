<div class="col-sm-12">
    <?= $this->element('breadcrumb');?>
    
    <!-- First Blog Post -->
    <div id="pagination-container">
        <!-- Carousel -->
        <?php
            if ($adverts) {
                //echo $this->element('carousel');
            }
        ?>
      <!-- Carousel -->

    <?= $this->element('articles');?>

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