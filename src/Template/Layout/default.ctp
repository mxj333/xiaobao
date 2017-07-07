<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php
            if($this->request->action == 'view' && $this->request->controller == 'Articles') {
                $description = getShortTitle($articles->art_body, 200);
                $title = $articles->art_title;
            } else {
                $description = Configure::read('WEB_DESCRIPTION');
                $title = Configure::read('WEB_SITENAME');
            }
        ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="ZenCMS.cn">
        <meta name="description" content="<?= $description?>">
        <title><?= $title?></title>
        <!-- Bootstrap core CSS -->
        <?= $this->Html->css(['bootstrap', 'home']) ?>
        <link rel="stylesheet" href="/font-awesome/css/font-awesome.css"/>
        <?= $this->Html->script(['jquery', 'bootstrap.min']) ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="/js/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
<body>
    <div class="container">
        <?php 
            echo $this->element('navbar-fixed-bottom');
        ?>
        <div class="row">
            <?= $this->fetch('content') ?>
        </div>

        <footer class="footer">
            <p><?php echo C('COPYRIGHT');?></p>
        </footer>
    </div> <!-- /container -->
<?= $this->element('login_modal');?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?438b3f6acf72eda38bb3c34f0b3253f5";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>

  </body>
</html>
