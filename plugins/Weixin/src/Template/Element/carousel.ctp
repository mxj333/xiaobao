<div id="slideshow-wrapper">
    <div tabindex="0" class="cycloneslider cycloneslider-template-standard cycloneslider-width-responsive" id="cycloneslider-testing-1" style="max-width:658px" >
        <div class="cycloneslider-slides cycle-slideshow" data-cycle-allow-wrap="true" data-cycle-dynamic-height="off" data-cycle-auto-height="658:300" data-cycle-auto-height-easing="null" data-cycle-auto-height-speed="250" data-cycle-delay="0" data-cycle-easing="" data-cycle-fx="fade" data-cycle-hide-non-active="true" data-cycle-log="false" data-cycle-next="#cycloneslider-testing-1 .cycloneslider-next" data-cycle-pager="#cycloneslider-testing-1 .cycloneslider-pager" data-cycle-pause-on-hover="true" data-cycle-prev="#cycloneslider-testing-1 .cycloneslider-prev" data-cycle-slides="&gt; div" data-cycle-speed="1000" data-cycle-swipe="false">
        <?php foreach ($adverts as $adv) { ?>
            <?php 
            echo '<div class="cycloneslider-slide cycloneslider-slide-image" ><a href="'. $adv['adv_url'] .'" target="_black" title="'. $adv['adv_title'] .'"><img src="'. $adv['adv_img'] .'" alt="'. $adv['adv_title'] .'" width="658"></div>';?>
        <?php } ?>
        </div>
        <div class="cycloneslider-pager"></div> 
        <a href="#" class="cycloneslider-prev"> <span class="arrow"></span> </a>
        <a href="#" class="cycloneslider-next"> <span class="arrow"></span> </a>
    </div>
</div>