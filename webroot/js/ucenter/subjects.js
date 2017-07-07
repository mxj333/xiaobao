var db = new lanxDB('xiaobao');
$(function() {
    $('footer .navbar-fixed-bottom').hide();

    //获取第一道试题
    getSubject();

    //第一题时隐藏上一题按钮
    $('.previous').addClass('hide');

    var sub_count = $('input[name=exam_count]').val();

    //下一题
    $('.pager .next').on('click', function() {
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

        $('.previous').removeClass('hide');

        var p = parseInt($('.next a').attr('id-data'));

        //保存答案
        db.switchTable('subjects').where({id: p}).updateData({done: $.trim(v)});
        
        //最后一道时显示为交卷
        if (sub_count == p+1) {
            $('.next a').text('交卷');
        }

        if (sub_count > p) {
            $('.previous a').attr('id-data', parseInt(p));
            $('.next a').attr('id-data', parseInt(p+1));

            //获取下一道试题
            getSubject(parseInt(p+1));

        } else {
            location.href = '/ucenter/exams/done';
        }

    });

    //上一题
    $('.pager .previous').on('click', function() {

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

        var p = parseInt($('.previous a').attr('id-data'));

        //保存答案
        db.switchTable('subjects').where({id: p+1}).updateData({done: $.trim(v)});

        getSubject(p);

        if (p == 1) {
            $('.previous').addClass('hide');
        } else {
            $('.previous a').attr('id-data', parseInt(p - 1));
        }

        if (sub_count > p) {
            $('.next a').text('下一题');
        }
        
        $('.next a').attr('id-data', p);
    });
});

function getSubject(id) {
    id = id || 1;
    db.switchTable('subjects').where({id: id}).getData(function(result){
        // data = result;
        //题目
        subject(result, 0);
    });
}


//试题
function subject(data, p) {
    var arr = ['a', 'b', 'c', 'd', 'e'];
    var title = data[p].id + '、' + data[p].title;
    $('#subjects h4').html(title);

    var option = '';

    //如果不是判断题
    if(data[p].type < 3) {
        //定义一数组
        var strs = new Array();
        //以“###”字符分割选项
        strs = data[p].body.split("###");

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
