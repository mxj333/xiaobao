<div class="scaffold-action scaffold-action-index scaffold-controller-columns scaffold-columns-index">
    <h2><?= __('Users') ?></h2>
    <div class="actions-wrapper">
        <a href="/zen/users/add" class="btn btn-default">Add</a>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>序号</th>
                    <th><?= $this->Paginator->sort('username', ['label' => '用户名']) ?></th>
                    <th><?= $this->Paginator->sort('surname', ['label' => '姓名']) ?></th>
                    <th><?= $this->Paginator->sort('group_id', ['label' => '用户组']) ?></th>
                    <th><?= $this->Paginator->sort('u_start', ['label' => '开始时间']) ?></th>
                    <th><?= $this->Paginator->sort('u_end', ['label' => '结束时间']) ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 1; foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($n) ?></td>
                    <td><?= h($user->username) ?></td>
                    <td><?= h($user->surname) ?></td>
                    <td><?= $user->has('group') ? $this->Html->link($user->group->name, ['controller' => 'Groups', 'action' => 'view', $user->group->id]) : '' ?></td>
                    <td><?= h(date('Y-m-d H:i', $user->u_start)) ?></td>
                    <td><?= h(date('Y-m-d H:i', $user->u_end)) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    </td>
                </tr>
                <?php $n++;endforeach; ?>
            </tbody>
        </table>
    </div>
    <?=$this->element('paging_links');?>
</div>