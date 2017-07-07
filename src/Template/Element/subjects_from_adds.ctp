<div class="scaffold-action scaffold-action-add scaffold-controller-columns scaffold-columns-add">
    <?= $this->Form->create($subject) ?>
    <div class="row">
        <legend><?= __('Adds Subjects') ?></legend>
        <?php
            echo $this->Form->input('catalog_id', ['options' => $catalogs, 'empty' => false, 'default'=> $select_catalog_id, 'label' => __('所属目录')]);
            echo $this->Form->input('body', ['rows' => '5', 'cols' => '80', 'label' => __('内容')]);

        ?>
        <br/>
    </div>
    <div class="row">
        <div class="col-lg-<?= $this->exists('form.sidebar') ? '8' : '12' ?>">
           <div class="form-group">
                <div class="col pull-right">
                    <?php
                        echo $this->Form->button(__d('crud', 'Save'), ['class' => 'btn btn-primary', 'name' => '_save']);

                        //echo $this->Form->button(__d('crud', 'Save & create new'), ['class' => 'btn btn-success', 'name' => '_add', 'value' => true]);
                        
                        echo $this->Html->link(__d('crud', 'Back'), ['action' => 'index'], ['class' => 'btn btn-default', 'role' => 'button', 'value' => true]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->script(['jquery.min']) ?>
<script type="text/javascript">
$(function(){

})
</script>