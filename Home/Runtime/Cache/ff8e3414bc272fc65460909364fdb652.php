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

    <link href="__PUBLIC__/css/MyBook.css" rel="stylesheet" type="text/css">

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
                            <a href="<?php echo U('Student/ContactAdmin');?>"><i class="fa fa-fax fa-fw"></i> 联系顾问</a>
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
                        <h1 class="page-header">学员教材</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">教材库</div>
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#shangwu" data-toggle="tab">少儿类英语</a>
                                </li>
                                <li><a href="#shaoer" data-toggle="tab">成人类英语</a>
                                </li>
                                <li><a href="#shiyongkou" data-toggle="tab">雅思类口语</a>
                                </li>
                                <li><a href="#tuofu" data-toggle="tab">小班类口语</a>
                                </li>
                                <!-- <li><a href="#mianshi" data-toggle="tab">面试英语</a>
                                </li>
                                <li><a href="#qita" data-toggle="tab">其他英语</a>
                                </li> -->
                            </ul>

                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="shangwu">
                                <?php foreach ($bookresult as $key => $value) { if($value['book_type'] == '1'){?>
                                    <div class="col-xs-3">
                                        <div class="panel panel-default" style="margin-top: 10px;width: 280px;">
                                            <div class="panel-heading simpleline">
                                                教材名称:<?php echo ($value['bookname']); ?>
                                            </div>
                                            <div class="panel-body">
                                                <img src="<?php echo ($value['bookimagelink']); ?>" style="width: 80%;height: 200px">
                                            </div>
                                            <div class="panel-footer">
                                                <a href="__PUBLIC__/generic/web/viewer.html?file=../../.<?php echo ($value['download_link']); ?>"><button class="btn btn-danger" style="width: 45%">在线打开</button></a>
                                                <?php if($value['can_upload']) {?>
                                                <a href="<?php
 $suffix_parts = path_info($value['download_link']); $suffix = $suffix_parts['extension']; $filename = $suffix_parts['filename']; echo U('Student/DownLoadBook',array('suffix'=>$suffix,'downfilename'=>$value['book_name'],'filename'=>$filename));?>"><button  class="btn btn-primary " style="width: 45%">下载</button></a>
                                                <?php }else {echo "<button class='btn btn-primary' disabled='true'>不支持下载</button>";}?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }}?>
                                </div>
                                <div class="tab-pane fade" id="shaoer">
                                    <?php foreach ($bookresult as $key => $value) { if($value['book_type'] == '2'){?>
                                    <div class="col-xs-3">
                                        <div class="panel panel-default" style="margin-top: 10px;width: 280px;">
                                            <div class="panel-heading simpleline">
                                                教材名称:<?php echo ($value['bookname']); ?>
                                            </div>
                                            <div class="panel-body">
                                                <img src="<?php echo ($value['bookimagelink']); ?>" style="width: 80%;height: 200px">
                                            </div>
                                            <div class="panel-footer">
                                                <a href="__PUBLIC__/generic/web/viewer.html?file=../../.<?php echo ($value['download_link']); ?>"><button class="btn btn-danger" style="width: 45%">在线打开</button></a>
                                                <?php if($value['can_upload']) {?>
                                                <a href="<?php
 $suffix_parts = path_info($value['download_link']); $suffix = $suffix_parts['extension']; $filename = $suffix_parts['filename']; echo U('Student/DownLoadBook',array('suffix'=>$suffix,'downfilename'=>$value['book_name'],'filename'=>$filename));?>"><button  class="btn btn-primary " style="width: 45%">下载</button></a>
                                                <?php }else {echo "<button class='btn btn-primary'  disabled='true'>不支持下载</button>";}?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }}?>
                                </div>
                                <div class="tab-pane fade" id="shiyongkou">
                                    <?php foreach ($bookresult as $key => $value) { if($value['book_type'] == '3'){?>
                                   <div class="col-xs-3">
                                        <div class="panel panel-default" style="margin-top: 10px;width: 280px;">
                                            <div class="panel-heading simpleline">
                                                教材名称:<?php echo ($value['bookname']); ?>
                                            </div>
                                            <div class="panel-body">
                                                <img src="<?php echo ($value['bookimagelink']); ?>" style="width: 80%;height: 200px">
                                            </div>
                                            <div class="panel-footer">
                                                <a href="__PUBLIC__/generic/web/viewer.html?file=../../.<?php echo ($value['download_link']); ?>"><button class="btn btn-danger" style="width: 45%">在线打开</button></a>
                                                <?php if($value['can_upload']) {?>
                                                <a href="<?php
 $suffix_parts = path_info($value['download_link']); $suffix = $suffix_parts['extension']; $filename = $suffix_parts['filename']; echo U('Student/DownLoadBook',array('suffix'=>$suffix,'downfilename'=>$value['book_name'],'filename'=>$filename));?>"><button  class="btn btn-primary " style="width: 45%">下载</button></a>
                                                <?php }else {echo "<button class='btn btn-primary'  disabled='true'>不支持下载</button>";}?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }}?>
                                </div>
                                <div class="tab-pane fade" id="tuofu">
                                    <?php foreach ($bookresult as $key => $value) { if($value['book_type'] == '4'){?>
                                    <div class="col-xs-3">
                                        <div class="panel panel-default" style="margin-top: 10px;width: 280px;">
                                            <div class="panel-heading simpleline">
                                                教材名称:<?php echo ($value['bookname']); ?>
                                            </div>
                                            <div class="panel-body">
                                                <img src="<?php echo ($value['bookimagelink']); ?>" style="width: 80%;height: 200px">
                                            </div>
                                            <div class="panel-footer">
                                                <a href="__PUBLIC__/generic/web/viewer.html?file=../../.<?php echo ($value['download_link']); ?>"><button class="btn btn-danger" style="width: 45%">在线打开</button></a>
                                                <?php if($value['can_upload']) {?>
                                                <a href="<?php
 $suffix_parts = path_info($value['download_link']); $suffix = $suffix_parts['extension']; $filename = $suffix_parts['filename']; echo U('Student/DownLoadBook',array('suffix'=>$suffix,'downfilename'=>$value['book_name'],'filename'=>$filename));?>"><button  class="btn btn-primary " style="width: 45%">下载</button></a>
                                                <?php }else {echo "<button class='btn btn-primary'  disabled='true'>不支持下载</button>";}?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }}?>
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
    </script>

</body>

</html>