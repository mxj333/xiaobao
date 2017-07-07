<div class="scaffold-action scaffold-action-index scaffold-controller-columns scaffold-columns-index">
<?php foreach ($source_website as $key => $site):?>
    <a href="/zen/Collections/add/<?= $key?>" class="btn btn-default" role="button" value="1"> <?= $site?></a>
<?php endforeach;?>
<hr>
<?=$this->element('articles_zen');?>
<?=$this->element('paging_links');?>
</div>