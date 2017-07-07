<?= $this->Html->css(['exams-start'])?>
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
<input type="hidden" name="exam_count" value="<?= $exam_count?>" >

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
    //倒计时
    $('#CountMsg').countdown('<?= $exam_time_end?>', function(event) {
        $(this).html(event.strftime('%H:%M:%S'));
    });
</script>