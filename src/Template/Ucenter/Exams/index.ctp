<div class="col-md-12">
    <div class="jumbotron text-center">
        <h3>请认真完成考试！</h3>
        <p class="lead">准备好了吗？</p>
        <p>
            <button type="button" id="start" class="btn btn-lg btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">开始考试</button>
        </p>
    </div>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
        <div class="modal-dialog modal-sm">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel"><i class="fa fa-spinner fa-pulse  fa-fw"></i>请稍候，正在生成试卷...</h4>
                </div>
                <!-- <div class="modal-body">
                    <i class="fa fa-spinner fa-pulse  fa-fw"></i> 正在生成试卷...
                </div> --> 
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
    <?= $this->Html->script(array('ucenter/sqlite', 'ucenter/public', 'ucenter/historys'));?>
</div>
<script>
    $('.modal').modal({
        show:false, //默认不显示
        backdrop: false, //取消点击背景处弹框消失
        keyboard:false
    });
    
$(function () {
    // var request=window.indexedDB.open('xiaobao');
    $('#start').on('click', function () {
        var db = new lanxDB('xiaobao');

        //把上次的考试成绩写入历史表中
        setHistorys();
        // return false;

        //删除表
        db.switchTable('subjects').dropTable();

        //初始化数据库，创建表
        db.init('subjects', [
            {name : 'id', type : 'integer primary key autoincrement'},
            {name : 'user_id', type : 'integer'},
            {name : 'catalog_id', type : 'integer'},
            {name : 'subject_id', type : 'integer'},
            {name : 'type', type : 'integer'},
            {name : 'title', type : 'text'},
            {name : 'body', type : 'text'},
            {name : 'answer', type : 'text'},
            {name : 'done', type : 'text'},
            {name : 'exam_date', type : 'integer'}
        ]);
        $.ajax({
            url: '/ucenter/exams/gene',
            method: 'post',
            data: '',
            dataType: 'json',
            success: function(json) {

                //VIP已到期
                if(json.status == 9) {
                    $("#mySmallModalLabel").text(json.info);
                    setTimeout(function() {
                        location.href = '/ucenter/vips';
                    }, 2000);
                    return false;
                }

                if(json.subjects.length > 0) {
                    var data = [];
                    for (var i = 0; i < json.subjects.length; i++) {
                        json.subjects[i].done = '';
                        data.push(json.subjects[i])
                    };

                    //选择表并插入数据
                    db.switchTable('subjects').insertData(data, function(result){

                        if (result) {
                            location.href = '/ucenter/exams/start/'+ json.exam_time_end;
                        }
                    });
                }
            }     
        });
    });
});
</script>