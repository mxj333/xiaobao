<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id', ['label' => 'ID']) ?></th>
                <th><?= $this->Paginator->sort('column_id', ['label' => '栏目']) ?></th>
                <th><?= $this->Paginator->sort('art_title', ['label' => '标题']) ?></th>
                <th><?= $this->Paginator->sort('art_title', ['label' => '来源']) ?></th>
                <th><?= $this->Paginator->sort('art_status', ['label' => '状态']) ?></th>
                <th><?= $this->Paginator->sort('created', ['label' => '时间']) ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $this->Number->format($article->id) ?></td>
                <td><?= $columns->toArray()[$article->column_id] ?></td>
                <td><a href="/articles/view/<?= $article->id?>/<?= $article->art_url_alias?>.html" target="_blank" ><?= h($article->art_title) ?></a></td>
                <td><?= h($article->art_source) ?></td>
                <td><?= h($art_status[$article->art_status]) ?></td>
                <td><?= h($article->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $article->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles','action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete?', $article->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>