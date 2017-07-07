<?php foreach ($subjects as $subject): ?>
<div class="weui-cells__title">试题类型: <?= getSubjectType($subject->type) ?></div>
<div class="weui-cells__title">试题答案: <?= strtoupper($subject->answer) ?></div>
<div class="weui-cells__title desc">试题描述: <?= h($subject->title) ?></div>
<div class="weui-cells weui-cells_radio">
    <?php
        $option = explode('###', $subject->body);
        foreach($option as $opt):
    ?>
    <label class="weui-cell weui-check__label" for="x12">
        <div class="weui-cell__bd">
            <p><?= $opt?></p>
        </div>
    </label>
    <?php endforeach;?>
</div>
<?php endforeach; ?>
<?php
    $this->Paginator->templates([
        'nextActive' => '<a class="su" rel="next" href="{{url}}">{{text}}</a>',
        'nextDisabled' => '',
        'prevActive' => '<a class="su" rel="prev" href="{{url}}">{{text}}</a>',
        'prevDisabled' =>'',//'<a class="prev disabled su" href="" onclick="return false;">{{text}}</a>',
        // 'number' => '<a class="su" href="{{url}}">{{text}}</a>',
        'current' => '<a class="su active" href="">{{text}}</a>',
    ]);
    echo '<div class="bigpage">';
    echo $this->Paginator->prev(__('上一题'), array(), null, array('class'=>'off'));
    // echo $this->Paginator->numbers(array('tag' => 'div','separator' => '……'));
    echo $this->Paginator->next(__('下一题'), array(), array(), array('class' => 'off'));
    echo '</div>';
?>
<script>
    $(function() {
        $(document).on('click', '#pagination-container a', function () {
            var thisHref = $(this).attr('href');
            if (!thisHref) {
                return false;
            }
            $('#pagination-container').fadeTo(300, 0);

            $('#pagination-container').load(thisHref, function() {
                $(this).fadeTo(200, 1);
            });
            return false;
        });
    });
</script>
