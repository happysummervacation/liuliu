<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
试听课评论暂时没有完成
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Center</title>

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
                          <a href="<?php echo U('UserCenter/index');?>"><i class="fa fa-home fa-fw"></i> Teacher Center</a>
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
                            <a href="<?php echo U('Contract/showContract');?>"><i class="fa fa-gavel fa-fw"></i> Teacher Contracts</a>
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
                        <h1 class="page-header">Course Feedback</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Course Comment</div>
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#dayV" data-toggle="tab">Daily Comment</a>
                                </li>
                                <li><a href="#weekV" data-toggle="tab">Weekly Comment</a>
                                </li>
                                <li><a href="#mouthV" data-toggle="tab">Monthly Comment</a>
                                </li>
                                <li><a href="#testV" data-toggle="tab">Audition Comment</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="dayV">
                                    <h4>Daily Comment</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="display:none">Booking number</th>
                                                <th style="display:none">Course number</th>
                                                <th style="display:none">StudentID</th>
                                                <th>Students name</th>
                                                <th>Class time</th>
                                                <!-- <th>学员反馈评分</th> -->
                                                <!-- <th>教师评价</th> -->
                                                <th>Add notes</th>
                                                <!-- <th>Feedback</th> -->
                                                <th>Teacher`evaluation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach ($dayComData as $key => $value) {?>
                                            <tr>
                                                <td><?php echo ($i); ?></td>
                                                <td style="display:none"><?php echo ($value['oneorderclassID']); ?></td>
                                                <td style="display:none"><?php echo ($value['classID']); ?></td>
                                                <td style="display:none"><?php echo ($value['studentID']); ?></td>
                                                <td><?php echo ($value['englishname']); ?></td>
                                                <td><?php echo (date("Y-m-d H:i:s",$value['classStartTime'])); ?></td>
                                                <td><a href="#" data-toggle="modal" data-target=".bs-example-modal-sm1" class="getcolinfo">Click To Upload</a></td>
                                                <!-- <td><a href="#" data-toggle="modal" data-target=".bs-example-modal-sm2" class="getcolinfo AddRemark">Click To Add</a></td> -->
                                                <td><a href="#" data-toggle="modal" data-target=".bs-example-modal-sm" class="getcolinfo">Click To Evaluation</a></td>
                                            </tr>
                                        <?php $i++;}?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="weekV">
                                    <h4>Weekly Comment</h4>
                                     <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <!-- <th>评论编号</th>
                                                <th>学员编号</th>
                                                <th>学员姓名</th>
                                                <th>评论时间段</th>
                                                <th>评论截止时间</th>
                                                <th>教师评论</th> -->
                                                <th style="display:none">Comment number</th>
                                                <th style="display:none">Students number</th>
                                                <th>Students name</th>
                                                <th>Comment period</th>
                                                <th>Comment deadline</th>
                                                <th>Teacher review</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach ($weekComData as $key => $value) { ?>
                                                <tr>
                                                    <td><?php echo ($i); ?></td>
                                                    <td style="display:none"><?php echo ($value['oneteachercomID']); ?></td>
                                                    <td style="display:none"><?php echo ($value['studentID']); ?></td>
                                                    <td><?php echo ($value['englishname']); ?></td>
                                                    <td><?php echo (date("Y-m-d",$value['comStartTime'])); ?></td>
                                                    <td><?php echo (date('Y-m-d H:i',$value['comDeadline'])); ?></td>
                                                    <td>
                                                        <!-- <?php dump($value['comStatus']) ?> -->
                                                    <!-- <?php if($value['comment_type']=='11')echo '<a href="#" data-toggle="modal" data-target="#weekandmonth" class="getcolinfo">Click Evaluation</a>'; else {echo 'Has been commented';} ?> -->
                                                    <a href="#" data-toggle="modal" data-target="#weekandmonth" class="getcolinfo">Click Evaluation</a>
                                                    <!-- <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm" class="getcolinfo">点击评价</a> -->
                                                    </td>
                                                </tr>
                                            <?php $i++;}?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="mouthV">
                                    <h4>Monthly Comment</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <!-- <th>评论编号</th>
                                                <th>学员编号</th>
                                                <th>学员姓名</th>
                                                <th>评论时间段</th>
                                                <th>评论截止时间</th>
                                                <th>教师评论</th> -->
                                                <th style="display:none">Comment number</th>
                                                <th style="display:none">Student number</th>
                                                <th>Student name</th>
                                                <th>Comment period</th>
                                                <th>Comment deadline</th>
                                                <th>Teacher review</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach ($monthComData as $key => $value) { ?>
                                                <tr>
                                                    <td><?php echo ($i); ?></td>
                                                    <td style="display:none"><?php echo ($value['oneteachercomID']); ?></td>
                                                    <td style="display:none"><?php echo ($value['studentID']); ?></td>
                                                    <td><?php echo ($value['englishname']); ?></td>
                                                    <td><?php echo (date('Y-m-d H:i',$value['comStartTime'])); ?></td>
                                                    <td><?php echo (date('Y-m-d H:i',$value['comDeadline'])); ?></td>
                                                    <td>
                                                    <!-- <?php if($value['comment_type'] == '7') echo '<a href="#" data-toggle="modal" data-target="#weekandmonth" class="getcolinfo">Click to Write Comment</a>'; else {echo 'Writed';} ?> -->
                                                    <a href="#" data-toggle="modal" data-target="#weekandmonth" class="getcolinfo">Click to Write Comment</a>
                                                    </td>
                                                </tr>
                                            <?php $i++;}?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="testV">
                                    <h4>
                                      Audition Comment</h4>
                                     <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="display:none">Comment Number</th>
                                                <th style="display:none">Student Number</th>
                                                <th>Student Name</th>
                                                <th>Audition Date</th>
                                                <th>Teacher's Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach ($auditionComData as $key => $value) { ?>
                                                <tr>
                                                    <td><?php echo ($i); ?></td>
                                                    <td><?php echo ($value['comment_id']); ?></td>
                                                    <td style="display:none"><?php echo ($value['ID']); ?></td>
                                                    <td><?php echo ($value['englishname']); ?></td>
                                                    <td><?php echo ($value['comment_start_time']); ?></td>
                                                    <!-- <td><?php echo (date('Y-m-d H:i',$value['comment_deadline'])); ?></td>
                                                    <td>
                                                    <?php if($value['comment_type']=='11')echo '<a href="#" data-toggle="modal" data-target="#weekandmonth" class="getcolinfo">点击评价</a>'; else {echo '已经评论过了';} ?> -->
                                                    <td><a href="#" data-toggle="modal" data-target="#triallesson" class="getcolinfo" id="getCommentID">Click to Write Comment</a></td>
                                                    <!-- </td> -->
                                                </tr>
                                            <?php $i++;}?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="panel-footer" style="overflow: auto;">
                            <div class="pull-right">
                                <a data-target="#searchwithtime" data-toggle="modal" class="btn btn-primary">Comment History</a>
                            </div>
                        </div> -->
                        </div>
                    </div>

                    <div class="modal fade " id="searchwithtime" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                              Search by Time
                          </div>
                          <div class="modal-body">
                               <form class="form-horizontal" action="<?php echo U('Teacher/HistoryFeedBack');?>" method="post">
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Year:</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" name="year">
                                          <option>2016</option>
                                          <option>2017</option>
                                          <option>2018</option>
                                          <option>2019</option>
                                          <option>2020</option>
                                          <option>2021</option>
                                          <option>2022</option>
                                          <option>2023</option>
                                          <option>2024</option>
                                          <option>2025</option>
                                          <option>2026</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Month:</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" name="month">
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                          <option>6</option>
                                          <option>7</option>
                                          <option>8</option>
                                          <option>9</option>
                                          <option>10</option>
                                          <option>11</option>
                                          <option>12</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                </form>
                          </div>
                          <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary">提交</button>
                          </div> -->
                        </div>
                      </div>
                    </div>

                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                              Teacher's Comment
                          </div>
                          <div class="modal-body">
                               <form class="form-horizontal" action="<?php echo U('Comment/TeacherComment');?>" method="post">
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Comment Type:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable4 form-control" name="comment_type" readonly="true">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">OrderClassID:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable13 form-control" name="orderclassID" readonly="true">
                                    </div>

                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">ClassID:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable2 form-control" name="classID" readonly="true">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label ">StudentID:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable3 form-control" name="studentID" readonly="true">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Course Comment:</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" name="comment_level">
                                        <option>A(excellent)</option>
                                        <option>B(good)</option>
                                        <option>C(qualified)</option>
                                        <option>D(you need)</option>
                                        <option>E(work hard)</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Comment Content：</label>
                                    <div class="col-sm-8">
                                        <textarea name="feedback" class="form-control"></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Current Process:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="CurrentProcess" class="form-control" name="currentProcess">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Overall Process:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="OverallProcess" class="form-control" name="overallProcess">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label ">Class Remark:</label>
                                    <div class="col-sm-8">
                                        <textarea id="ClassRemark" class="form-control" name="classRemark"></textarea>
                                    </div>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade " id="weekandmonth" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                              Teacher's Comment
                          </div>
                          <div class="modal-body">
                               <form class="form-horizontal" action="<?php echo U('Comment/TeacherComment');?>" method="post">
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Comment Type:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable4 form-control" name="comment_type" readonly="true">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">CommentID:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable13 form-control" name="commentID" readonly="true">
                                    </div>

                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">StudentID:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable2 form-control" name="studentID" readonly="true">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label ">Student Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable6 form-control" name="student_name" readonly="true">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label ">Current Progress(not null):</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="current_progress">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label ">Future Progress(not null):</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="full_progress">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Course's Comment:</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" name="comment_level">
                                          <option>A(excellent)</option>
                                          <option>B(good)</option>
                                          <option>C(qualified)</option>
                                          <option>D(you need)</option>
                                          <option>E(work hard)</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Comment Content：</label>
                                    <div class="col-sm-8">
                                        <textarea name="feedback" class="form-control"></textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                </form>
                          </div>
                          <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary">提交</button>
                          </div> -->
                        </div>
                      </div>
                    </div>

                    <div class="modal fade bs-example-modal-sm1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                              Upload Class Note
                          </div>
                          <div class="modal-body">
                               <form enctype="multipart/form-data" class="form-horizontal" action="<?php echo U('Comment/teacherUploadNote');?>" method="post">
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">OrderClassID:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable13 form-control" name="orderclassID" readonly="true">
                                    </div>

                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">ClassID:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable2 form-control" readonly="true" name="classID">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">StudentID:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="fromtable3 form-control" readonly="true">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-4 control-label">Content:</label>
                                    <div class="col-sm-8">
                                        <!-- <button class="uploadbutton btn btn-default" style="width:100%;">
                                            <input name="file" type="file" nv-file-select="" uploader="uploader" multiple  />
                                            Add File
                                        </button> -->
                                        <textarea name="file"></textarea>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                </form>
                          </div>
                        </div>
                      </div>

                      <!-- <div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                                Upload Class Remark
                            </div>
                            <div class="modal-body">
                                 <form enctype="multipart/form-data" class="form-horizontal" action="<?php echo U('Teacher/ClassRemarkChange');?>" method="post">
                                   <input  id="StudentID" readonly="true" type="text" class="fromtable3 form-control" name="StudentID">
                                   <input  id="ClassID" readonly="true" type="text" class="fromtable2 form-control" name="ClassID">

                                    <div class="form-group">
                                      <label  class="col-sm-4 control-label">Current Process:</label>
                                      <div class="col-sm-8">
                                          <input type="text" id="CurrentProcess" class="form-control" name="currentProcess">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label  class="col-sm-4 control-label">Overall Process:</label>
                                      <div class="col-sm-8">
                                          <input type="text" id="OverallProcess" class="form-control" name="overallProcess">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label  class="col-sm-4 control-label ">Class Remark:</label>
                                      <div class="col-sm-8">
                                          <textarea id="ClassRemark" class="form-control" name="classRemark"></textarea>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                  </form>
                            </div>
                          </div>
                        </div> -->

                      <div class="modal fade " id="triallesson" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                                Audition Comnment
                            </div>
                            <div class="modal-body">
                                 <form class="form-horizontal" action="<?php echo U('Teacher/UploadtrailLessonComment');?>" method="post">
                                   <div class="form-group">
                                     <label  class="col-sm-4 control-label">Booking Number:</label>
                                     <div class="col-sm-8">
                                       <input name="comment_id" value="" readonly="true" class="col-sm-8" id="UploadCommentID"/>
                                     </div>
                                   </div>
                                    <div class="form-group">
                                      <label  class="col-sm-4 control-label">Student Level:</label>
                                      <div class="col-sm-8">
                                          <select class="form-control" name="student_level">
                                            <option value="E(Newbie)"></option>
                                            <option value="D(Beginner)"></option>
                                            <option value="C(General)"></option>
                                            <option value="B(Excellent)"></option>
                                            <option value="A(Master)"></option>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label  class="col-sm-4 control-label">Listening Level:</label>
                                      <div class="col-sm-8">
                                        <select class="form-control" name="listen_level">
                                          <option value="E(Newbie)"></option>
                                          <option value="D(Beginner)"></option>
                                          <option value="C(General)"></option>
                                          <option value="B(Excellent)"></option>
                                          <option value="A(Master)"></option>
                                        </select>
                                      </div>

                                    </div>
                                    <div class="form-group">
                                      <label  class="col-sm-4 control-label">Speaking Level:</label>
                                      <div class="col-sm-8">
                                        <select class="form-control" name="speak_level">
                                          <option value="E(Newbie)"></option>
                                          <option value="D(Beginner)"></option>
                                          <option value="C(General)"></option>
                                          <option value="B(Excellent)"></option>
                                          <option value="A(Master)"></option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label  class="col-sm-4 control-label ">Reading Level:</label>
                                      <div class="col-sm-8">
                                        <select class="form-control" name="read_level">
                                          <!-- <option value="E">Newbie</option>
                                          <option value="D">Beginner</option>
                                          <option value="C">General</option>
                                          <option value="B">Excellent</option>
                                          <option value="A">Master</option> -->
                                          <option value="E(Newbie)"></option>
                                          <option value="D(Beginner)"></option>
                                          <option value="C(General)"></option>
                                          <option value="B(Excellent)"></option>
                                          <option value="A(Master)"></option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label  class="col-sm-4 control-label">Writting Level:</label>
                                      <div class="col-sm-8">
                                        <select class="form-control" name="write_level">
                                          <option value="E(Newbie)"></option>
                                          <option value="D(Beginner)"></option>
                                          <option value="C(General)"></option>
                                          <option value="B(Excellent)"></option>
                                          <option value="A(Master)"></option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label  class="col-sm-4 control-label">Comment Content:</label>
                                      <div class="col-sm-8">
                                          <textarea name="feedback" class="form-control"></textarea>
                                      </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
    </script>

    <script type="text/javascript">
        $('#getCommentID').click(function(){
            var comment_id = $("#getCommentID").parent().parent().children().eq(1).html();
            // alert(comment_id);
            $("#UploadCommentID").val(comment_id);
        })
    </script>

    <script>
        $('.AddRemark').click(function(){
            ClassID = $(this).parent().parent().children().eq(2).html();
            StudentID = $(this).parent().parent().children().eq(3).html();

            $('#CurrentProcess').val("");
            $('#OverallProcess').val("");
            $('#ClassRemark').val("");
            $('#StudentID').val("");
            $('#ClassID').val("");

            $.ajax({
              type:'POST',
              url:"<?php echo U('Teacher/GetStudentProcessAndClassRemark');?>",
              data:"ClassID="+ClassID+"&"+"StudentID="+StudentID+"&type=echo",
              success:function(msg){
                  var getData = JSON.parse(msg)
                  $('#CurrentProcess').val(getData[0]['book_progress']);
                  $('#OverallProcess').val(getData[0]['book_full_progress']);
                  $('#ClassRemark').val(getData[1]['remark']);
                  $('#StudentID').val(StudentID);
                  $('#ClassID').val(ClassID);
              },
              error:function(msg){
                  alert("Get Data Failed");
              }
            })
        });
    </script>

</body>

</html>