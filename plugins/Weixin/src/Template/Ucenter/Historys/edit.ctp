<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $history->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $history->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Historys'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Catalogs'), ['controller' => 'Catalogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Catalog'), ['controller' => 'Catalogs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="historys form large-9 medium-8 columns content">
    <?= $this->Form->create($history) ?>
    <fieldset>
        <legend><?= __('Edit History') ?></legend>
        <?php
            echo $this->Form->input('catalog_id', ['options' => $catalogs, 'empty' => true]);
            echo $this->Form->input('type');
            echo $this->Form->input('title');
            echo $this->Form->input('body');
            echo $this->Form->input('answer');
            echo $this->Form->input('status');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
