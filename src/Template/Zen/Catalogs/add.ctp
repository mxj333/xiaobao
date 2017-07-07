<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Catalogs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parent Catalogs'), ['controller' => 'Catalogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Catalog'), ['controller' => 'Catalogs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="catalogs form large-9 medium-8 columns content">
    <?= $this->Form->create($catalog) ?>
    <fieldset>
        <legend><?= __('Add Catalog') ?></legend>
        <?php
            echo $this->Form->input('parent_id', ['options' => $parentCatalogs, 'empty' => '(choose one)']);
            // echo $this->Form->input('lft');
            // echo $this->Form->input('rght');
            echo $this->Form->input('name', ['rows' => '3']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
