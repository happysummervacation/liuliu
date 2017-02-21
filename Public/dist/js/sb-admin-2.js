$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }


    //获取表格内容填写表单
    $(".getcolinfo").click(function() {
            $(".fromtable1").val($(this).parent().siblings(':first').html());
            $(".fromtablesecond").val($(this).parent().siblings(':first').next().html());
            $(".fromtable9").html($(this).parent().siblings(':first').next().html());
            $(".fromtable13").val($(this).parent().siblings(':first').next().html());
            $(".fromtable2").val($(this).parent().siblings(':first').next().next().html()); 
            $(".fromtable10").html($(this).parent().siblings(':first').next().next().html()); 
            $(".fromtable6").val($(this).parent().siblings(':first').next().next().next().html());
            $(".fromtable7").val($(this).parent().siblings(':first').next().next().next().next().html());
            $(".fromtable8").val($(this).parent().siblings(':first').next().next().next().next().next().html()); 
            $(".fromtable11").val($(this).parent().siblings(':first').next().next().next().next().next().next().html()); 
            $(".fromtable12").val($(this).parent().siblings(':first').next().next().next().next().next().next().next().html());            
            if($(this).parents("div").attr('id')=="dayV"){
                $(".fromtable4").val("0");
                $(".formtable5").html("课程编号:");
                $(".fromtable3").val($(this).parent().siblings(':first').next().next().next().html());
            }else if($(this).parents("div").attr('id')=="weekV"){
                $(".fromtable4").val("1");
                $(".formtable5").html("评价时间:");
                $(".fromtable3").val($(this).parent().siblings(':first').next().next().next().next().html());
            }else if($(this).parents("div").attr('id')=="mouthV"){
                $(".fromtable4").val("2");
                $(".formtable5").html("评价时间:");
                $(".fromtable3").val($(this).parent().siblings(':first').next().next().next().html());
            }
        })

    //根据年份月份判断每月日期数
    $(".mouthselect,.yearselect").change(function() {
        var mouthvalue=$(".mouthselect").val();
        var yearvalue=$(".yearselect").val();
        var reg=/([469]|11)/g;
        $(".bmouth,.mmouth,.smouth").css("display","block");
        if (reg.test(mouthvalue)) {
            $(".bmouth").css("display","none");
        }else if(mouthvalue==2){
            if((yearvalue%4)==0||((yearvalue%400)==0)){
                $(".bmouth,.mmouth").css("display","none");
            }else{
                $(".bmouth,.mmouth,.smouth").css("display","none");
            }
        }
    })
    //ajax查看用户数据
    // $(".getmoreinfo").click(function(){
    //     var SCri=$(this).parent().siblings(':first').next().html();
    //     var request = new XMLHttpRequest();
    //     request.open("POST",'__URL__/doinfo');
    //     var data = "userID="+SCri;
    //     alert(data);
    //     request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //     request.send(data);
    //     request.onreadystatechange = function() {
    //             if (request.readyState===4) {
    //                 if (request.status===200) { 
    //                     var re=request.responseText;
    //                     alert(re);
    //                 } else {
    //                     alert("发生错误：" + request.status);
    //                 }
    //             } 
    //         }
    // })


    if(isFirefox=navigator.userAgent.indexOf("Firefox")>0){  
        $('.uploadbutton').click(function(){
            $('.uploadbutton input').trigger("click");
        });
        $('.uploadbutton input').click(function(e){
             window.event? window.event.cancelBubble = true : e.stopPropagation();
        })
    }

});
