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

    <!-- DataTables CSS -->
    <link href="__PUBLIC__/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="__PUBLIC__/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="__PUBLIC__/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="__PUBLIC__/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="__PUBLIC__/css/Myschedule.css" rel="stylesheet" type="text/css">

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
                                    <a href="<?php echo U('OrderClass/getStudentOrderClassTimeTable');?>/type/one"><i class="fa fa-book fa-fw"></i> 一对一课表</a>
                                </li>
                                <li>
                                    <!-- <a href="MySchedule.html">我的课表</a> -->
                                    <a href="<?php echo U('OrderClass/getStudentOrderClassTimeTable');?>/type/group"><i class="fa fa-book fa-fw"></i> 小班课课表</a>
                                </li>
                                <li>
                                    <!-- <a href="CourseeValuation.html">课程评价</a> -->
                                    <a href="<?php echo U('Comment/studentComment');?>"><i class="fa fa-book fa-fw"></i> 评价教师</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Comment/showCommentFromTeacher');?>"><i class="fa fa-book fa-fw"></i> 教师的评价</a>
                                </li>
                            <!-- </ul> -->
                            <!-- /.nav-second-level -->
                        <!-- </li> -->
                        <!-- <li> -->
                            <!-- <a href="#"><i class="fa fa-rocket fa-fw"></i> 学员订单<span class="fa arrow"></span></a> -->
                            <!-- <ul class="nav nav-second-level"> -->
                                <li >
                                    <a  href="<?php echo U('UserCenter/getManageInfo');?>"><i class="fa fa-legal fa-fw"></i> 已有套餐</a>
                                </li>

                                <li >
                                    <a href="<?php echo U('Package/packageShow');?>"><i class="fa fa-legal fa-fw"></i> 购买套餐</a>
                                </li>
                                <li >
                                    <a href="<?php echo U('Package/delayPackage');?>"><i class="fa fa-legal fa-fw"></i> 套餐延期</a>
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
                            <a href="<?php echo U('Contract/showContract');?>"><i class="fa fa-legal fa-fw"></i> 学员合同</a>
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


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">我的课表</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            我的课表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body overfw">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped  table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>订课编号</th>
                                            <!-- <th>课程名称</th> -->
                                            <!-- <th>学习顾问</th> -->
                                            <th>课程类型</th>
                                            <th>教材名</th>
                                            <th>上课时间</th>
                                            <th>时长(min)</th>
                                            <th>教师英文名</th>
                                            <th style="display: none">教师ID</th>
                                            <!-- <th>课堂笔记</th> -->
                                            <th>上课链接</th>
                                           <!--  <th>取消选课</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach ($classdata as $key => $value) { ?>
                                            <tr >
                                                <td><?php echo ($value['groupStuClassSchID']); ?> </td>
                                                <td><?php echo ($value['groupName']); ?></td>
                                                <td><?php echo ($value['material']); ?></td>
                                                <td><?php echo (date('Y-m-d H:i',$value['classStartTime'])); ?> </td>
                                                <!-- <td><a href="#"><?php echo ($value['manage_name']); ?> </a></td> -->
                                                <!-- <td><?php echo (date('Y-m-d H:i:s',$value['class_start_time'])); ?> </td> -->
                                                <td><?php echo ($value['classEndTime']-$value['classStartTime'])/60-5;?>分钟</td>
                                                <td><a href="#" data-toggle="modal" data-target="#modalmoneyinfo" class="getTeacherInfo" ><?php echo ($value['englishname']); ?></a> </td>
                                                <td style="display: none"><?php echo ($value['ID']); ?></td>
                                               <!--  <td><a href="<?php if(is_null($value['note_link'])) { echo '#';} else {echo $value['note_link'];}?>">查看</a></td> -->
                                                <!-- <td><a href="<?php echo ($value['zoom']); ?>"><button class="btn btn-primary">GO!</button></a></td> -->

                                                <!--这里面要加一个上课按钮的生效判断-->
                                               <!--  <?php
 $check = md5($value['groupStuClassSchID']); $class_type = md5($value['classType']); ?> -->
                                                    <!-- 这里的class_type是class中的 -->
                                                <?php if($time['nowtime']>=$value['classStartTime']-$time['buttonEffectTime']&&$time['nowtime']<=$value['classEndTime']+$time['buttonLostTime']){?>
                                                <td>
                                                    <a href="<?php echo U('OrderClass/studentAttendClass',array('ID'=>$value['groupClassSchID'],'classtype'=>'group'));?>">
                                                      <input type="button" value="GO" class="btn btn-primary">
                                                    </a>
                                                </td>
                                                <?php }else{?>
                                                  <td>还没有到上课时间</td>
                                                <?php }?>
                                                <!-- <td><a href="#"><input type="button" value="GO" class="btn btn-primary" onclick='window.open("<?php echo $value['zoom'];?>")'></a></td> -->

                                                <!--取消选课还没有做-->
                                                <!-- <td><a href="<?php $check = md5($value['orderclass_id']); echo U('Student/CancelClass',array('orderclass_id'=>$value['orderclass_id'],'check'=>$check));?>"><button class="btn btn-danger">取消</button></a></td> -->
                                                <!-- 点击取消弹出一个确认框，有确认和取消的那种 -->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalmoneyinfo">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        教师信息
                                        </div>
                                        <div class="modal-body"  style="overflow: auto;">
                                            <div class="form-group">
                                              <label for="">教师QQ</label>
                                              <input type="text" name="stopID" value="" class="form-control" id="QQ" readonly="true">
                                            </div>
                                            <div class="form-group">
                                              <label for="">教师skype</label>
                                              <input type="text" name="stu_name" value="" class="form-control" id="Skype" readonly="true">
                                            </div>
                                            <div class="form-group">
                                              <label for="">教师微信</label>
                                              <input type="text" name="strattime" value="" class="form-control" id="Wechat" readonly="true">
                                            </div>
                                            <div class="form-group">
                                              <label for="">教师zoom</label>
                                              <input type="text" name="stoptime" value="" class="form-control" id="Zoom" readonly="true">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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

    <!-- DataTables JavaScript -->
    <script src="__PUBLIC__/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="__PUBLIC__/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>

    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                autoWidth:true,
                ordering:false,
                searching:true,
                'language':{
                'emptyTable':'没有数据',
                'loadingRecords':'加载中...',
                'processing':'查询中...',
                'search':'检索:',
                'lengthMenu':'每页 _MENU_ 条',
                'zeroRecords':'没有数据',
                'paginate':{
                    'first':'第一页',
                    'last':'最后一页',
                    'next':'下一页',
                    'previous':'上一页'
                },
                'info':'第 _PAGE_ 页 / 总 _PAGES_ 页',
                'infoEmpty': '没有数据',
                'infoFiltered':'过滤总件数 _MAX_ 条'
            },
        });

    });

    </script>

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();
    </script>

    <script type="text/javascript">
        $(".getTeacherInfo").click(function(){
            var TeacherID = $(this).parent().parent().children().eq(6).html();
            $.ajax({
                type:"POST",
                url:"<?php echo U('Info/AjaxGetRegisterInfo');?>",
                data:{
                    type:'teacher',
                    ID:TeacherID,
                },
                dataType:"json",
                success:function(msg){
                    $("#QQ").val("");
                    $("#Skype").val("");
                    $("#Wechat").val("");
                    $("#Zoom").val("");

                    $("#QQ").val(msg.QQ);
                    $("#Skype").val(msg.skype);
                    $("#Wechat").val(msg.weixin);
                    $("#Zoom").val(msg.zoom);
                },
                error:function(msg){
                    alert("获取数据失败");
                },
            })
        });
    </script>

    <!-- <script type="text/javascript">
        $('#dataTables-example').DataTable({
            responsive:true,
            'language':{
                'emptyTable':'没有数据',
                'loadingRecords':'加载中...',
                'processing':'查询中...',
                'search':'检索:',
                'lengthMenu':'每页 _MENU_ 条',
                'zeroRecords':'没有数据',
                'paginate':{
                    'first':'第一页',
                    'last':'最后一页',
                    'next':'下一页',
                    'previous':'上一页'
                },
                'info':'第 _PAGE_ 页 / 总 _PAGES_ 页',
                'infoEmpty': '没有数据',
                'infoFiltered':'过滤总件数 _MAX_ 条'
            },
        });
    </script> -->

</body>

</html>