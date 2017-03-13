<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

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
                        <h1 class="page-header">Teacher's Salary</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Salary Records For This Month</div>
                            <div>
                            <table class="table">
                                <tbody>
                                  <tr>
                                    <td>
                                      Period
                                    </td>
                                    <td>
                                      <?php echo (date('Y-m-d',$month_start_time)); ?>~ <?php echo (date('Y-m-d',$month_end_time)); ?>
                                    </td>
                                    <td>
                                      Setting
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Children's Course(Normal/Absence/Cancel)
                                    </td>
                                    <td>
                                      <?php echo ($class_result['young_classed_number']); ?>
                                      /<?php echo ($class_result['young_teacher_absent']); ?>
                                      /<?php echo ($class_result['young_teacher_withdraw']); ?>
                                    </td>
                                    <td>
                                      <?php echo ($money_bonus['childclass']); ?> yuan/class
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Adult's Course(Normal/Absence/Cancel)
                                    </td>
                                    <td>
                                      <?php echo ($class_result['adult_classed_number']); ?>
                                      /<?php echo ($class_result['adult_teacher_absent']); ?>
                                      /<?php echo ($class_result['adult_teacher_withdraw']); ?>
                                    </td>
                                    <td>
                                      <?php echo ($money_bonus['adultclass']); ?> yuan/class
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      IELTS's Course(Normal/Absence/Cancel)
                                    </td>
                                    <td>
                                      <?php echo ($class_result['IELTS_classed_number']); ?>
                                      /<?php echo ($class_result['IELTS_teacher_absent']); ?>
                                      /<?php echo ($class_result['IELTS_teacher_withdraw']); ?>
                                    </td>
                                    <td>
                                      <?php echo ($money_bonus['ieltsclass']); ?> yuan/class
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Group Course(Normal/Absence/Cancel)
                                    </td>
                                    <td>
                                      <?php echo ($class_result['many_classed_number']); ?>
                                      /<?php echo ($class_result['many_teacher_absent']); ?>
                                      /<?php echo ($class_result['many_teacher_withdraw']); ?>
                                    </td>
                                    <td>
                                      <?php echo ($money_bonus['groupclass']); ?> yuan/class
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Daily Comment
                                    </td>
                                    <td>
                                      <?php echo ($comment_result['day_comment']); ?>/<?php echo ($comment_result['day_comment_sum']); ?>
                                    </td>
                                    <td>
                                      <?php echo ($money_bonus['day_comment_bonus']); ?>%
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Weekly Comment
                                    </td>
                                    <td>
                                      <?php echo ($comment_result['week_comment']); ?>/<?php echo ($comment_result['week_comment_sum']); ?>
                                    </td>
                                    <td>
                                      <?php echo ($money_bonus['week_comment_bonus']); ?>%
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Monthly Comment
                                    </td>
                                    <td>
                                      <?php echo ($comment_result['month_comment']); ?>/<?php echo ($comment_result['month_comment_sum']); ?>
                                    </td>
                                    <td>
                                      <?php echo ($money_bonus['month_comment_bonus']); ?>%
                                    </td>
                                  </tr>
<!--                                   <tr>
                                    <td>
                                      Total Video Upload
                                    </td>
                                    <td>
                                      <?php echo ($video_result['video_number']); ?>
                                    </td>
                                    <td>
                                      <?php echo ($money_bonus['video_bonus']); ?>
                                    </td>
                                  </tr> -->
                                  <tr>
                                    <td>
                                      Total Amount
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                      <?php echo ($totalMoney); ?>
                                    </td>
                                  </tr>
                                  <th></th>
                                </tbody>
                            </table>
                            </div>
                            <div class="panel-footer" style="overflow: auto">
                                <div class="pull-right">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Salary History</button>
                                </div>
                            </div>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Search By Time</h4>
                                  </div>
                                  <div class="modal-body" style="overflow: auto">
                                    <form role="form" action="<?php echo U('Teacher/SearchMonthMoney');?>" method="post">
                                      <div class="form-group col-lg-4">
                                        <label for="exampleInputEmail1">Year</label>
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
                                        </select>
                                      </div>
                                      <div class="form-group col-lg-4">
                                        <label for="exampleInputPassword1">Start Month</label>
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
                                      <!-- <div class="form-group col-lg-4">
                                        <label for="exampleInputFile">结束月</label>
                                        <select class="form-control">
                                            <option>1月</option>
                                            <option>2月</option>
                                            <option>3月</option>
                                            <option>4月</option>
                                            <option>5月</option>
                                            <option>6月</option>
                                            <option>7月</option>
                                            <option>8月</option>
                                            <option>9月</option>
                                            <option>10月</option>
                                            <option>11月</option>
                                            <option>12月</option>
                                        </select>
                                      </div> -->
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