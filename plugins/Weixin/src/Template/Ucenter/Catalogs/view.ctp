<div class="weui-cells__title"><?= h($catalog->name) ?></div>
<div class="weui-cells">
    <?php if (!empty($catalog->child_catalogs)): ?>
    <?php foreach ($catalog->child_catalogs as $childCatalogs): ?>
        <?php
            if ($childCatalogs->parent_id && in_array($catalog->parent_id, [1,2,3])) {
                // echo $this->Html->link(h($childCatalogs->name), ['controller' => 'Subjects', 'action' => 'index', $childCatalogs->id]);
                $url = '/ucenter/Subjects/index/'. $childCatalogs->id;
            } else {
                // echo $this->Html->link(h($childCatalogs->name), ['controller' => 'Catalogs', 'action' => 'view', $childCatalogs->id]);
                $url = '/ucenter/catalogs/view/'. $childCatalogs->id;
            }

        ?>
    <a class="weui-cell weui-cell_access" href="<?= $url?>">
        <div class="weui-cell__bd">
            <p><?= h($childCatalogs->name)?></p>
        </div>
        <div class="weui-cell__ft">
        </div>
    </a>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
