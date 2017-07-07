
//把上次的考试成绩写入历史表中
function setHistorys() {
    var db = new lanxDB('xiaobao');
    db.switchTable('subjects').getData(function(result) {
        if(result.length > 0) {
            //把考试成绩写入历史表中
            $.post('/ucenter/exams/historys', {result}, function(json){
                // console.log(json);
            });
        }
    });
}