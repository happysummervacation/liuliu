<?php if (!defined('THINK_PATH')) exit();?><!-- 登录时的首页面,学生个人主页 -->

<!DOCTYPE html>
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

    <!-- Timeline CSS -->
    <link href="__PUBLIC__/dist/css/timeline.css" rel="stylesheet">

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
                                    <a href="<?php echo U('Student/TeacherValuation');?>"><i class="fa fa-book fa-fw"></i> 教师的评价</a>
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

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">学员中心</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <!-- <i class="fa fa-user fa-5x"></i> -->
                                        <img src="<?php echo ($studentinfo[0]['image_path']); ?>" height="76" width="57"/>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge simpleline">
                                        <?php if($studentinfo['0']['chinesename']==null){ echo $studentinfo['0']['account']; }else{ echo $studentinfo['0']['chinesename']; } ?>
                                        </div>
                                        <div>STUDENT</div>
                                    </div>
                                </div>
                            </div>
                           <!--  <a href="Information.html"> -->
                            <a href="<?php echo U('Student/Information');?>">
                                <div class="panel-footer">
                                    <span class="pull-left">个人信息</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge  simpleline"><!-- <?php echo ($studentinfo['0']['student_sum_money']); ?>元 -->
                                        <?php echo ($classnumber['o_f_h_ClassNumber']); ?>|<?php echo ($classnumber['o_f_a_ClassNumber']); ?>
                                        </div>
                                        <div>外教课:已上|预订总数</div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="MyPackage.html"> -->
                            <a href="<?php echo U('Student/BookingCourse');?>">
                                <div class="panel-footer">
                                    <span class="pull-left">预约课程</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-calendar fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge  simpleline">
                                         <!-- <?php echo ($classnumber); ?>
                                        课时 -->
                                        <?php echo ($classnumber['o_c_h_ClassNumber']); ?>|<?php echo ($classnumber['o_c_a_ClassNumber']); ?>    
                                        </div>
                                        <div>中教课:已上|预订总数</div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="MySchedule.html"> -->
                            <a href="<?php echo U('Student/BookingCourse');?>">
                                <div class="panel-footer">
                                    <span class="pull-left">预约课程</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-exclamation-circle fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge  simpleline"><!-- <?php echo ($otopackage); ?>|<?php echo ($otmpackage); ?> -->
                                        <?php echo ($classnumber['g_h_ClassNumber']); ?>|<?php echo ($classnumber['g_a_ClassNumber']); ?>
                                        </div>
                                        <div>小班课:已上|预订总数</div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="NewPackage.html"> -->
                            <a href="<?php echo U('Student/BookingCourse');?>">
                                <div class="panel-footer">
                                    <span class="pull-left">预约课程</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                课程进度
                            </div>
                            <div class="panel-body">
                                <div class="" style="overflow: auto">
                                    <div class="col-lg-4">
                                        <h4>已上教材进度:&nbsp;<?php echo ($studentinfo['0']['book_progress']); ?>&nbsp;|教材总进度:&nbsp;<?php echo ($studentinfo['0']['book_full_progress']); ?>&nbsp;</h4>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="progress" style="margin-top: 10px;">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($jindu); ?>%">
                                                <span class="sr-only"><?php echo ($jindu); ?> Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                                <div class="panel-heading">
                                    评论给信息
                                </div>
                                <!-- .panel-heading -->
                                <div class="panel-body">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">近三条评价</a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                               <th>评论编号</th>
                                                               <th>评论教师</th>
                                                               <th>评论等级</th>
                                                               <th>评论内容</th>
                                                               <th>评论时间</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                                <?php if(is_array($classcomment)): foreach($classcomment as $key=>$value): ?><tr>
                                                                    <td><?php echo ($value['comment_id']); ?></td>
                                                                    <td><?php echo ($value['account']); ?></td>
                                                                    <td><?php echo ($value['comment_level']); ?></td>
                                                                    <td><?php echo ($value['comment_content']); ?></td>
                                                                    <td><?php echo (date("Y-m-d H:i:s",$value['comment_time'])); ?></td>
                                                                    </tr><?php endforeach; endif; ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">近三周周评</a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                               <th>评论编号</th>
                                                               <th>评论教师</th>
                                                               <th>评论等级</th>
                                                               <th>评论内容</th>
                                                               <th>评论时间</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php if(is_array($weekcomment)): foreach($weekcomment as $key=>$value): ?><tr>
                                                                    <td><?php echo ($value['comment_id']); ?></td>
                                                                    <td><?php echo ($value['account']); ?></td>
                                                                    <td><?php echo ($value['comment_level']); ?></td>
                                                                    <td><?php echo ($value['comment_content']); ?></td>
                                                                    <td><?php echo (date("Y-m-d H:i:s",$value['comment_time'])); ?></td>
                                                                </tr><?php endforeach; endif; ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">近三月月评</a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                   <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                               <th>评论编号</th>
                                                               <th>评论教师</th>
                                                               <th>评论等级</th>
                                                               <th>评论内容</th>
                                                               <th>评论时间</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <?php if(is_array($monthcomment)): foreach($monthcomment as $key=>$value): ?><td><?php echo ($value['comment_id']); ?></td>
                                                                    <td><?php echo ($value['account']); ?></td>
                                                                    <td><?php echo ($value['comment_level']); ?></td>
                                                                    <td><?php echo ($value['comment_content']); ?></td>
                                                                    <td><?php echo (date("Y-m-d H:i:s",$value['comment_time'])); ?></td><?php endforeach; endif; ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .panel-body -->
                                <div class="panel-footer" style="overflow:auto">
                                    <div class="pull-right">
                                        <a href="CourseeValuation.html"><button class="btn btn-primary">评论详细</button></a>
                                    </div>
                                </div>
                        </div>
                    <!-- /.panel -->
                    </div>
                    <!-- <div class="col-lg-8">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> 任务时间表
                        </div>
                        /.panel-heading
                        <div class="panel-body" style="overflow: auto;height: 200px;">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge"><i class="fa fa-check"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">STEVEN老师的少儿英语</h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i>10min ago</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>下一节课程即将开始</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">账户管理员</h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i>60min ago</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>账户余额即将不足</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">课程顾问</h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i>120min ago</small>
                                        </div>
                                        <div class="timeline-body">
                                            <p>你有一门的课程评分较低</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        /.panel-body
                    </div> -->
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

    <!-- Morris Charts JavaScript -->
<!--     <script src="../../bower_components/raphael/raphael-min.js"></script>
    <script src="../../bower_components/morrisjs/morris.min.js"></script>
    <script src="../../js/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();
    </script>

</body>

</html>