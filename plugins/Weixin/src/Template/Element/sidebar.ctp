<aside id="sidebar">
    <div class="sidebar-widget">
        <div class="textwidget">
            <p style="margin-top: 20px;color:#5d7895;font-size:14px;font-family:'微软雅黑'; text-align:center">
                <script type="text/javascript">
                var t = new Date();
                {
                    document.write([t.getFullYear()+'年'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;']+[t.getMonth()+1+'月']+[t.getDate()+'日'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;']);
                    var w;
                    w = t.getDay()
                    if(w == 0) {w = "日"}
                    if(w == 1) {w = "一"}
                    if(w == 2) {w = "二"}
                    if(w == 3) {w = "三"}
                    if(w == 4) {w = "四"}
                    if(w == 5) {w = "五"}
                    if(w == 6) {w = "六"}
                    document.write('星期' +w)
                }
                </script>
            </p>
        </div>
    </div>
    <div class="sidebar-widget">
        <p class="sidebar-headline">微拍预展</p>
        <div class="textwidget">
            <ul>
            <?php foreach ($weipais as $key => $weipai):?>
                <li><a href="/weipais/view/<?= $weipai->id?>/dequanyuanweipais_<?= $weipai->w_sort?>.html"><?= getShortTitle($weipai->w_title, 28)?></a></li>
            <?php endforeach;?>
            </ul>
        </div>
    </div>
    <?php
    foreach($main_sidebar as $sidebar_item):
        echo '<div class="sidebar-widget">';
        echo '<p class="sidebar-headline">'.$sidebar_item->title.'</p>';
        echo '<div class="textwidget">';
        echo eval('?>' .$sidebar_item->body. '<?php ');
        echo '</div></div>';
    endforeach;
    ?>

    <div class="sidebar-widget">
        <p class="sidebar-headline">最新资讯</p>
        <div class="textwidget">
            <ul>
            <?php foreach ($news as $key => $new):?>
                <li><a href="/articles/view/<?= $new->id?>/<?= $new->art_url_alias?>.html"><?= getShortTitle($new->art_title, 18)?></a></li>
            <?php endforeach;?>
            </ul>
        </div>
    </div>
</aside> 