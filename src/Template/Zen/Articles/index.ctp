<div class="scaffold-action scaffold-action-index scaffold-controller-columns scaffold-columns-index">
    <h2>Articles</h2>
    <div class="actions-wrapper">
        <a class="btn btn-default" href="/zen/articles/add">Add</a>
        <?php echo $this->Form->input('column_id', ['options' => $columns, 'value' => $column_id, 'label' => '栏目']);?>
    </div>
<hr>
<?=$this->element('articles_zen');?>
<?=$this->element('index/pagination');?>
</div>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
    $('#column-id').change(function(){
        var column_id = $(this).children('option:selected').val();
        window.location.href="/zen/articles/index/" + column_id;
    });
});
</script>