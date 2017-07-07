<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php
        foreach ($adverts as $key => $adv) {
    ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?= $key?>" class="<?php if ($key == 0 ) echo ' active';?>"></li>
    <?php } ?>
    </ol>
    <div class="carousel-inner" role="listbox">
    <?php
        foreach ($adverts as $key => $adv) {
    ?>
        <div class="item <?php if ($key == 0 ) echo ' active';?>">
            <a href="<?= $adv['adv_url']?>" target="_black" ><img src="<?= $adv['adv_img']?>" alt="<?=$adv['adv_title']?>" title="<?=$adv['adv_title']?>"></a>
        </div>
    <?php } ?>
    </div>
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>