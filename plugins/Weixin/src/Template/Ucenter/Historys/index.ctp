<h3><?= __('Historys') ?></h3>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th> 序号</th>
            <th> 考试时间</th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($historys as $key => $history): ?>
        <tr>
            <td><?= $this->Number->format($key+1) ?></td>

            <td><?= date('Y-m-d H:i:s', $history->exam_date)?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $history->id]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->element('paging_links');?>
