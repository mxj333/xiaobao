<div class="table-responsive">
    <table class="table table-hover ">
        <thead>
            <tr>
                <th><?= __('章节') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($catalogs as $catalog): ?>
            <tr>
                <td>
                    <?= $this->Html->link(h($catalog->name), ['action' => 'view', $catalog->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
