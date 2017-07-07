<div class="weui-flex">
    <div class="weui-flex__item">
        <div class="placeholder">
            <?=$this->Html->image("tmp/f30de17.jpg")?>
        </div>
    </div>
</div>
<div class="weui-flex">
    <div class="site-dt"><div class="placeholder ">精彩呈现</div></div>
    <div class="weui-flex__item renav">
        <ul style="margin-top: 0px;">
            <li> 尊敬的客户，欢迎使用销保网</li>
            <li> 瑞声达瑞声达</li>
            <li> 瑞声达瑞声达sadfasdf</li>
        </ul>
    </div>
</div>
<div class="weui-grids">
    <a href="Catalogs" class="weui-grid">
        <div class="weui-grid__icon">
            <?=$this->Html->image("icon_1.png")?>
        </div>
        <p class="weui-grid__label">
            章节练习
        </p>
    </a>
    <a href="exams" class="weui-grid">
        <div class="weui-grid__icon">
            <?=$this->Html->image("icon_2.png")?>
        </div>
        <p class="weui-grid__label">
            分红考试
        </p>
    </a>
    <a href="javascript:alert('敬请期待');" class="weui-grid">
        <div class="weui-grid__icon">
            <?=$this->Html->image("icon_3.png")?>
        </div>
        <p class="weui-grid__label">微课堂</p>
    </a>
    <a href="javascript:alert('敬请期待');" class="weui-grid">
        <div class="weui-grid__icon">
            <?=$this->Html->image("icon_4.png")?>
        </div>
        <p class="weui-grid__label">精选产品</p>
    </a>
    <a href="javascript:alert('敬请期待');" class="weui-grid">
        <div class="weui-grid__icon">
            <?=$this->Html->image("icon_5.png")?>
        </div>
        <p class="weui-grid__label">
            我的微店
        </p>
    </a>
    <a href="javascript:alert('敬请期待');" class="weui-grid">
        <div class="weui-grid__icon">
            <?=$this->Html->image("icon_6.png")?>
        </div>
        <p class="weui-grid__label">
            我的团队
        </p>
    </a>
    <a href="javascript:alert('敬请期待');" class="weui-grid">
        <div class="weui-grid__icon">
            <?=$this->Html->image("icon_7.png")?>
        </div>
        <p class="weui-grid__label">
            计划书
        </p>
    </a>
    <a href="javascript:alert('敬请期待');" class="weui-grid">
        <div class="weui-grid__icon">
            <?=$this->Html->image("icon_8.png")?>
        </div>
        <p class="weui-grid__label">
            产品对比
        </p>
    </a>
    <a href="javascript:alert('敬请期待');" class="weui-grid">
        <div class="weui-grid__icon">
            <?=$this->Html->image("icon_tabbar.png")?>
        </div>
        <p class="weui-grid__label">邀请好友</p>
    </a>
</div>

<div class="weui-flex">
    <div class="site-dt"><div class="placeholder ">推荐产品</div></div>
</div>
<div class="ads">
    <div class="weui-flex">
        <div class="weui-flex__item">
            <div class="placeholder"><?=$this->Html->image("tmp/atool.png")?></div>
            <div class="placeholder pro-info">
                   <div class="pro-name">
                       <p>短途及周边游意外险</p>
                       <p>专为短途及周边游定制<br>最贴心周全的保障</p>
                       <div class="pro-point"><span class="point-dm">￥5元</span>起</div>
                   </div>
            </div>
        </div>
        <div class="weui-flex__item">
            <div class="placeholder"><?=$this->Html->image("tmp/010ada2.png")?></div>
            <div class="placeholder pro-info">
                   <div class="pro-name">
                       <p>孩之宝儿童综合保险</p>
                       <p>11种综合保障<br>最高71万保额</p>
                       <div class="pro-point"><span class="point-dm">￥98元</span>起</div>
                   </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        var $this = $(".renav");
        var scrollTimer;
        $this.hover(function(){
            clearInterval(scrollTimer);
        },function(){
            scrollTimer = setInterval(function(){
                scrollNews( $this );
            }, 2000 );
        }).trigger("mouseout");
    });

    function scrollNews(obj){
        var $self = obj.find("ul:first");
        var lineHeight = $self.find("li:first").height();
        $self.animate({ "margin-top" : -lineHeight +"px" },600 , function(){
            $self.css({"margin-top":"0px"}).find("li:first").appendTo($self);
        })
    }
</script>
