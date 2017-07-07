<div class="jumbotron text-center">
    <h3>请认真完成测试题！</h3>
    <p class="lead">准备好了吗？</p>
    <p>
        <button type="button" id="start" class="btn btn-lg btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">开始考试</button>
    </p>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">正在生成试卷...</h4>
            </div>
            <!--<div class="modal-body">
                正在生成试卷...
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<?= $this->Html->script(array('sqlite'));?>
<script>
    $('.modal').modal({
        show:false, //默认不显示
        backdrop: false, //取消点击背景处弹框消失
        keyboard:false
    });
$(function () {
    $('#start').on('click', function () {
        var db = new lanxDB('xiaobao');
        //删除表
        db.switchTable('subjects').dropTable();
        //初始化数据库，创建表
        db.init('subjects', [
            {name : 'id', type : 'integer primary key autoincrement'},
            {name : 'type', type : 'integer'},
            {name : 'title', type : 'text'},
            {name : 'body', type : 'text'},
            {name : 'answer', type : 'text'},
            {name : 'done', type : 'text'}
        ]);
        $.ajax({
            url: '/home/gene',
            method: 'post',
            data: '',
            dataType: 'json',
            success: function(json) {                
                if(json.subjects.length > 0) {
                    var data = [];
                    for (var i = 0; i < json.subjects.length; i++) {
                        json.subjects[i].done = '';
                        data.push(json.subjects[i])
                    }; 
                    //选择表并插入数据                    
                    db.switchTable('subjects').insertData(data, function(result){
                        if (result) {
                            location.href = '/home/exam';
                        }
                    });
                }
            }     
        });
    });
});
</script>
