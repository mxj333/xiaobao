<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $description = C('WEB_DESCRIPTION');
            $title = C('WEB_SITENAME');

            if($this->request->action == 'view' ){
                if($this->request->controller == 'Articles') {
                    $description = getShortTitle($articles->art_body, 200);
                    $title = $articles->art_title;
                }
            }
        ?>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
            <title><?= $title?></title>
            <!-- 引入 WeUI -->
            <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.1/weui.min.css"/>
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css(['font-awesome.min','style']);
            echo $this->Html->script('jquery');

            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
        ?>
    </head>
    <body>
        <!-- 使用 -->
        <div class="page">
            <?php echo $this->fetch('content'); ?>

            <div class="page__bd dibu" style="">
                <div class="weui-tab">
                    <div class="weui-tab__panel">
                    </div>
                    <div class="weui-tabbar">
                        <a href="/ucenter/index" class="weui-tabbar__item weui-bar__item_on">
                            <?=$this->Html->image("icon_tabbar.png", ['class' => 'weui-tabbar__icon'])?>
                            <p class="weui-tabbar__label">主页</p>
                        </a>
                        <a href="javascript:;" class="weui-tabbar__item">
                            <?=$this->Html->image("icon_tabbar.png", ['class' => 'weui-tabbar__icon'])?>
                            <p class="weui-tabbar__label">保险超市</p>
                        </a>
                        <a href="/ucenter/exams" class="weui-tabbar__item">
                            <?=$this->Html->image("icon_tabbar.png", ['class' => 'weui-tabbar__icon'])?>
                            <p class="weui-tabbar__label">分红考试</p>
                        </a>
                        <a href="/ucenter/users/index/<?=$user['id']?>" class="weui-tabbar__item">
                            <?=$this->Html->image("icon_tabbar.png", ['class' => 'weui-tabbar__icon'])?>
                            <p class="weui-tabbar__label">我的</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://use.fontawesome.com/fce38ab148.js"></script>
    </body>
</html>
