    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-fire" aria-hidden="true"></i> 您的成绩 <span class="score">99</span> 分
                <!-- <button class="btn btn-primary" type="button">
                  您的成绩 <span class="badge"></span>
                </button> -->
            </h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation"> <a href="javascript:void(0);">单选题 <span class="badge"> </span></a></li> 
                <li role="presentation"> <a href="javascript:void(0);">多选题 <span class="badge"> </span></a></li> 
                <li role="presentation"> <a href="javascript:void(0);">判断题 <span class="badge"> </span></a></li>
            </ul>
        </div>
    </div>
    <h3 class="text-center"></h3>
    <div id="list">
    </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?= $this->Html->script(array('ucenter/sqlite'));?>
<script type="text/javascript">

    var db = new lanxDB('xiaobao');
    var score0 = 0, score1 = 0, score2 = 0, score3 = 0;
    $(function() {
        // $('.modal').modal('show');
        db.switchTable('subjects').getData(function(result) {
            
            //把考试成绩写入临时文件中，便于有网络时更新到服务器
            console.log(result);

            for (var n = 0; n < result.length; n++) {
                var option = '<ul class="list-group"><li class="list-group-item list-group-item-info title">';
                option += result[n].id + '、' + result[n].title;
                if (result[n].done == result[n].answer) {
                    option += ' <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> </li>';
                    score0 ++;
                    if (result[n].type === 1) {
                        score1 ++;
                    } else if (result[n].type === 2) {
                        score2 ++;
                    } else {
                        score3 ++;
                    }
                } else{
                    option += ' <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </li>';
                }

                var strs = new Array(); //定义一数组 
                if (result[n].type != 3) {
                    strs = result[n].body.split("###"); //字符分割
                    for (i=0; i < strs.length; i++ ) { 
                        option += '<li class="list-group-item">';
                        option += strs[i];
                        option += '</li>';
                    }
                }
                var done = '';
                if (result[n].done == 0 ) {
                    done += ' <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ';
                } else if (result[n].done == 1) {
                    done += ' <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ';
                } else {
                    done += result[n].done;
                }
                var answer = '';
                if (result[n].answer == 0 ) {
                    answer += ' <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ';
                } else if (result[n].answer == 1) {
                    answer += ' <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ';
                } else {
                    answer += result[n].answer;
                }
                option += '<li class="list-group-item list-group-item-warning">你的选择是：' + done + ' ；正确答案：' + answer + ' </li>';
                option += '</ul>';
                $('#list').append(option);
            };
            // $('.nav .badge:first').html(score0);
            $('.panel-title .score').html(score0);
            $('.nav .badge:eq(0)').html(score1);
            $('.nav .badge:eq(1)').html(score2);
            $('.nav .badge:eq(2)').html(score3);
        });
    })
</script>