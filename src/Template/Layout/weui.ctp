<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="ZenCMS">
    <title>
        <?= C('WEB_SITENAME') ?>
        <?php //$this->fetch('title') ?>
    </title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
</head>
<body>
    <div class="page">
        <?= $this->fetch('content') ?>
    </div>
    <div class="weui-msg__extra-area">
            <div class="weui-footer">
                <!-- <p class="weui-footer__links">
                    <a href="javascript:void(0);" class="weui-footer__link">底部链接文本</a>
                </p> -->
                <p class="weui-footer__text"><?= C('COPYRIGHT');?></p>
            </div>
        </div>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
</body>
</html>

