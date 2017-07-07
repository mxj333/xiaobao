<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <?php
        $description = C('WEB_DESCRIPTION');
        $title = C('WEB_SITENAME');

        if($this->request->action == 'view' ){
            if($this->request->controller == 'Articles') {
                $description = getShortTitle($articles->art_body, 200);
                $title = $articles->art_title;
            }

            if($this->request->controller == 'Weipais') {
                $description = C('WEB_DESCRIPTION') . $weipaiDetails['weipai']['w_title'];
                $title = '北京德泉缘' . C('WEB_SITENAME'). $weipaiDetails['weipai']['w_title'];
            }
        }
    ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ZenCMS.cn">
    <meta name="description" content="<?= $description?>">
    <title><?= $title?></title>
<?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('style');
    echo $this->Html->css('default');
    echo $this->Html->css('standard');

    echo $this->Html->script('jquery');
    echo $this->Html->script('jquery-migrate.min');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
?>
<style type="text/css">
.papercuts_map_canvas img {max-width: none;}
</style>
</head>
<body class="home blog" id="wrapper">
    <header id="wrapper-header">  
        <div id="header">
            <div class="header-content-wrapper">
                <div class="header-content">
                    <?= $this->Html->image('logo.png', ['height' => '50', 'alt' => C('WEB_DESCRIPTION')])?>
                    <p class="site-title"><a href="/"><?= C('WEB_SITENAME')?></a></p>
                    <p class="site-description"><?= C('WEB_DESCRIPTION');?></p>
                    <div class="searchform-wrapper">
                        <span class="cont_pic"></span><?= C('SERVICE_TELEPHONE')?>
                    </div>
                </div>
            </div>
            <div class="menu-box-wrapper">
                <div class="menu-box">
                    <div class="menu-testing-menu-container">
                        <ul id="nav" class="menu">
                            <?php foreach($navigations as $nav_item): ?>
                                <li><a class="current-menu-item <?php if($activeNav == $nav_item->id) echo ' on' ?>" href="<?php echo eval("?>".$nav_item->url."");?>"<?php if(!empty($nav_item->target)) { echo ' target="'.$nav_item->target.'"'; } ?>><?php echo  $nav_item->title;?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
      </div>
    </header>
    <div id="container">
        <div id="main-content">
            <div id="content">
                <?php echo $this->fetch('content'); ?>  
            </div>
        <?php
            if(intval(C('IS_SIDEBAR'))) {
                echo $this->element('sidebar');
            }
        ?>
    </div>
</div>
    <footer id="wrapper-footer">
        <div class="footer-signature">
            <div class="footer-signature-content">
                <div class="textwidget">
                    <p><?= C('COPYRIGHT')?><br/>
                    地址：<?= C('COMPANY_ADDRESS')?></p>
                </div>
            </div>
        </div>
    </footer>
    <?= $this->Html->script(['selectnav', 'responsive']);?>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?ce4f9d45965055bf0d35894076165d91";
        var s = document.getElementsByTagName("script")[0]; 
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<script>
    //第二个域名 dequanyuan.com.cn
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?97c01f2bb4d3b27707d62111cbf7bd94";
        var s = document.getElementsByTagName("script")[0]; 
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</html>
