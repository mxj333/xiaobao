<section class="home-thumbnail-posts">
    <div class="home-thumbnail-posts-inner">
        <h2 class="entry-headline"><?= $page_title?></h2>
        <div class="post-entry-thumbnails-wrapper">
        <?php foreach ($weipaiDetails as $key => $wd) {?>
            <article class="post-entry-thumbnail">
                <a href="/weipaidetails/view/<?= $wd->id?>/dequanyuan_<?= $this->Time->format($wd->created, 'yyyyMMdd_HHmmss', null, null);?>.html" title="<?= $wd->wd_title?>">
                    <span class="thumbnail-hover"></span>
                    <img src="<?= $wd->weipai_images[0]->i_path . 'thum_150_'. $wd->weipai_images[0]->i_name?>" class="attachment-thumbnail-thumb wp-post-image" width="150" />
                    <p><?= getShortTitle($wd->wd_title, 12) ?></p>
                </a>
            </article>
        <?php } ?>
        </div>
    </div>
</section>