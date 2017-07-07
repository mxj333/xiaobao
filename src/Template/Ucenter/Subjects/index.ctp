<div class="row">
    <div class="col-lg-12">
        <div class="">
            <h4> </h4>
            <table class="table table-bordered">
                <tbody>
                    <?php foreach ($subjects as $subject): ?>
                    <tr>
                        <td>试题类型: <?= getSubjectType($subject->type) ?></td>
                    </tr>
                    <tr>
                        <td>试题答案: <?= strtoupper($subject->answer) ?></td>
                    </tr>
                    <tr>
                        <td>试题描述: <?= h($subject->title) ?></td>
                    </tr>
                    <tr>

                        <td>
                            <?= str_replace('###', '<br/>', $subject->body)?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pager paging" >
                    <?= $this->Paginator->prev('< ' . __('上一题')) ?>
                    <?= $this->Paginator->next(__('下一题') . ' >') ?>
                </ul>
            </div>
        </div>
    </div>
</div>
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