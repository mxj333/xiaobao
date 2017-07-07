<div class="row">
    <div class="panel panel-default">
        <!-- <div class="panel-heading">

        <h3 class="panel-title">
            <button class="btn btn-primary" type="button">
              您的分数 <span class="badge">4</span>
            </button>
        您的分数:<span class="label">60</span>
        </h3></div> -->
        <div class="panel-body">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation" class="active"><a href="javascript:void(0);">您的分数 <span class="badge">100</span></a></li> 
                <li role="presentation"><a href="javascript:void(0);">单选题 <span class="badge">35</span></a></li> 
                <li role="presentation"><a href="javascript:void(0);">多选题 <span class="badge">55</span></a></li> 
                <li role="presentation"><a href="javascript:void(0);">判断题 <span class="badge">10</span></a></li>
            </ul>
        </div>
    </div>
    <h3 class="text-center">查看答案</h3>
    <div id="list">
    </div>    
</div>
<footer class="footer">
    <div class="container">
        <nav>
            <ul class="pager">
                
            </ul>
        </nav>
    </div>
</footer>


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

<?= $this->Html->script(array('sqlite'));?>
<script type="text/javascript">
    var db = new lanxDB('xiaobao');
    var score0 = 0, score1 = 0, score2 = 0, score3 = 0;
    $(function() {        
        // $('.modal').modal('show');
        db.switchTable('subjects').getData(function(result) {
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
                strs = result[n].body.split("###"); //字符分割                           
                for (i=0; i < strs.length; i++ ) { 
                    option += '<li class="list-group-item">';
                    option += strs[i];
                    option += '</li>';
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
            $('.nav .badge:first').html(score0);
            $('.nav .badge:eq(1)').html(score1);
            $('.nav .badge:eq(2)').html(score2);
            $('.nav .badge:eq(3)').html(score3);
        });
    })
</script>