<div class="content_wrap">
    <?php 
        //echo $this->element('tree'); 
    ?>
</div>
<div class="table-responsive">
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>标题</th>
            <th>发布时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody id=listData>
        <?php foreach($articles as $key => $list) {?>
        <tr>
            <td><?=$list['id']?></td>
            <td><?=$list['title']?></td>
            <td>ipsum</td>
            <td>dolor</td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="paginator">
    <?php echo $this->element('paging_links');  ?>
</div>
<!-- <div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div> -->
</div>