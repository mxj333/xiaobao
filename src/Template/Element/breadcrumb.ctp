<ol class="breadcrumb">
    <li><a href="/"><span aria-hidden="true" class="glyphicon glyphicon-home"> <?= C('WEB_SITENAME');?></a></li>
    <?php if($page_title):?>
    <li><a href="/<?= $page_breadcrumb_url?>"> <?= $page_title ?></a></li>
    <?php endif;?>
</ol>