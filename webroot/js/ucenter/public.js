function start_time(){
        var username = chMobile($('input[name=username]'));
        if(username){
            $.post("/api/Users/checkerUserName", {"username":$('input[name=username]').val()}, function(data){
                if(data == 1) {
                    //获取验证码
                    $.post("/api/MobileVerify/verify", {"mv_mobile":$('input[name=username]').val()}, function(json){
                        showMessage(json.info);
                    }, 'json');

                    var time = $(".codeBtn").children("label").text("60s").text();
                    $(".codeBtn").children("span").text("后重新发送验证码");
                    var timer = setTimeout(countdown_time(timer,parseInt(time),$(".codeBtn")),0);
                    $(".codeBtn").unbind("click",start_time);
                }

                if(data == 9) {
                    showMessage('你的手机号已注册过了！');
                }
            });
            // return false;
        }else{
            $(".codeBtn").bind("click",start_time);
            showMessage('请输入正确手机号！');
        }
}

//倒计时
function countdown_time(timer,time,obj){
    clearTimeout(timer);
    timer = setTimeout(function(){
        time--;
        set_time(timer,time,obj);
    },1000);
}

//倒计时时，设置按钮文字
function set_time(timer,time,obj){
    obj.children("label").text(time +"s");
    if(time == 0){
        clearTimeout(timer);
        obj.children("label").text("");
        obj.children("span").text("获取验证码");
        obj.bind("click",start_time);
        return;
    }
    countdown_time(timer,time,obj);
}

//检查手机号
function chMobile(mobile) {
    var a_mobile = $.trim(mobile.val());
    if(a_mobile == '' || !(/^1[3|4|5|8][0-9]\d{4,8}$/.test(a_mobile)) || !(/^[0-9]*$/.test(a_mobile))){
        return false;
    }
    return true;
}

//检查email邮箱
function CheckMail(mail) {
    var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (filter.test(mail)) {
        return true;
    } else {
        return false;
    }
}

//提示框
function showMessage(message,width,height,color,bgColor,boxColor,fontSize){
    var width = width || "300px";
    var height = height || "100px";
    var color = color || "#323232";
    var bgColor = bgColor || "#caefd4";
    var boxColor = boxColor || "#30e58a";
    var fontSize = fontSize || "16px";
    var middleHeight = ($(window).height() - parseInt(height))/ 2;
    var middleWidth = ($(window).width() - parseInt(width))/ 2;
    if(!$("body").children().hasClass("l_showMessage")){
        $("body").append("<div class='l_showMessage'>" + message + "</div>");
        $(".l_showMessage").css({"width":width,"height":height,"color":color,"background":bgColor,"border":"1px solid","border-color":boxColor,"font-size":fontSize,"position":"fixed","top":middleHeight,"left":middleWidth,"line-height":height,"text-align":"center","overflow":"hidden", "z-index":"1000"}).stop().animate({"opacity":"0","z-index":"-999"},2000);

    }else{
        $(".l_showMessage").text(message).css({"top":middleHeight}).animate({"opacity":"1","z-index":"1000"},0).stop().animate({"opacity":"0","z-index":"-999"},2000);
    }
}

//倒计时
function getRTime(time, element){
    var EndTime= new Date("2016-09-14 19:30:30"); //截止时间
    var NowTime = new Date();
    var t = EndTime.getTime() - NowTime.getTime();
    var d = Math.floor(t / 1000 / 60 / 60 / 24);
    var h = Math.floor(t / 1000 / 60 / 60 % 24);
    var m = Math.floor(t / 1000 / 60 % 60);
    var s = Math.floor(t / 1000 % 60);
console.log(h);
    document.getElementById(element).innerHTML = "" + EndTime + ":" + m + ":" + s + "";
}