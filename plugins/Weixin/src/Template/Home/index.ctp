<?php
    echo $this->Html->script('jquery-migrate.min');
    echo $this->Html->script('flexslider');
    echo $this->Html->script('flexslider-settings');
    echo $this->Html->script('jquery.cycle2.min');
?>
<!-- Carousel -->
<?php
    if ($adverts) {
        echo $this->element('carousel');
    }
?>
<!-- Carousel -->
<section class="home-latest-posts">
    <article class="post-1662 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized tag-css tag-html tag-layout post-entry">
        <div class="post-entry-inner">
            <h2 class="post-entry-headline">关于我们</h2>
            <div class="post-entry-content-wrapper">
                <a href="/pages/about">
                    <img src="<?= getCover($about)?>" class="attachment-post-thumbnail wp-post-image" />
                </a>
                <div class="post-entry-content">
                    <p><?= getShortTitle($about->art_body, 183)?> <a class="read-more-button" href="/pages/about">阅读全文</a></p>
                </div>
        </div>
        <div class="post-info"></div>
    </article>
</section>
<section class="home-latest-posts">
    <article class="post-1662 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized tag-css tag-html tag-layout post-entry">
        <div class="post-entry-inner">
            <h2 class="post-entry-headline">服务项目</h2>
            <div class="server-content-wrapper">
                <article class="server-thumbnail">
                    <?= $this->Html->image('server1.jpg', ['class' => 'attachment-thumbnail-thumb wp-post-image'])?>
                    <h3>权威鉴定</h3>
                </article>
                <article class="server-thumbnail">
                    <?= $this->Html->image('server2.jpg', ['class' => 'attachment-thumbnail-thumb wp-post-image'])?>
                    <h3>价值评估</h3>
                </article>
                <article class="server-thumbnail">
                    <?= $this->Html->image('server3.jpg', ['class' => 'attachment-thumbnail-thumb wp-post-image'])?>
                    <h3>洽谈交易</h3>
                </article>
                <article class="server-thumbnail">
                    <?= $this->Html->image('server4.jpg', ['class' => 'attachment-thumbnail-thumb wp-post-image'])?>
                    <h3>代理拍卖</h3>
                </article>
            </div>
            <div class="post-info"></div>
        </div>
    </article>
</section>
<?= $this->element('product');?>