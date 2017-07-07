<div id="subjects">
    <div class="col-lg-12">
        <h4></h4>
    </div>
    <div class="col-lg-12" id="content"></div>
</div><!-- /.row -->

<!-- <footer class="footer"> -->
    <div class="container">
        <nav>
            <ul class="pager">
                <li class="previous"><a href="javascript:void(0);" id-data='-1'>上一题</a></li>
                <li><span id="CountMsg"></span></li>
                <li class="next"><a href="javascript:void(0);" id-data='1'>下一题</a></li>
            </ul>
        </nav>
    </div>
<!-- </footer> -->
<input type="hidden" name="exam_time_end" value="<?= $exam_time_end?>" >

<!-- 提示信息 -->
<div id="mymodal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h3 class="modal-title" id="mySmallModalLabel">请选择一个答案！</h3>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?= $this->Html->script(array('ucenter/sqlite', 'ucenter/public', 'jquery.countdown.min', 'ucenter/subjects'));?>
<script type="text/javascript">
    var db = new lanxDB('xiaobao');
    var data = [];
    // return false;
    var startTime = '';
    $(function() {
        $('footer .navbar-fixed-bottom').hide();
        db.switchTable('subjects').getData(function(result){
            data = result;
            //第一题题目
            subject(data, 0);
            $('.previous').addClass('hide');
            $('.next a').attr('id-data', data[0].id);
        });

        //下一题
        $('.pager .next').on('click', function() {
            // var v = $("input[name=done]:checked").val();
            $('.previous').removeClass('hide');

            //选择答案
            var v = '';
            $("input[name=done]:checked").each(function(){
                v += $(this).val();
            });

            //是否有选择答案
            if (v == '') {
                $('#mymodal').modal('show');
                return false;
            };

            //保存答案
            db.where({id: parseInt($('.next a').attr('id-data'))}).saveData({done: $.trim(v)});

            //最后一道时显示为交卷
            var p = parseInt($('.next a').attr('id-data'));
            if (data.length == p + 1) {
                $('.next a').text('交卷');
            }

            if (data.length > p) {

                // subject(data, p);
                db.switchTable('subjects').where({id: parseInt(p+1)}).getData(function(result){
                    data2 = result;
                    //下一题
                    subject(data2, 0);
                });

                $('.previous a').attr('id-data', parseInt(data[p].id) - 1);
                $('.next a').attr('id-data', data[p].id);
            } else {
                location.href = '/ucenter/exams/done';
                // console.log(data);
            }
        });

        //上一题
        $('.pager .previous').on('click', function() {
            var page = parseInt($('.previous a').attr('id-data'));
            var p = page - 1;

            db.switchTable('subjects').where({id: parseInt(page)}).getData(function(result){
                data1 = result;
                //上一题
                subject(data1, 0);
            });

            var previous = parseInt(data[p].id) - 1; 
            $('.previous a').attr('id-data', previous);
            if (!previous) {
                $('.previous').addClass('hide');
            }
            if (data.length != p) {
                $('.next a').text('下一题');
            }
            $('.next a').attr('id-data', data[p].id);
        });
    });

    //倒计时
    $('#CountMsg').countdown('<?= $exam_time_end?>', function(event) {
        $(this).html(event.strftime('%H:%M:%S'));
    });

    //试题
    function subject(data, p) {
        var arr = ['a', 'b', 'c', 'd', 'e'];
        var title = data[p].id + '、' + data[p].title;
        $('#subjects h4').html(title);

        //定义一数组
        var strs = new Array();

        //以“###”字符分割选项
        strs = data[p].body.split("###");
        var option = '';

        //如果不是判断题
        if(data[p].type < 3) {
            for (ii = 0; ii < strs.length; ii++ ) {
                
                // console.log('选项' + arr[ii]);
                 //分割后的字符输出
                if(data[p].type == 1) {

                    //单选题
                    option += '<div class="radio "><label class=" well well-sm">';
                    option += '<input type="radio" name="done" value="' + arr[ii] + '" ';
                    if(data[p].done == arr[ii]) {
                        option += 'checked';
                    }
                    option +=   '> ';
                } else if (data[p].type == 2) {

                    //多选题
                    option += '<div class="checkbox"><label class=" well well-sm">';
                    option += '<input type="checkbox" name="done" value="' + arr[ii] + '" ';

                    if( data[p].done.indexOf(arr[ii]) != -1) {
                        option += 'checked';
                    }

                    option +=   '> ';
                }
                option += strs[ii];
                option += '</label></div>';
            } 
        } else {

            //判断题
            var active_success = '', box_success = '', active_error = '', box_error = '';

            //选择了对的
            if(data[p].done == 1) {
                var active_success = 'active', box_success = 'checked';
                var active_error = '', box_error = '';
            }

            //选择了错的
            if(data[p].done == '0'){
                var active_success = '', box_success = '';
                var active_error = 'active', box_error = 'checked';
            }

            option += '<div class="well well-sm">';
            option += '<div class="btn-group" data-toggle="buttons">';
            option += '<label class="btn btn-default '+ active_success +'">';
            option += '<input type="radio" name="done" value="1" '+ box_success +'><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  对的';
            option += '</label>';

            option += '<label class="btn btn-default  '+ active_error +'">';
            option += '<input type="radio" name="done" value="0" '+ box_error +'><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 错的';
            option += '</label></div>';
        }
        $('#content').html(option);
    }
</script>