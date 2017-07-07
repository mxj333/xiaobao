<style type="text/css">
    .player {
        margin-bottom: 20px;
        width: 100%;
    }
</style>
<?php
    if(!is_mobile()){
        echo $this->Html->script('ckplayer');
?>

<div class="player">
    <div id="a1"></div>
</div>
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
    CKobject.embedHTML5('a1','ckplayer_a1','100%','100%',video,flashvars,support);

    
    //加载时适应浏览器高度
    $(document).ready(function() {
        //模块尺寸
            $('#a1').css('height', $(window).height());
    });

    //改变窗体大小时适应浏览器高度
    $(window).resize(function() {
        //模块尺寸
            $('#a1').css('height', $(window).height());
    });
</script>
<?php } else { ?>
<div class="player">
    <video id="video" width="100%" src="<?= $articles->art_video ?>"  controls autoplay waiting > </video>
</div>
<script type="text/javascript">
    // myVid=document.getElementById("video");
    // myVid.currentTime=5;

    setTimeout(function(){
        video.pause();
    }, 700);
</script>
<?php } ?>