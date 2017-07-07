<?php
    foreach ($articles as $article): ?>
        <article class="post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized tag-css tag-html tag-layout post-entry">
            <div class="post-entry-inner">
                <h2 class="post-entry-headline"><a href="/articles/view/<?= $article->id?>/<?= $article->art_url_alias?>.html"><?= getShortTitle($article->art_title, 32) ?></a></h2>
                <p class="post-meta">
                    <span class="post-info-date"><?= $this->Time->format($article->created, 'yyyy-MM-dd HH:mm');?></span>
                </p>
                <div class="post-entry-content-wrapper">
                    <a href="/articles/view/<?= $article->id?>/<?= $article->art_url_alias?>.html">
                        <img class="attachment-post-thumbnail wp-post-image" src="<?= getCover($article)?>" title="<?= h($article->art_title) ?>" alt="<?= h($article->art_title) ?>">
                    </a>
                    <div class="post-entry-content">
                        <p>
                            <?= getShortTitle($article->art_body, 100);?>
                            <br/>
                            <a class="read-more-button" href="/articles/view/<?= $article->id?>/<?= $article->art_url_alias?>.html">阅读全文</a>
                        </p>
                    </div>
                </div>
                <div class="post-info"></div>
            </div>
        </article>
<?php
    endforeach;
    $this->Paginator->templates([
        'nextActive' => '<a class="su" rel="next" href="{{url}}">{{text}}</a>',
        'nextDisabled' => '',
        'prevActive' => '<a class="su" rel="prev" href="{{url}}">{{text}}</a>',
        'prevDisabled' =>'',//'<a class="prev disabled su" href="" onclick="return false;">{{text}}</a>',
        'number' => '<a class="su" href="{{url}}">{{text}}</a>',
        'current' => '<a class="su active" href="">{{text}}</a>',
    ]);
    echo '<div class="bigpage">';
    echo $this->Paginator->prev(__('上一页'), array(), null, array('class'=>'off'));
    echo $this->Paginator->numbers(array('tag' => 'div','separator' => '……'));
    echo $this->Paginator->next(__('下一页'), array(), array(), array('class' => 'off'));
    echo '</div>';
?>
