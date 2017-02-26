<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>学员中心</title>

    <!-- Bootstrap Core CSS -->
    <link href="__PUBLIC__/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="__PUBLIC__/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="__PUBLIC__/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="__PUBLIC__/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- 时间选择插件 -->
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/tool/flatpickr.min.css">

    <link href="__PUBLIC__/css/BookingCourse.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->

        <!-- 标题 -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/liuliu/index.php" ><strong>溜溜英语首页</strong></a>
            </div>
            <!-- /.navbar-header -->
            <!-- 显示北京时间 -->
                <div style="text-align: center;position:fixed;right: 45%;" class="hidden-xs">
                    <h4>北京时间&nbsp;&nbsp;&nbsp;<span class="time"><?php echo date('Y/m/d H:i:s',$nowtime);?></span></h4>
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
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php if(is_array($unreadmessage)): foreach($unreadmessage as $key=>$value): if(($value['isdelete']) == "0"): ?><li>
                                <a href="<?php echo U('Student/InformationCenter');?>">
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
                            <a class="text-center" href="<?php echo U('Student/InformationCenter');?>">
                                <strong>查看所有消息</strong>
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
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> 用户信息</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> 账号设置</a>
                        </li>
                        <li class="divider"></li> -->
                        <li><a href="<?php echo U('Login/doLogout');?>"><i class="fa fa-sign-out fa-fw"></i> 注销</a>
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
                            <!-- <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="搜索...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div> -->
                            <!-- /input-group -->
                        </li>
                        <li>
                            <!-- <a href="index.html"><i class="fa fa-home fa-fw"></i> 用户中心</a> -->
                            <a href="<?php echo U('UserCenter/index');?>"><i class="fa fa-home fa-fw"></i> 学员中心</a>
                        </li>
                        <!-- <li>
                            <a href="#"><i class="fa fa-calendar fa-fw"></i> 课程管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> -->
                                <li>
                                    <!-- <a href="BookingCourse.html">预约课程</a> -->
                                    <a href="<?php echo U('OrderClass/showOrderClassInfo');?>"><i class="fa fa-book fa-fw"></i> 预约课程</a>
                                </li>
                                <li>
                                    <!-- <a href="MySchedule.html">我的课表</a> -->
                                    <a href="<?php echo U('Student/MySchedule');?>"><i class="fa fa-book fa-fw"></i> 一对一课表</a>
                                </li>
                                <li>
                                    <!-- <a href="MySchedule.html">我的课表</a> -->
                                    <a href="<?php echo U('Student/GroupClassSchedule');?>"><i class="fa fa-book fa-fw"></i> 小班课课表</a>
                                </li>
                                <li>
                                    <!-- <a href="CourseeValuation.html">课程评价</a> -->
                                    <a href="<?php echo U('Student/CourseeValuation');?>"><i class="fa fa-book fa-fw"></i> 评价教师</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Student/TeacherValuation');?>"><i class="fa fa-book fa-fw"></i> 教师的评价</a>
                                </li>
                            <!-- </ul> -->
                            <!-- /.nav-second-level -->
                        <!-- </li> -->
                        <!-- <li> -->
                            <!-- <a href="#"><i class="fa fa-rocket fa-fw"></i> 学员订单<span class="fa arrow"></span></a> -->
                            <!-- <ul class="nav nav-second-level"> -->
                                <li >
                                    <a  href="<?php echo U('Student/MyPackage');?>"><i class="fa fa-legal fa-fw"></i> 已有套餐</a>
                                </li>

                                <li >
                                    <a href="<?php echo U('Package/packageShow');?>"><i class="fa fa-legal fa-fw"></i> 购买套餐</a>
                                </li>
                                <li >
                                    <a href="<?php echo U('Student/DelayPackage');?>"><i class="fa fa-legal fa-fw"></i> 套餐延期</a>
                                </li>
                            <!-- </ul> -->
                            <!-- /.nav-second-level -->
                        <!-- </li> -->
                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> 学员信息<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <!-- <a href="Information.html">个人信息</a> -->
                                    <a href="<?php echo U('Info/Information');?>"> 学员信息</a>
                                </li>
                                <li>
                                    <!-- <a href="ResetPassword.html">修改密码</a> -->
                                    <a href="<?php echo U('Info/resetPassword');?>"> 修改密码</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <!-- <a href="MyBook.html"><i class="fa fa-book fa-fw"></i> 我的教材</a> -->
                            <a href="<?php echo U('Book/showBookInfo');?>"><i class="fa fa-book fa-fw"></i> 学员教材</a>
                        </li>
                        <li>
                            <!-- <a href="MyContract.html"><i class="fa fa-legal fa-fw"></i> 我的合同</a> -->
                            <a href="<?php echo U('Student/MyContract');?>"><i class="fa fa-legal fa-fw"></i> 学员合同</a>
                        </li>
                        <li>
                            <!-- <a href="ContactAdmin.html"><i class="fa fa-fax fa-fw"></i> 联系课程顾问</a> -->
                            <a href="<?php echo U('Info/contractAdmin');?>"><i class="fa fa-fax fa-fw"></i> 联系顾问</a>
                        </li>
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
                        <h1 class="page-header">预约课程</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row">
                    <!-- 选择课程 -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            预约课程
                        </div>
                        <div class="panel-body">
                            <div>
                                <ul class="nav nav-pills">
                                <li class="active" id="chooseclassbyorder">
                                    <a href="#chclass" data-toggle="tab">选择课程</a>
                                </li>
                                <li id="choosebookbyorder">
                                    <a href="#chbook" data-toggle="tab">选择教材</a>
                                </li >
                                <li id="updatechoosebyorder"><a href="#upch" data-toggle="tab">提交选择</a></li>
                                </ul>
                            </div>
                            <div class="tab-content" style="margin-top: 20px;">
                                <div class="tab-pane fade in active" id="chclass">

                                    <div class="tab-content" style="margin-top: 20px;">
                                        <div class="tab-pane fade in active" id="byteacher">
                                        <div class="row">
                                        <div class="form-group">
                                          <form class="" action="<?php echo U('Student/getclassbytime');?>" method="post">
                                            <div class="col-lg-3">
                                                <label>起始时间</label>
                                                <input type="text" name="start_time" class="calendar form-control">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>截止时间</label>
                                                <input type="text" name="end_time" class="calendar form-control">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>教师类别</label>
                                                <select class="form-control" name="teacher_type">
                                                    <option value="0">中教</option>
                                                    <option value="1">外教</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style=" visibility: hidden;">提交</label>
                                                <br>
                                                <button type="submit" class="btn btn-primary tijiaoshaixuan"  style="float: right;">
                                                    提交筛选
                                                </button>
                                            </div>
                                          </form>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <!-- 一个教师的信息 在这里循环输出-->
                                        <!-- 先输出有频率的教师-->
                                        <!-- <?php dump($rate_result); dump($teacher_result);?> -->
                                        <?php foreach($rate_result as $key => $value) {?>
                                        <?php foreach($teacher_result as $t_key => $t_value) {?>
                                        <?php if($value['teacher_id'] == $t_value['ID']) {?>
                                            <div class="col-lg-3" style="margin-top: 20px;">
                                                <div class="col-xs-6">
                                                    <a href="<?php echo U('Student/TeacherInfo',array('ID'=>$value['teacher_id']));?>"><img src="<?php echo ($t_value['image_path']); ?>" alt='没有头像' style="height: 100px;width: 100px;"></a>
                                                </div>
                                                <div class="col-xs-6">
                                                    <h3 style="margin:0px"><?php echo ($t_value['englishname']); ?></h3>
                                                    <label>
                                                        <!-- <button class="btn btn-default btn-xs">名师</button> -->
                                                        <?php if($t_value['teacher_type'] == '1'){?>
                                                            <button class="btn btn-default btn-xs">外教</button>
                                                        <?php }else{?>
                                                            <button class="btn btn-default btn-xs">中教</button>
                                                        <?php }?>
                                                        <?php if($t_value['level'] == "0"){ ?>
                                                            <button class="btn btn-default btn-xs">普教</button>
                                                        <?php }else{ ?>
                                                            <button class="btn btn-default btn-xs">名教</button>
                                                       <?php } ?>
                                                    </label>
                                                    <!-- <p>中文名</p> -->
                                                    <span style="display: none;"><?php echo ($t_value['ID']); ?></span>
                                                </div>
                                                <div class="col-xs-12" style="text-align: center;">
                                                    <button class="btn btn-default xuanzekecheng"  style="width: 65%;margin-top: 15px;">
                                                        可选课程
                                                    </button>
                                                </div>
                                            </div>
                                            <!--如果进入该if，表示有该数据，就将该教师的信息从返回的教师信息列表中删除-->

                                        <?php unset($teacher_result[$t_key]);}}}?>
                                        <!-- <?php dump($teacher_result);?> -->
                                        <!--将剩余的教师的信息显示出来-->
                                        <?php foreach($teacher_result as $key => $value){?>
                                            <div class="col-lg-3" style="margin-top: 20px;">
                                                <div class="col-xs-6">
                                                    <a href="<?php echo U('Student/TeacherInfo',array('ID'=>$value['ID']));?>"><img src="<?php echo ($value['image_path']); ?>" alt='没有头像' style="height: 100px;width: 100px;"></a>
                                                </div>
                                                <div class="col-xs-6">
                                                    <h3 style="margin:0px"><?php echo ($value['englishname']); ?></h3>
                                                    <label>
                                                        <!-- <button class="btn btn-default btn-xs">名师</button> -->
                                                        <?php if($value['teacher_type'] == '1'){?>
                                                        <button class="btn btn-default btn-xs">外教</button>
                                                        <?php }else{?>
                                                            <button class="btn btn-default btn-xs">中教</button>
                                                        <?php }?>
                                                        <?php if($value['level'] == '0'){ ?>
                                                            <button class="btn btn-default btn-xs">普教</button>
                                                        <?php }else{ ?>
                                                            <button class="btn btn-default btn-xs">名教</button>
                                                        <?php } ?>
                                                    </label>
                                                    <!-- <p>中文名</p> -->
                                                    <span style="display: none;"><?php echo ($value['ID']); ?></span>
                                                </div>
                                                <div class="col-xs-12" style="text-align: center;">
                                                    <button class="btn btn-default xuanzekecheng"  style="width: 65%;margin-top: 15px;">
                                                        可选课程
                                                    </button>
                                                </div>
                                            </div>
                                        <?php }?>
                                        <!-- // -->
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="chbook">
                                    <div class="row">
                                    <!--教材展示区-->
                                    <?php if(is_array($book_result)): foreach($book_result as $key=>$first): if(is_array($first)): foreach($first as $key=>$second): ?><div class="col-lg-2" style="text-align: center;">
                                            <div class="col-xs-12">
                                                <span><?php echo ($second['bookname']); ?></span>
                                                <p style="display: none"><?php echo ($second['bookid']); ?></p>
                                            </div>
                                            <div class="col-xs=12" style="padding: 5px;">
                                                <img src="<?php echo ($second['bookimagelink']); ?>" alt="教材封面" style="height: 130px;width: 100px;">
                                            </div>
                                            <div class="col-xs-12">
                                                <button class="btn btn-default btn-sm getbookinfo">选择教材</button>
                                            </div>
                                        </div><?php endforeach; endif; endforeach; endif; ?>
                                    <!--教材展示区-->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="upch">
                                    <div class="col-md-12">
                                        <table class="table table-hover" id="jiaoshikebiao3">
                                            <thead>
                                                <tr>
                                                    <th>课程编号</th>
                                                    <th>上课时间</th>
                                                    <th>任课教师</th>
                                                    <th>课程类型</th>
                                                    <th>课程数量</th>
                                                    <!-- <th>教材名称</th> -->
                                                    <th>删除记录(<a id="deleteall">删除全部</a>)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 col-md-offset-4" style="margin-top: 20px;">
                                        <button class="btn btn-primary" style="width: 100%;" id="submitorderclasslist">提交课程</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="teacherclass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">可选课程</h4>
                          </div>
                          <!-- <div class="modal-body"> -->
                            <!-- <table class="table table-hover" id="jiaoshikebiao1">
                                <thead>
                                    <tr>
                                        <td>课程编号</td>
                                        <td>上课时间</td>
                                        <td>任课教师</td>
                                        <td>课程类型</td>
                                        <td>选课数量</td>
                                        <td>选择课程</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table> -->
                          <!-- </div> -->
                          <div class="modal-body">
                              <form class="form">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label class="label-form">年份</label>
                                        <select class="form-control" name="year" id="yeararr">

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                         <label class="label-form">月份</label>
                                        <select class="form-control" name="month" id="montharr">

                                        </select>
                                    </div>
                                     <div class="col-sm-4">
                                        <label class="label-form">第几周</label>
                                        <select class="form-control" name="month" id="weekarr">

                                        </select>
                                    </div>
                                </div>
                              </form>
                              <hr>
                              <div class="col-lg-12" style="padding:15px;">
                                <div style="background-color:blue;width:10px;height:10px;display:none"></div>&nbsp;
                                &nbsp;&nbsp;&nbsp;
                                <div style="background-color:green;width:10px;height:10px;display:none;"></div>&nbsp;
                              </div>
                          <table id="teachertable" class="table table-hover table-bordered">
                              <thead>
                                  <tr>
                                    <td  style="text-align: center;">DATE</td>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;">TIME\DAY</td>
                                    <th style="text-align: center;">星期一</th>
                                    <th style="text-align: center;">星期二</th>
                                    <th style="text-align: center;">星期三</th>
                                    <th style="text-align: center;">星期四</th>
                                    <th style="text-align: center;">星期五</th>
                                    <th style="text-align: center;">星期六</th>
                                    <th style="text-align: center;">星期七</th>
                                  </tr>
                              </thead>
                              <tbody style="text-align: center;">
                              </tbody>
                          </table>
                           </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelclasschoose">取消</button>
                            <button type="button" class="btn btn-primary" id="makesure">确认</button>
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

    <script src="__PUBLIC__/js/md5.js"></script>
    <!-- jQuery -->
    <script src="__PUBLIC__/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="__PUBLIC__/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="__PUBLIC__/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="__PUBLIC__/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="__PUBLIC__/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

    <script src="__PUBLIC__/js/time.js"></script>

    <!-- 时间选择插件 -->
    <script src="__PUBLIC__/tool/flatpickr.min.js"></script>

    <!-- 教师课表初始化 -->
    <script type="text/javascript">

    </script>
    <script type="text/javascript">
        $(function(){
            $('#chooseclassbyorder').css('display','block');
            $('#choosebookbyorder').css('display','none');
            $('#updatechoosebyorder').css('display','none');
        })

        //初始化时间选择器
        $(".calendar").flatpickr({
            "enableTime": true,
            "minuteIncrement":30,
            "time_24hr": true,
        });

        //全局变量
        var BOOKINFO="";//教材信息




        //流程逻辑
        function step1(){
            $('#chooseclassbyorder').css('display','none');
            $('#choosebookbyorder').css('display','block');
            $('#updatechoosebyorder').css('display','none');


            $('#teacherclass').modal('hide');
            $('#chooseclassbyorder').removeClass('active');
            $('#chclass').removeClass('in active');
            $('#choosebookbyorder').addClass('active');
            $('#chbook').addClass('in active');
            step2();
        }

        function step2(){
            $('#chooseclassbyorder').css('display','block');
            $('#choosebookbyorder').css('display','none');
            $('#updatechoosebyorder').css('display','block');


            $('#choosebookbyorder').removeClass('active');
            $('#chbook').removeClass('in active');
            $('#updatechoosebyorder').addClass('active');
            $('#upch').addClass('in active');
            // step3();
        }

        function step3(temp){
            var upclassinfo="<tr><td>"
            +temp['class_id']+"</td><td>"
            +temp['class_time']+"</td><td>"
            +temp['class_teacher']+"</td><td>"
            +temp['class_type']+"</td><td>"
            +temp['class_num']+"</td><td>"
            // +BOOKINFO+"</td><td>"
            +"<a href='#' class='deleterecord'>删除</a></td></tr>";
            $("#jiaoshikebiao3 tbody").append(upclassinfo);
            $('.deleterecord').click(function(){
                $(this).parent().parent().remove();
            })
        }

        //表格初始化函数
        function tableinit(year,month,week,classarr,time){
            $("#teachertable tbody").html("");
            // console.info(classarr);
            var ttdate=new Date(year,month,0);
            var ttmond=ttdate.getDate();
            ttdate.setDate(1);
            // console.log(classarr);
            var marr=time.sort(function(a,b){
                var h1= parseInt(a.substr(0,2));
                var h2= parseInt(b.substr(0,2));
                if(h1!=h2){
                    return h1-h2;
                }else{
                    var m1=parseInt(a.substr(3,2));
                    var m2=parseInt(b.substr(3,2));
                    return m1-m2;
                }
            });
            var firstwekday=(ttdate.getDay() == 0)?7:ttdate.getDay();//本月一号是周几
            var startd=(week-1)*7-firstwekday+2;
            if(month<10){
              month='0'+month;
            };
            for (var i = 0; i < 7; i++) {
                if((startd+i)>0 && (startd+i)<=ttmond){

                    $("#teachertable thead th").eq(i).html((month)+"-"+(startd+i));
                }else{
                    $("#teachertable thead th").eq(i).html("////////");
                }
                $("#teachertable thead th").eq(i).css('text-align','center');
            };
            for(var i=0;i<marr.length;i++){
                $("#teachertable tbody").append("<tr>"+
                "<th style='text-align:center;'>"+marr[i]+"</th><td></td><td></td><td></td><td></td><td></td><td></td><td></td>"
                +"</tr>");
            }
            //把课程填写进去
            $("#teachertable tbody td").each(function(){
                var t=$(this).parent().find('th').html();//时间
                var inx=$(this).parent().find('td').index(this)%7;//第几天
                var d=$("#teachertable thead th").eq(inx).html().substr(3,2);
                // console.log(d);
                if(d<10){
                  d='0'+d;
                }
                // console.log(d);
                var start_time=year+"-"+month+"-"+d+" "+t;
                for(var i=0;i<classarr.length;i++){
                  // console.log("----------");
                  // console.log(start_time);
                  // console.log(classarr[i]['start_time'].substr(0,16));
                    // console.log("----------");
                    if(classarr[i]['start_time'].substr(0,16)==start_time){
                        // console.info(classarr[i]);
                        if(classarr[i]['class_type']=='正常课程'){
                          $(this).css('background-color','green');
                          $(this).css('color','green');
                          $(this).addClass('normal');
                        }else{
                          // $(this).css('background-color','blue');
                          // $(this).css('color','blue');
                          // $(this).addClass('otm');
                        }
                        $(this).html(classarr[i]['class_id']);
                        $(this).addClass('chooseclass');
                        $(this).val(classarr[i]['teacher']+":"+classarr[i]['class_type']+":"+classarr[i]['class_num']);
                    }
                }
            });

             //点击预约课程，获取课程ID存放到全局变量里,然后执行逻辑step1
            $('.chooseclass').click(function(){
                if($(this).hasClass('ordered')){
                    if($(this).hasClass('normal')){
                        $(this).css('background-color','green');
                        $(this).css('color','green');
                    }else{
                        $(this).css('background-color','blue');
                        $(this).css('color','blue');
                    }
                    $(this).removeClass('ordered');
                }else{
                    $(this).css('background-color','#aaa');
                    $(this).css('color','#aaa');
                    $(this).addClass('ordered');
                }

            });

            $('#makesure').click(function(){
                var tempclass = [];
                $('.chooseclass').each(function(){
                    if($(this).hasClass('ordered')){
                        var t=$(this).parent().find('th').html();//时间
                        var inx=$(this).parent().find('td').index(this)%7;//第几天
                        var d=$("#teachertable thead th").eq(inx).html().substr(3,2);
                        var sda=new Array();
                        sda=$(this).val().split(':');
                        var start_time=year+"-"+month+"-"+d+" "+t;
                        var CLASSINFO=[];
                        CLASSINFO['class_id']=$(this).html();
                        CLASSINFO['class_time']=start_time;
                        CLASSINFO['class_teacher']=sda[0];
                        CLASSINFO['class_type']=sda[1];
                        CLASSINFO['class_num']=sda[2];

                        tempclass.push(CLASSINFO);
                        $(this).removeClass('ordered');
                    };
                });
                for (var i = 0; i < tempclass.length; i++) {
                    step3(tempclass[i]);
                }
                tempclass = [];
                step1();
            })
        }

        //批量删除
        $('#deleteall').click(function(){
            $(this).parents('table').find('tbody').html('');
        })



        //根据教师的ID获取教师的课程信息
        $('.xuanzekecheng').click(function(){
            //先获取老师的ID
            var teacher_id=$(this).parent().parent().find('span').html();
            // alert(teacher_id);
            $.ajax({
                type:'post',
                url: "<?php echo U('Student/getteacherclasslist');?>",
                data: "teacher_id="+teacher_id,
                success:function(classes){
                 if(classes=='error'||classes==''||classes==null)
                 {
                     $("#jiaoshikebiao1 tbody").html("");
                     $("#yeararr").html("");
                     $("#montharr").html("");
                     $("#weekarr").html("");

                     $("#teachertable tbody").html("");
                    $("#jiaoshikebiao1 tbody").html("<tr><td colspan='6' style='text-align:center'>该教师没有可选课程</td></tr>");
                 }
                 else if(classes == "0"){
                     $("#jiaoshikebiao1 tbody").html("");
                     $("#yeararr").html("");
                     $("#montharr").html("");
                     $("#weekarr").html("");

                     $("#teachertable tbody").html("");
                    $("#jiaoshikebiao1 tbody").html("<tr><td colspan='6' style='text-align:center'>你没有激活状态的套餐，无法进行定课</td></tr>");
                 }
                 else if(classes == "1"){
                   alert('你的套餐无法选择该教师的课程');
                   return;
                 }
                 else
                 {
                     classes = JSON.parse(classes);
                     $("#jiaoshikebiao1 tbody").html("");
                     $("#yeararr").html("");
                     $("#montharr").html("");
                     $("#weekarr").html("");

                     // 获取提交表格里的所有课程ID
                     var aCLASS_ID=new Array();
                     var length=$('#jiaoshikebiao3 tbody tr').length;
                     for(var j=0;j<length;j++){
                        aCLASS_ID[j]=$('#jiaoshikebiao3 tbody tr').eq(j).find('td').html();
                    };
                    var arr=new Array();
                    var yarr=new Array();

                    for(var i=0;i<classes.length;i++){
                        var flag=aCLASS_ID.indexOf(classes[i]['class_id']);
                        if(flag=='-1'){
                            /**
                             * 1.classes内部存放了所有的课程信息
                             * 2.把课程信息的时间分成年月日提取出来
                             * 3.写成一个数组，存放 ｛年，月，日，时间，第几周，第几天，第几行｝
                             * 4.根据这个数组，渲染表格，表格里面放课程ID
                             *
                             */
                            var year=parseInt(classes[i]['start_time'].substr(0,4));
                            var month=parseInt(classes[i]['start_time'].substr(5,2));
                            var day=parseInt(classes[i]['start_time'].substr(8,2));
                            var time=classes[i]['start_time'].substr(11,5);
                            var date=new Date(year,month,0);
                            date.setDate(1);
                            var firstwekday=(date.getDay() == 0)?7:date.getDay();//本月一号是周几
                            var dijizhou=(day<=(7-firstwekday+1))?1:(parseInt((day-(7-firstwekday+1)+6)/7)+1);//第几周
                            var dijitian=(day<=(7-firstwekday+1))?(firstwekday+day-1):((day-(7-firstwekday+1)+6)%7+1);//第几天
                            arr.push({"class_id":classes[i]['class_id'],"start_time":classes[i]['start_time'],"teacher":classes[i]['englishname'],"class_type":classes[i]['class_type'],"class_num":(classes[i]['selected_number']+"/"+classes[i]['limit_number']),"year":year,"month":month,"dijizhou":dijizhou,"time":time});
                            if(yarr.indexOf(year)=='-1'){
                                yarr.push(year);
                            }
                            // if(marr.indexOf(month)=='-1'){
                            //     marr.push(month);
                            //     $("#montharr").append("<option>"+month+"</option>");
                            // }
                            // if(warr.indexOf(dijizhou)=='-1'){
                            //     warr.push(dijizhou);
                            //     $("#weekarr").append("<option>"+dijizhou+"</option>");
                            // }
                            // if(tarr.indexOf(time)=='-1'){
                            //     tarr.push(time);
                            // }
                        }

                    }

                    var hasmonth=function(year){
                        var montharr=[];
                        for (var i = 0; i < arr.length; i++) {
                            if(year==arr[i]['year']){
                                if(montharr.indexOf(arr[i]['month'])==-1){
                                    montharr.push(arr[i]['month']);
                                }
                            }
                        }
                        return montharr;
                    }

                    var hasweek=function(year,month){
                        var weekarr=[];
                        for (var i = 0; i < arr.length; i++) {
                            if((year==arr[i]['year'])&&(month==arr[i]['month'])){
                                if(weekarr.indexOf(arr[i]['dijizhou'])==-1){
                                    weekarr.push(arr[i]['dijizhou']);
                                }
                            }
                        }
                        return weekarr;
                    }

                    var hastime=function(year,month,week){
                        var timearr=[];
                        for (var i = 0; i < arr.length; i++) {
                            if(year==arr[i]['year']&&month==arr[i]['month']&&week==arr[i]['dijizhou']){
                                if(timearr.indexOf(arr[i]['time'])==-1){
                                    timearr.push(arr[i]['time']);
                                }
                            }
                        }
                        return timearr;
                    }


                    yarr.sort(function(a,b){
                        return a-b;
                    });

                    for (var i = 0; i < yarr.length; i++) {
                        $("#yeararr").append("<option>"+yarr[i]+"</option>");
                    }

                    var tyear=$("#yeararr").val();
                    //获取有多少月
                    var montharr=hasmonth(tyear);
                    montharr.sort(function(a,b){
                        return a-b;
                    });
                    for (var i = 0; i < montharr.length; i++) {
                        $("#montharr").append("<option>"+montharr[i]+"</option>");
                    }
                    //获取有多少周
                    var tmonth=$("#montharr").val();
                    console.log(tmonth);
                    var weekarr=hasweek(tyear,tmonth);
                    console.log(weekarr);
                    weekarr.sort(function(a,b){
                            return a-b;
                    });
                    for (var i = 0; i < weekarr.length; i++) {
                        $("#weekarr").append("<option>"+weekarr[i]+"</option>");
                    }
                    //获取有多少时间
                    var tweek=$('#weekarr').val();
                    var tarr=hastime(tyear,tmonth,tweek);
                    // console.log(arr);
                    //这里做初始化表格和课程的渲染
                    tableinit(tyear,tmonth,tweek,arr,tarr);
                    $("#yeararr").change(function(){
                        $("#montharr").html(" ");
                        var tyear=$("#yeararr").val();
                        //获取有多少月
                        var montharr=hasmonth(tyear);
                        montharr.sort(function(a,b){
                            return a-b;
                        });
                        for (var i = 0; i < montharr.length; i++) {
                            $("#montharr").append("<option>"+montharr[i]+"</option>");
                        }

                        var tyear=$("#yeararr").val();
                        var tmonth=$("#montharr").val();
                        var tweek=$("#weekarr").val();
                        var tarr=hastime(tyear,tmonth,tweek);
                        tableinit(tyear,tmonth,tweek,arr,tarr);
                    });
                    $("#montharr").change(function(){
                        $("#weekarr").html(" ");
                        var tyear=$("#yeararr").val();
                        var tmonth=$("#montharr").val();
                        var weekarr=hasweek(tyear,tmonth);
                        weekarr.sort(function(a,b){
                            return a-b;
                        });
                        for (var i = 0; i < weekarr.length; i++) {
                            $("#weekarr").append("<option>"+weekarr[i]+"</option>");
                        }

                        var tyear=$("#yeararr").val();
                        var tmonth=$("#montharr").val();
                        var tweek=$("#weekarr").val();
                        var tarr=hastime(tyear,tmonth,tweek);
                        tableinit(tyear,tmonth,tweek,arr,tarr);
                    });
                    $("#weekarr").change(function(){
                        var tyear=$("#yeararr").val();
                        var tmonth=$("#montharr").val();
                        var tweek=$("#weekarr").val();
                        var tarr=hastime(tyear,tmonth,tweek);

                        tableinit(tyear,tmonth,tweek,arr,tarr);
                    });



                 }
                
                    $('#teacherclass').modal();

                }
            })
        })




            //点击选择教材，获取教材ID存放到全局变量里，然后执行逻辑step2
            // $('.getbookinfo').click(function(){
            //     var book_id=$(this).parent().parent().find('p').html();
            //     BOOKINFO=book_id;
            //     step2();
            // })

            //提交预约课程的记录
            $('#submitorderclasslist').click(function(){
                var CLASS_ID=new Array();
                var BOOK_ID=new Array();
                var length=$('#jiaoshikebiao3 tbody tr').length;

                for(var j=0;j<length;j++){
                    CLASS_ID[j]=$('#jiaoshikebiao3 tbody tr').eq(j).find('td').html();
                    BOOK_ID[j]=$('#jiaoshikebiao3 tbody tr').eq(j).find('td').eq(5).html();
                };
                var updata_id = JSON.stringify(CLASS_ID);
                var updata_book = JSON.stringify(BOOK_ID);
                $.ajax({
                    type:'post',
                    url: "<?php echo U('Student/StudentOrderClassWithClassIDAndBookID');?>",
                    data:'id_data='+updata_id+'&book_data='+updata_book,
                    success:function(classes){
                        if(classes!='error'){
                            alert(classes);
                            // location.reload();//刷新页面
                        }else{
                            alert(classes);
                            // location.reload();//刷新页面
                        }
                    }
                });
            })

    </script>

</body>

</html>