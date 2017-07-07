<!-- <div class="col-lg-12">
    <div class="form-group">
        <div class="col pull-right">
        <button class="btn btn-default back" name="_save" type="submit">Back</button>
        </div>
    </div>
</div> -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($catalog->name) ?></h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <!-- <h4><?= h($catalog->name) ?></h4> -->
            <!-- <div class="related">  -->
                <?php if (!empty($catalog->child_catalogs)): ?>
                <table class="table ">
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
            <!-- </div> -->
        </div>
    </div>
    <!-- <div class="panel-footer">Panel footer</div> -->
</div>


