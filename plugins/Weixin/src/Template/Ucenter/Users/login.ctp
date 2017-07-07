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
            <div class="page__hd">
                <h3 class="page__title">销保网欢迎您</h>
                <?= $this->Flash->render('auth') ?>
            </div>
            <div class="page__bd" style="">
                <?= $this->Form->create() ?>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell weui-cell_select weui-cell_select-before">
                            <div class="weui-cell__hd">
                                <select class="weui-select" name="select2">
                                    <option value="1">+86</option>
                                    <!-- <option value="2">+80</option>
                                    <option value="3">+84</option>
                                    <option value="4">+87</option> -->
                                </select>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="username" type="number" pattern="[0-9]*" placeholder="请输入号码"/>
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label for="" class="weui-label">密码</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="password" name="password" placeholder="请输入密码">
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <button class="weui-btn weui-btn_primary" type="submit">登录</button>
                    </div>
                <!-- </form> -->
                <?= $this->Form->end() ?>
                <div class="page__ft">
                    <a href="/ucenter/users/wxlogin"><?=$this->Html->image("icon32_wx_button.png")?></a>
                </div>
            </div>
        </div>
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          
        });
    </script>
        <script src="https://use.fontawesome.com/fce38ab148.js"></script>
    </body>
</html>