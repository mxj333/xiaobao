<nav class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container">
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
                <?php foreach ($navigations as $key => $nav) {?>
                    <li><a href="<?= $nav->url?>" target="<?= $nav->target?>" ><i class="<?= $nav->icon?>" aria-hidden="true"></i> <?= $nav->title?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>