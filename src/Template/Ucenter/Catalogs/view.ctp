<div class="table-responsive">
    <h4><?= h($catalog->name) ?></h4>
    <div class="related"> 
        <?php if (!empty($catalog->child_catalogs)): ?>
        <table class="table table-hover ">
            <?php foreach ($catalog->child_catalogs as $childCatalogs): ?>
            <tr>
                <td>
                    <?php
                        if ($childCatalogs->parent_id && in_array($catalog->parent_id, [1,2,3])) {
                            echo $this->Html->link(h($childCatalogs->name), ['controller' => 'Subjects', 'action' => 'index', $childCatalogs->id]);
                        } else {
                            echo $this->Html->link(h($childCatalogs->name), ['controller' => 'Catalogs', 'action' => 'view', $childCatalogs->id]);
                        }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <!-- <div class="related">
        <?php if (!empty($catalog->subjects)): ?>
        <table class="table table-hover ">
            <tr>
                <th><?= __('Type') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Body') ?></th>
                <th><?= __('Answer') ?></th>
            </tr>
            <?php foreach ($catalog->subjects as $subjects): ?>
            <tr>
                <td><?= h($subjects->type) ?></td>
                <td><?= h($subjects->title) ?></td>
                <td><?= h($subjects->body) ?></td>
                <td><?= h($subjects->answer) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div> -->
</div>
