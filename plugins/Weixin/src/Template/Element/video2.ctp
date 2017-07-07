<?php
    echo $this->Html->script('ckplayer');
?>
<div id="a1"></div>
<script type="text/javascript">
    var flashvars={
        p:0,
        e:1,
        hl:'<?= $articles->art_video ?>',
        ht:'20',
        hr:'http://www.ckplayer.com'
        };
    var video=['<?= $articles->art_video?>->video/mp4','http://www.ckplayer.com/webm/0.webm->video/webm','http://www.ckplayer.com/webm/0.ogv->video/ogg'];
    var support=['all'];
    CKobject.embedHTML5('a1','ckplayer_a1',658,420,video,flashvars,support);
</script>