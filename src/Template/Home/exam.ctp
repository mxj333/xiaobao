<div class="row" id="subjects">
    <div class="col-lg-12">
        <h4></h4>
    </div>
    <div class="col-lg-12" id="content">
        
    
    <?php //} ?>
</div><!-- /.row -->

<footer class="footer">
    <div class="container">
        <nav>
            <ul class="pager">
                <li class="disabled previous"><a href="javascript:void(0);" id-data='0'>上一题</a></li>
                <li class="next"><a href="javascript:void(0);" id-data='1'>下一题</a></li>
            </ul>
        </nav>
    </div>
</footer>
<div id="mymodal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h3 class="modal-title" id="mySmallModalLabel">请选择一个答案！</h3>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<?= $this->Html->script(array('sqlite'));?>
<script type="text/javascript">
    var db = new lanxDB('xiaobao');
    var arr = ['a', 'b', 'c', 'd'];
    var data = [];
    // return false;
    $(function() {
        $('footer .navbar-fixed-bottom').hide();
        db.switchTable('subjects').getData(function(result){
            data = result;
            var title = data[0].id + '、' + data[0].title;
            $('#subjects h4').html(title);

            var strs = new Array(); //定义一数组 
            strs = result[0].body.split("###"); //字符分割 
            var option = '';            
            for (i=0; i < strs.length; i++ ) { 
                //document.write(strs[i]+"<br/>"); //分割后的字符输出 
                option += '<div class="radio "><label class=" well well-sm">';
                option += '<input type="radio" name="done" value="' + arr[i] + '" ';
                if(data[0].done === arr[i]) {
                    option += ' checked="checked"';
                }
                option +=   '> ';
                option += strs[i];
                option += '</label></div>';
            } 
            $('#content').html(option);
            $('.next a').attr('id-data', data[0].id);
        });

        $('.pager .next').on('click', function() {
            // var v = $("input[name=done]:checked").val();
            var v = '';
            $("input[name=done]:checked").each(function(){
                v += $(this).val();
            }); 
            if (v == '') {
                $('#mymodal').modal('show');
                return false;
            };
            db.where({id: parseInt($('.next a').attr('id-data'))}).saveData({done: $.trim(v)});    
            var p = parseInt($('.next a').attr('id-data'));
            if (data.length > p) {
                var title = data[p].id + '、' + data[p].title;
                $('#subjects h4').html(title);

                var strs = new Array(); //定义一数组 
                strs = data[p].body.split("###"); //字符分割 
                var option = '';
                if(data[p].type < 3) {            
                    for (ii = 0; ii < strs.length; ii++ ) { 
                        //document.write(strs[i]+"<br/>"); //分割后的字符输出                         
                        if(data[p].type == 1) {
                            option += '<div class="radio "><label class=" well well-sm">';
                            option += '<input type="radio" name="done" value="' + arr[ii] + '" ';
                            if(data[p].done) {
                                option += 'checked';
                            }
                            option +=   '> ';
                        } else if (data[p].type == 2) {
                            option += '<div class="checkbox"><label class=" well well-sm">';
                            option += '<input type="checkbox" name="done" value="' + arr[ii] + '" ';
                            // if(data[p].done) {
                            //     option += 'checked';
                            // }
                            option +=   '> ';
                        }
                        option += strs[ii];
                        option += '</label></div>';
                    } 
                } else {
                    option += '<div class="well well-sm">';
                    option += '<div class="btn-group" data-toggle="buttons"><label class="btn btn-default">';
                    option += '<input type="radio" name="done" value="1" autocomplete="off" checked><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  对的';
                    option += '</label><label class="btn btn-default">';
                    option += '<input type="radio" name="done" value="0" autocomplete="off"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 错的';
                    option += '</label></div>';
                    // option += '<input type="radio" name="done" value="1" autocomplete="off"> 对</label>';
                    // option += '<label class="btn btn-primary "><input type="radio" name="done" value="0" autocomplete="off"> 错';
                    // option += '</label></div>';
                }
                $('#content').html(option);
                $('.previous a').attr('id-data', parseInt(data[p].id) - 1);
                $('.next a').attr('id-data', data[p].id);                
            } else {
                location.href = '/home/done';
                console.log(data);   
            }
        });

        // $('.pager .previous').on('click', function() {
        //     var p = parseInt($('.previous a').attr('id-data'));
        //     // var p = page + 1;
        //     var title = data[p].id + '、' + data[p].title;
        //     $('#subjects h4').html(title);

        //     var strs = new Array(); //定义一数组 
        //     strs = data[p].body.split("###"); //字符分割 
        //     var option = '';            
        //     for (ii = 0; ii < strs.length; ii++ ) { 
        //         //document.write(strs[i]+"<br/>"); //分割后的字符输出 
        //         option += '<div class="radio well well-sm"><label>';
        //         option += '<input type="radio" name="done" value="' + arr[ii] + '">';
        //         option += strs[ii];
        //         option += '</label></div>';
        //     } 
        //     $('#content').html(option);
        //     var previous = parseInt(data[p].id) - 1; 
        //     $('.previous a').attr('id-data', previous);
            
        // });
    })
</script>