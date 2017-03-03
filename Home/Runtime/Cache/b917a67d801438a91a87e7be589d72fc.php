<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
暂时完成一对一的课程的展示(小班课的课程展示暂时还没有完成)
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Center</title>
    <style type="text/css">
        #chossw ul li{
            padding: 7px 10px;
            border: 1px solid #000;
            list-style-type:none;
            margin-bottom: 10px;
            text-align: center;
            cursor:pointer;
        }

        #div_div{
            /*border:1px solid red;*/
            margin: 0 auto;
            overflow: auto;
            float: left;
            width: 100%;
            margin-top: 10px;
        }

        #div_div td,#div_div th{
            text-align: center;
        }

        #chossw ul .inactive{
            background-color: #357Ab7;
        }

        #chossw{
            float: left;
            width: 100%;
        }

        .sub{
            float: right;
            padding: 10px;
        }

        #chossw ul li{
            float: left;
            margin-left: 5px;
            border-radius: 5px;
            color: #FFF;
            background-color: #AAA;
            border:0px solid #000;
        }
        #chossw button{
            float: right;
        }
        .swidth{
            width: 10%;
        }
        .unclass{
            border: 1px solid #F00;
            background-color: #000;
        }
        .colorblock{
            height: 20px;
            width: 20px;
            display: inline-block;
        }
    </style>

    <!-- Bootstrap Core CSS -->
    <link href="__PUBLIC__/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="__PUBLIC__/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="__PUBLIC__/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="__PUBLIC__/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style media="screen">
      table{
        -webkit-user-select: none;  /* Chrome all / Safari all /opera15+*/
-moz-user-select: none;     /* Firefox all */
-ms-user-select: none;      /* IE 10+ */
user-select: none;
      }
    </style>

</head>

<body>
     <div id="wrapper">

        <!-- Navigation -->
        <!-- 标题 -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="topmen">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/liuliu/index.php" ><strong>66Speak Home Page</strong></a>
            </div>
            <!-- /.navbar-header -->
            <!-- 显示北京时间 -->
           <div style="text-align: center;position:fixed;right: 45%;" class="hidden-xs">
                <h3 align="center">Beijing Time&nbsp;&nbsp;&nbsp;<span class="time"><?php echo date('Y/m/d H:i:s',$nowtime);?></span></h3>
            </div>
            <div style="text-align: center;position:absolute;right: 20%;margin-top: -45px;" class="visible-xs">
                <h4><span  class="time2"><?php echo date('H:i:s',$nowtime);?></span></h4>
            </div>
            <!-- //显示北京时间 -->
            <!-- 消息中心 -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo count($unreadmessage) ?>
                        <!-- <?php dump($unreadmessage) ?> -->
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php if(is_array($unreadmessage)): foreach($unreadmessage as $key=>$value): if(($value['isdelete']) == "0"): ?><li>
                                <a href="<?php echo U('Teacher/InformationCenter');?>">
                                <div>
                                    <strong><?php echo ($value['account']); ?></strong>
                                    <span class="pull-right text-muted">
                                        <em><?php echo (date("Y-m-d H:i:s",$value['create_time'])); ?></em>
                                    </span>
                                </div>
                                <div><?php echo ($value['content']); ?></div>
                                </a>
                            </li><?php endif; endforeach; endif; ?>
                        <li>
                            <a class="text-center" href="<?php echo U('Teacher/InformationCenter');?>">
                                <strong>All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo U('Login/doLogout');?>"><i class="fa fa-sign-out fa-fw"></i> Quit</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                        </li>
                        <li>
                          <a href="<?php echo U('Teacher/index');?>"><i class="fa fa-home fa-fw"></i> Teacher Center</a>
                        </li>
                            <li>
                                <a href="<?php echo U('Class/getTeacherClassPlan');?>"><i class="fa fa-calendar fa-fw"></i> Current Month's Schedule</a>
                            </li>
                             <li>
                                <a href="<?php echo U('Comment/TeacherCommentManage',array('type'=>'now'));?>"><i class="fa fa-calendar fa-fw"></i> Course Feedback</a>
                            </li>
                            <li>
                                <!--HistoryFeedback-->
                               <a href="<?php echo U('Comment/TeacherCommentManage',array('type'=>'history'));?>"><i class="fa fa-calendar fa-fw"></i> Feedback History</a>
                           </li>
                        <li>
                            <a href="#"><i class="fa fa-film fa-fw"></i> Video Upload<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Video/showVideoInfo');?>?type=history"> Video History</a>
                                </li>
                                <li>
                                    <!-- <a href="__PUBLIC__/plug-in/examples/simple/index.html">现在上传</a> -->
                                    <a href="<?php echo U('Video/showVideoInfo');?>?type=updateVideo"> Upload Video</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Video/showVideoInfo');?>?type=updateIntroduction"> Upload Introduction Video</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> Teacher Information<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <!-- <a href="Information.html">个人信息修改</a> -->
                                    <a href="<?php echo U('Info/Information');?>"> Teacher Information</a>
                                </li>
                                <li>
                                    <!-- <a href="Information.html">个人信息修改</a> -->
                                    <a href="<?php echo U('Teacher/QualificationsInformation');?>"> Qualification Information</a>
                                </li>
                                <li>
                                    <!-- <a href="ResetPassword.html">密码修改</a> -->
                                    <a href="<?php echo U('Info/resetPassword');?>"> Password Reset</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-credit-card fa-fw"></i> Teacher Salary<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <!-- <a href="MyMoney.html">我的工资</a> -->
                                    <a href="<?php echo U('Money/teacherSalaryManage',array('type'=>'mymoney'));?>"> Teacher Salary</a>
                                </li>
                                <li>
                                    <!-- <a href="HowCaculate.html">工资计算</a> -->
                                    <a href="<?php echo U('Money/teacherSalaryManage',array('type'=>'howcacu'));?>"> Salary Settlement</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo U('Book/showBookInfo');?>"><i class="fa fa-book fa-fw"></i> Teaching Material</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Teacher/MyContract');?>"><i class="fa fa-gavel fa-fw"></i> Teacher Contracts</a>
                        </li>
                        <li>
                            <a href="<?php echo U('UserCenter/showRule');?>"><i class="fa fa-exclamation-triangle fa-fw"></i> Teacher need to know</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Info/contractAdmin');?>"><i class="fa fa-exclamation-triangle fa-fw"></i> Admin Information</a>
                        </li>
                        <!-- <li>
                          <span ><?php echo date('Y/m/d H:i:s',$nowtime);?></span>
                        </li> -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Monthly Schdule</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                        <div class="panel-heading">
                        <?php
 $this_month = (int)$this_month; $this_year = (int)$this_year; ?>
                            <span><?php echo ($this_year); ?> year <?php echo ($this_month); ?> month</span>&nbsp;Teacher's Schedule
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="chossw" class="row">
                                <div class="col-lg-5">
                                    <ul class="list-group">
                                    </ul>
                                </div>
                                <div class="col-lg-7">
                                    <button class="btn btn-primary" id="putupclass" style="margin-left: 10px;">Open</button>
                                    <button class="btn btn-primary" id="deleteclass" style="margin-left: 10px;">Delete</button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg2">Calendar</button>
                                </div>
                            </div>
                            <div class="col-lg-12" style="line-height: 20px;text-align: center;margin-top: 5px;">
                                <div class="colorblock" style="background-color: yellow;color: yellow">as</div>&nbsp;unbook&nbsp;
                                <div class="colorblock" style="background-color: yellow">X</div>booked
                                <div class="colorblock" style="background-color: red;color: red">as</div>&nbsp;teacher absense&nbsp;
                                <div class="colorblock" style="background-color: green;color: green">as</div>&nbsp;normal&nbsp;
                                <div class="colorblock" style="background-color: #666;color: #666">as</div>&nbsp;outdate&nbsp;
                                <div class="colorblock" style="background-color: blue;color: blue;">as</div>&nbsp;trial lesson&nbsp;
                                <div class="colorblock" style="background-color:#DA70D6;color: #DA70D6">as</div>&nbsp;reschdule
                            </div>
                             <div id="div_div" onmousedown="dian(event)" onmousemove="yi(event)" onmouseup="li()" onclick="dianji(event)" onmouseleave="li()">
                                <table cellspacing="0px" class="table table-bordered table-responsive" style="width: 100%;user-select:none;">

                                    <thead >
                                    	<tr>
                                            <td class="swidth">DAY</td>
                                            <th class="swidth">Monday   </th>
                                            <th class="swidth">Tuesday  </th>
                                            <th class="swidth">Wednesday</th>
                                            <th class="swidth">Thursday </th>
                                            <th class="swidth">Friday   </th>
                                            <th class="swidth">Saturday </th>
                                            <th class="swidth">Sunday   </th>
                                        </tr>
                                        <tr id="thisweekdate">
                                            <td>TIME\DATE</td>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>


                                    <thead >
                                        <tr>
                                            <td class="swidth">DAY</td>
                                            <th class="swidth">Monday   </th>
                                            <th class="swidth">Tuesday  </th>
                                            <th class="swidth">Wednesday</th>
                                            <th class="swidth">Thursday </th>
                                            <th class="swidth">Friday   </th>
                                            <th class="swidth">Saturday </th>
                                            <th class="swidth">Sunday   </th>
                                        </tr>
                                        <tr id="thisweekdate2">
                                            <td>TIME\DATE</td>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                                <div id="juzheng" style="background-color:#3167af;"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                        <!-- <div class="panel-footer" style="overflow: auto;">
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg2">查看其他月份课表</button>
                            </div>

                        </div> -->
                    </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xs">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Course Information</h4>
                          </div>
                          <div class="modal-body">
                            <form role="form" class="form-horizontal" action="<?php echo U('Teacher/UpdateTeacherCLassInfor');?>" method="post">
                                <!-- <div class="form-group">
                                    <label class="col-sm-4 control-label">Course Number:</label>
                                    <div class="col-sm-6"> -->
                                    <!-- 设置不可视 -->
                                        <!-- <input type="hidden" name="class_id" class="form-control classid"  readonly="true" id="class_id"> -->
                                        <input type="text" name="class_id" class="form-control classid"  readonly="true" id="class_id">
                                    <!-- </div>
                                </div> -->

                                <div class="form-group" >
                                    <label class="col-sm-4 control-label">Course Type:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control manage" disabled="true"  id="studentmanage">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-sm-4 control-label">Consultants Charged:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control managephone" disabled="true"  id="studentmanagephone">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-sm-4 control-label">Elective Student:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control classtudent" disabled="true" id="choosestudent" >
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-sm-4 control-label">Book Name:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control studentphone" disabled="true" id="bookname">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-sm-4 control-label">Teaching materials:</label>
                                    <div class="col-sm-6">
                                        <a href="" id="booklink" >Teaching materials</a>
                                    </div>
                                </div>
                                 <div class="form-group" >
                                    <label class="col-sm-4 control-label">Student Number:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control classtudent" readonly="true" id="student_id" name='student_id'>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-sm-4 control-label">Student Contact:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control studentphone" disabled="true" id="studentphone">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-sm-4 control-label">Current Progress:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control studentphone" id="book_progress" name="book_progress">
                                    </div>
                                  </div>
                                  <div class="form-group" >
                                    <label class="col-sm-4 control-label">Overall Progress:</label>
                                     <div class="col-sm-6">
                                        <input type="text" class="form-control studentphone" id="book_full_progress" name="book_full_progress">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-sm-4 control-label">Course Remark:</label>
                                    <div class="col-sm-6">
                                        <textarea name="remark" class="form-control remarks" style="resize: none;height: 100px;" id="remark"></textarea>
                                    </div>
                                </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btntype" value="save">Save Change</button>
                                    <button type="submit" class="btn btn-danger" name="btntype" value="cancel">Cancel Course</button>
                                    </a>
                                    </form>
                                </div>
                        </div>
                      </div>
                </div>
                <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">Schedule of Other Months</div>
                            <div class="modal-body">
                                <form action="<?php echo U('Class/getTeacherClassPlan');?>" method="post">
                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Choose Year:</label>
                                    <select class="form-control" name="year" id='nowyear123'>
                                        <!-- <option>2016</option> -->
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="message-text" class="control-label">Choose Month:</label>
                                    <select class="form-control" name="month" id='nowmonth123'>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        </select>
                                  </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="__PUBLIC__/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="__PUBLIC__/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="__PUBLIC__/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

    <script src="__PUBLIC__/js/time.js"></script>
    <script type="text/javascript">
        upDateTime();
        var teachertype=<?php echo ($teacherType); ?>;//0表示中教,课程时间一个小时;1表示外交,课程时间半个小时.
        // var teachertype=0;
        var classtime=(teachertype)?30:60;//表示课程时间
        var classnumber=(teachertype)?31:15;

        (function(callback){
            for (var i = 0; i <= classnumber; i++) {
                $('#div_div tbody').append('<tr><th></th><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
            };
        })()


    </script>
<script type="text/javascript">
    window.px = "";
    window.py = "";
    window.divLength = 0;
    function dian(e) {//鼠标单击不放
        px = e.pageX-270;//获取x坐标
        py = e.pageY-150;//获取y坐标
        // $('#div_div td').each(function(){
        //     $(this).css('background-color','#FFF');
        //     $(this).removeClass('getclass');
        // })
    }
    function yi(e) {       //鼠标移动
        if (px == "" || py == "") {
            return;
        }
        $("#div_div").unbind("mouseover");
        var pxx = e.pageX-270;
        var pyy = e.pageY-150;
        var h = pyy - py;
        var w = pxx - px;
        //画出矩形选中框
        if (h < 0 && w >= 0) {
            $("#juzheng").css({ "height": (-h) + "px", "width": w + "px", "position": "absolute", "left": px + "px", "top": pyy + "px", "opacity": "0.2", "border": "1px dashed #000" });
        }
        else if (h >= 0 && w < 0) {
            $("#juzheng").css({ "height": h + "px", "width": (-w) + "px", "position": "absolute", "left": pxx + "px", "top": py + "px", "opacity": "0.2", "border": "1px dashed #000" });
        }
        else if (h < 0 && w < 0) {
            $("#juzheng").css({ "height": (-h) + "px", "width": (-w) + "px", "position": "absolute", "left": pxx + "px", "top": pyy + "px", "opacity": "0.2", "border": "1px dashed #000" });
        }
        else {
            $("#juzheng").css({ "height": h + "px", "width": w + "px", "position": "absolute", "left": px + "px", "top": py + "px", "opacity": "0.2", "border": "1px dashed #000" });
        }
        if (w < 0) {
            w = 0 - w;
        }
        if (h < 0) {
            h = 0 - h;
        }
        var LEFT = $("#div_div #juzheng").offset().left;
        var TOP = $("#div_div #juzheng").offset().top;
        $('#div_div td').each(function(){
            var left = $(this).offset().left+15;
            var top = $(this).offset().top+15;
            var w1=$(this).width();
            var h1=$(this).height();
            if((top+h1)>=(TOP)&&(top)<=(TOP+h)&&(left+w1)>=(LEFT)&&(left)<=(LEFT+w)){
                if($(this).html()==""){
                    $(this).css('background-color','#AAA');
                    $(this).addClass('getclass');
                }
                if($(this).html() == "Unbook"){
                    $(this).css('background-color','#c15431');
                    $(this).html('Delete');
                    $(this).addClass('getclass');
                }
            }else{
                if($(this).html()==""){
                    $(this).css('background-color','#FFF');
                    $(this).removeClass('getclass');
                }
                if($(this).html() == "Delete"){
                    $(this).css('background-color','yellow');
                    $(this).html('Unbook');
                    $(this).removeClass('getclass');
                }
            }
        });
    }
    function li() {//鼠标点击放开进行初始化
        px = "";
        py = "";
        $("#div_div #juzheng").css({ "height": "0", "width": "0", "border": "0px" });
    }
    function dianji(){
    }

    //时间相关的处理
    var date=new Date(<?php echo date('Y',$nowtimePlan);?>,<?php echo date('m',$nowtimePlan);?>,0);
    var date2=new Date(<?php echo date('Y',$nowtimePlan);?>,<?php echo date('m',$nowtimePlan);?>-1,0);
    var date3=new Date(<?php echo date('Y',$nowtimePlan);?>,<?php echo date('m',$nowtimePlan);?>,<?php echo date('d',$nowtimePlan);?>);

    $('#nowyear123').val(<?php echo date('Y',$nowtimePlan);?>);
    $('#nowmonth123').val(<?php echo date('m',$nowtimePlan);?>);
    // var date=new Date(2016,10,0);
    var year=date.getFullYear();//获取年份
    var month=date.getMonth()+1;//本月

    var mouthdays=date.getDate();//获取本月天数
    var lastmonthdays=date2.getDate();//获取上个月的天数
    date.setDate(1);
    var firstwekday=(date.getDay() == 0)?7:date.getDay();//本月一号是周几
    var d=(mouthdays%7==0)?7:(mouthdays%7);
    var weeknumber=parseInt((mouthdays+6)/7);//计算本月周数
    if(d>(7-firstwekday+1)){
        weeknumber++;
    }

    //当前日期
    var nowdate_16=date3.getDate();
    var nowmonth_16=date3.getMonth();
    // if(nowmonth_16!=month){
    //   nowdate_16=1;
    // }
    //当前是第几周
    var nowweek_16=(nowdate_16<=(7-firstwekday+1))?1:(parseInt((nowdate_16-(7-firstwekday+1)+6)/7)+1);//第几周
    console.log('<?php echo date('Y-m-d H:m:s',$nowtimePlan);?>');
    console.log(date3);
    console.log(nowmonth_16+'月',nowdate_16+'号',nowweek_16);


    // console.log("month="+month);
    // var kecheng=eval([{"time":1475287800000,"state":2,"student":"xioming"},{"time":1476869422000,"state":3,"student":"xioming"}])
    // var kecheng = eval({});

    var kecheng = eval(<?php echo $teacherClassResult;?>)
    // var kecheng=Array(
    // {"time":1475287800000,"state":0},
    // {"time":1476869422000,"state":1}
    // );
    var huatu=Array();
    // alert(arr[0]['time']);
    // console.log(kecheng);
    for (var i = 0; i < kecheng.length; i++) {
        var unixtime=kecheng[i]['time'];
        var state=kecheng[i]['state'];
        var yuzhikecheng=new Date(unixtime);//课程数据
        var yuzhimonth=yuzhikecheng.getMonth()+1;//课程的月份
        var yuzhiday=yuzhikecheng.getDate();//课程的日期
        var yuzhitime=yuzhikecheng.getHours()+":"+yuzhikecheng.getMinutes();//课程的时间
        if(month==yuzhimonth){
            var dijizhou=(yuzhiday<=(7-firstwekday+1))?1:(parseInt((yuzhiday-(7-firstwekday+1)+6)/7)+1);//第几周
            // var dijitian=(yuzhiday<=(7-firstwekday+1))?(firstwekday+yuzhiday-1):((yuzhiday-(7-firstwekday+1)+6)%7+1);//第几天
        }else if(yuzhimonth==((((month+13)%12)==0)?12:((month+13)%12))){
            var dijizhou=weeknumber;//第几周

        }else if(yuzhimonth==((((month+11)%12)==0)?12:((month+11)%12))){
            var dijizhou=1;//第几周
            if(yuzhiday=(lastmonthdays-firstwekday)){
                dijizhou=0;
            }
        }
        var dijitian=(yuzhikecheng.getDay()==0)?7:yuzhikecheng.getDay();
        // console.log("----------");
        // console.log("day="+yuzhikecheng.getDay());
            //获取第几行
        if(teachertype==0){
            var dijihang=(yuzhikecheng.getHours()-8)+1;
        }else{
            var dijihang=(yuzhikecheng.getMinutes()<30)?((yuzhikecheng.getHours()-8)*2+1):((yuzhikecheng.getHours()-8)*2+2);
        }

        var color="#FFF";
        var content="";
        var textColor="#FFF";
        if (state=='0') {   //课程过时
            color="#666";   //灰色
            content="Outdated";
            title="Course Outdated";
            textColor="#FFF";
        }else if(state=='1'){  //未预订
            color="yellow";   //黄色
            content="Unbook";//不显示文字
            title="Unbooked";
            textColor="yellow";
        }else if(state=='2'){   //订课了但是没有上过
            color="yellow";    //黄色，显示名字
            content=kecheng[i]['student'];
            title="Booked";
            textColor="#000";
        }else if(state=="3"){   //正常上课
            color="green";    //绿色
            content=kecheng[i]['student'];
            title="Normal";
            textColor="#FFF";
        }else if(state=="4"){   //教师缺课
            color="red";   //红色
            content=kecheng[i]['student'];
            title="Teacher Absence";
            textColor="#FFF";
        // }else if(state=="5"){   //学生缺课
        //     color="red";     //红色
        //     content=kecheng[i]['student'];
        //     title="Student Absence";
        //     textColor="#FFF";
      }else if(state == "6"){ //重新安排
            color="#DA70D6";     //紫色
            content=kecheng[i]['student'];
            title="Reschdule";
            textColor="#FFF";
        }else if(state == '7'){  //表示试听课
            color="#0000ff";   //蓝色
            content=kecheng[i]['student'];
            title="Trial Lesson";
            textColor="#FFF";
        }
        // console.log(dijizhou,dijitian,dijihang,color);
        huatu.push({'dijizhou':dijizhou,'dijitian':dijitian,'dijihang':dijihang,'color':color,'content':content,'title':title,'textColor':textColor});

    }


    // console.log(huatu);
    //根据周数生成li列表
    var weekDate = new Array("","First","Second","Third","Fourth","Fifth","Sixth","Seventh")
    for (var i = 1; i<=weeknumber; i++) {
        if(i==nowweek_16){
            $('#chossw ul').append('<li class="inactive" value="'+i+'">'+weekDate[i]+' Week</li>')
        }else{
            $('#chossw ul').append('<li value="'+i+'">'+weekDate[i]+' Week</li>')
        }
    }
    //表格初始化
    var i=0;
    var wek=nowweek_16;
    $('#thisweekdate th').each(function(){
        var cdate=(wek-2)*7+(7-firstwekday+1)+1+i;
        if(cdate>mouthdays){
            cdate=cdate%mouthdays;
            var tmd=(((month+1)%12)==0)?12:((month+1)%12);
            $(this).html(tmd+"-"+cdate);
        }
        else if(cdate<1){
            cdate=lastmonthdays+cdate;
             var tmd=(((month-1)%12)==0)?12:(month-1);
            $(this).html(tmd+"-"+cdate);
        }
        else{
            $(this).html(month+"-"+cdate);
        }
        i++;
    });
    var i=0;
    var wek=nowweek_16;
    $('#thisweekdate2 th').each(function(){
        var cdate=(wek-2)*7+(7-firstwekday+1)+1+i;
        if(cdate>mouthdays){
            cdate=cdate%mouthdays;
            var tmd=(((month+1)%12)==0)?12:((month+1)%12);
            $(this).html(tmd+"-"+cdate);
        }
        else if(cdate<1){
            cdate=lastmonthdays+cdate;
             var tmd=(((month-1)%12)==0)?12:(month-1);
            $(this).html(tmd+"-"+cdate);
        }
        else{
            $(this).html(month+"-"+cdate);
        }
        i++;
    });
    var classcount=8;
    var minute=0;
    var con=1;
    $('#div_div tbody th').each(function(){
        if(minute=='0'){
            $(this).html(classcount+":"+minute+'0');
        }else{
            $(this).html(classcount+":"+minute);
        }
        minute=minute+classtime;
        classcount=classcount+parseInt(minute/60);
        minute=minute%60;
        con++;
    });
    // console.log(huatu);
    //初始化表格的课程
     for (var i = 0; i < huatu.length; i++) {
            // console.log(wek,huatu[i]['dijizhou']);
            if (wek==huatu[i]['dijizhou']){
                // console.log(wek,huatu[i]['dijizhou'],huatu[i]['dijitian'],huatu[i]['dijihang'],huatu[i]['color']);
                var djt=huatu[i]['dijitian'];
                var djh=huatu[i]['dijihang'];
                var bjs=huatu[i]['color'];
                var tit=huatu[i]['title'];
                var nr=huatu[i]['content'];
                var textcolor=huatu[i]['textColor'];
                $("#div_div tbody tr").eq(djh-1).find('td').eq(djt-1).html(nr);
                $("#div_div tbody tr").eq(djh-1).find('td').eq(djt-1).css('background-color',bjs);
                $("#div_div tbody tr").eq(djh-1).find('td').eq(djt-1).attr('title',tit);
                $("#div_div tbody tr").eq(djh-1).find('td').eq(djt-1).css('color',textcolor);
                // console.log(djt,djh,bjs);
            }
        }

   //选择第几周并且初始化表格
    $('#chossw li').click(function(){
        $('#chossw li').each(function(){
            $(this).removeClass('inactive');
        });
        $("#div_div tbody td").each(function(){
            $(this).html("");
            $(this).css("background-color","#FFF");
        })
        $(this).addClass('inactive');
        wek=$(this).val();
        day=1;
        i=0;
        $('#thisweekdate th').each(function(){
            var cdate=(wek-2)*7+(7-firstwekday+1)+1+i;
            if(cdate>mouthdays){
                cdate=cdate%mouthdays;
                var tmd=(((month+1)%12)==0)?12:((month+1)%12);
                $(this).html(tmd+"-"+cdate);
            }
            else if(cdate<1){
                cdate=lastmonthdays+cdate;
                var tmd=(((month-1)%12)==0)?12:(month-1);
                $(this).html(tmd+"-"+cdate);
            }
            else{
                $(this).html(month+"-"+cdate);
            }
            i++;
        });
        wek=$(this).val();
        day=1;
        i=0;
        $('#thisweekdate2 th').each(function(){
            var cdate=(wek-2)*7+(7-firstwekday+1)+1+i;
            if(cdate>mouthdays){
                cdate=cdate%mouthdays;
                var tmd=(((month+1)%12)==0)?12:((month+1)%12);
                $(this).html(tmd+"-"+cdate);
            }
            else if(cdate<1){
                cdate=lastmonthdays+cdate;
                var tmd=(((month-1)%12)==0)?12:(month-1);
                $(this).html(tmd+"-"+cdate);
            }
            else{
                $(this).html(month+"-"+cdate);
            }
            i++;
        });
        for (var i = 0; i < huatu.length; i++) {
            // console.log(wek,huatu[i]['dijizhou']);
            if (wek==huatu[i]['dijizhou']){
                // console.log(wek,huatu[i]['dijizhou'],huatu[i]['dijitian'],huatu[i]['dijihang'],huatu[i]['color']);
                var djt=huatu[i]['dijitian'];
                var djh=huatu[i]['dijihang'];
                var bjs=huatu[i]['color'];
                var tit=huatu[i]['title'];
                var nr=huatu[i]['content'];
                var textcolor=huatu[i]['textColor'];
                $("#div_div tbody tr").eq(djh-1).find('td').eq(djt-1).html(nr);
                $("#div_div tbody tr").eq(djh-1).find('td').eq(djt-1).css('background-color',bjs);
                $("#div_div tbody tr").eq(djh-1).find('td').eq(djt-1).attr('title',tit);
                $("#div_div tbody tr").eq(djh-1).find('td').eq(djt-1).css('color',textcolor);
                // console.log(djt,djh,bjs);
            }
        }
    });
    var arr1=new Array();
    $('#div_div td').click(function(){
      // && $(this).html()!="未预定"
        if($(this).html()!="" && $(this).html()!="Outdated"  ){
            $('#class_id').val('');
            $('#studentmanage').val('');
            $('#studentmanagephone').val('');
            $('#choosestudent').val('');
            $('#student_id').val('');
            $('#studentphone').val('');
            $('#remark').val('');
            $('#book_progress').val('');
            $('#book_full_progress').val('');
            $(this).each(function(){
                var ind=$(this).index();
                var hengzuobiao=$(this).parent().find('th').html();
                var zongzuobiao=$(this).parents('table').find('#thisweekdate th').eq(ind-1).html();
                var nianfen=year;
                var yuefen=zongzuobiao.substr(0,2);
                console.log("月份："+yuefen);
                if(month==1){
                    var yuefen=zongzuobiao.substr(0,2);
                    if(yuefen=="12"){
                        nianfen -=1;
                    }
                }else if(month==12){
                    var yuefen=zongzuobiao.substr(0,1);
                    // console.log(zongzuobiao);
                    // console.log(yuefen);
                    if(yuefen=="1"){
                        nianfen +=1;
                        console.log(nianfen);
                    }
                }

                if ($(this).html()!="") {
                    arr1.push({"year":nianfen,"time":hengzuobiao,"date":zongzuobiao});
                }
            });
            var jsonarr=JSON.stringify(arr1);
            arr1 = new Array();
            // alert(jsonarr);
            $.ajax({
                type:'POST',
                url:"<?php echo U('Teacher/GetClassInfo');?>",
                data:'data='+jsonarr,
                dataType:'json',
                success:function(msg){
                    $('#class_id').val(msg['class_id']);
                    $('#studentmanage').val(msg['class_type']);
                    $('#studentmanagephone').val(msg['adminphone']);
                    $('#choosestudent').val(msg['studentname']);
                    $('#student_id').val(msg['student_id']);
                    $('#studentphone').val(msg['studentphone']);
                    $('#book_progress').val(msg['book_progress']);
                    $('#book_full_progress').val(msg['book_full_progress']);
                    $('#remark').val(msg['remark']);
                    $('#booklink').attr('href',"/liuliu/Public/generic/web/viewer.html?file=../../.."+msg['download_link']);
                    $('#bookname').val(msg['bookname']);
                    // alert(msg['download_link']);
                },
                error:function(error){

                }
            });
            $('#myModal1').modal();
        }

        if($(this).html()==""){
            if($(this).is(".getclass")){
                $(this).css('background-color','#FFF');
                $(this).removeClass('getclass');
            }else{
                $(this).css('background-color','#AAA');
                $(this).addClass('getclass');
            }
        }
    });

    //开放课程提交按钮事件
    $('#putupclass').click(function(){
        var arr=new Array();
        $('.getclass').each(function(){
            var ind=$(this).index();
            var hengzuobiao=$(this).parent().find('th').html();
            var zongzuobiao=$(this).parents('table').find('#thisweekdate th').eq(ind-1).html();
            var nainfen=year;
            var yuefen=zongzuobiao.substr(0,2);
            // console.log("asdasd"+"   "+yuefen);
            if(month==1){
                var yuefen=zongzuobiao.split('-')[0];
                // var yuefen=zongzuobiao.substr(0,2);
                if(yuefen=="12"){
                    nainfen -=1;
                }
            }else if(month==12){
                var yuefen=zongzuobiao.split('-')[0];
                console.log(zongzuobiao);
                console.log(yuefen);
                if(yuefen=="1"){
                    nainfen +=1;
                    // console.log(nainfen);
                }
            }

            if ($(this).html()=="") {
                arr.push({"year":nainfen,"time":hengzuobiao,"date":zongzuobiao});
            }
        });
        var jsonarr=JSON.stringify(arr);
        // console.log(jsonarr);

        post("<?php echo U('Class/ClassManage');?>/type/add", {data:jsonarr});


        // $.ajax({
        //     type:'POST',
        //     url:"<?php echo U('Teacher/PostCourse');?>",
        //     data:'data='+jsonarr,
        //     dataType:'json',
        //     // success:function(msg){
        //     //     alert(msg.responseText);
        //     //     // location.reload();//刷新页面
        //     //       window.location.href="<?php echo U('Teacher/');?>";
        //     //
        //     // },
        //     // error:function(error){
        //     //     alert(error.responseText);
        //     //       window.location.href="<?php echo U('Teacher/');?>";
        //     // }
        // });

    });

    $('#deleteclass').click(function(){
        var arr=new Array();
        $('.getclass').each(function(){
            var ind=$(this).index();
            var hengzuobiao=$(this).parent().find('th').html();
            var zongzuobiao=$(this).parents('table').find('#thisweekdate th').eq(ind-1).html();
            var nainfen=year;
            var yuefen=zongzuobiao.substr(0,2);
            // console.log("asdasd"+"   "+yuefen);
            if(month==1){
                var yuefen=zongzuobiao.split('-')[0];
                // var yuefen=zongzuobiao.substr(0,2);
                if(yuefen=="12"){
                    nainfen -=1;
                }
            }else if(month==12){
                var yuefen=zongzuobiao.split('-')[0];
                console.log(zongzuobiao);
                console.log(yuefen);
                if(yuefen=="1"){
                    nainfen +=1;
                    // console.log(nainfen);
                }
            }

            if ($(this).html()=="Delete") {
                arr.push({"year":nainfen,"time":hengzuobiao,"date":zongzuobiao});
            }
        });
        var jsonarr=JSON.stringify(arr);
        // console.log(jsonarr);
        $.ajax({
            type:'POST',
            url:"<?php echo U('Teacher/BatchDeleteTeacherClass');?>",
            data:'data='+jsonarr,
            dataType:'json',
            success:function(msg){
                alert(msg.responseText);
                location.reload();//刷新页面
                // reload();
            },
            error:function(error){
                alert(error.responseText);
                location.reload();//刷新页面
                // reload();
            }
        });
    })
</script>

<script type="text/javascript">
  function post(URL, PARAMS) {
      var temp = document.createElement("form");
      temp.action = URL;
      temp.method = "post";
      temp.style.display = "none";
      for (var x in PARAMS) {
          var opt = document.createElement("textarea");
          opt.name = x;
          opt.value = PARAMS[x];
          // alert(opt.name)
          temp.appendChild(opt);
      }
      document.body.appendChild(temp);
      temp.submit();
      return temp;
  }
</script>
</body>

</html>