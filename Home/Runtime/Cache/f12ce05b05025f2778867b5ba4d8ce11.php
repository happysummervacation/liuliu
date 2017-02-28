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
                          <a href="<?php echo U('Teacher/index');?>"><i class="fa fa-home fa-fw"></i> Teacher Center</a>
                        </li>
                            <li>
                                <a href="<?php echo U('Class/getTeacherClassPlan');?>"><i class="fa fa-calendar fa-fw"></i> Current Month's Schedule</a>
                            </li>
                             <li>
                                <a href="<?php echo U('Teacher/Feedback');?>"><i class="fa fa-calendar fa-fw"></i> Course Feedback</a>
                            </li>
                            <li>
                               <a href="<?php echo U('Teacher/HistoryFeedback');?>"><i class="fa fa-calendar fa-fw"></i> Feedback History</a>
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
                                    <a href="<?php echo U('Teacher/MyMoney');?>"> Teacher Salary</a>
                                </li>
                                <li>
                                    <!-- <a href="HowCaculate.html">工资计算</a> -->
                                    <a href="<?php echo U('Teacher/HowCaculate');?>"> Salary Settlement</a>
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
                        <h1 class="page-header">Upload Video</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-4 col-md-offset-4" style="margin-top: 80px;">
                        <div class="panel panel-red">
                            <div class="panel-heading">Upload Video</div>
                            <div class="panel-body">
                                <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo U('Video/uploadIntroductionVideo');?>" method="post">
                                      <!-- <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Video Name:</label>
                                        <div class="col-sm-7">
                                          <input name="video_name" type="text" class="form-control" id="inputEmail3" placeholder="Name">
                                        </div>
                                      </div> -->
                                      <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Video Type:</label>
                                        <div class="col-sm-7">
                                          <select class="form-control" name="video_type">
                                              <option value="1">Introduction Video</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-4 control-label">Video File(no more 100M):</label>
                                        <div class="col-sm-7">
                                            <input type="file" nv-file-select="" multiple   name="video" value="Upload Video" id="uploadinput"/>
                                        </div>
                                        
                                      </div>
                                      <div class="form-group">
                                        <br>
                                        <div class="col-sm-offset-2 col-sm-8">
                                          <button type="submit" class="btn btn-danger" style="width: 100%;">Upload</button>
                                        </div>
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
<script>
  // $(function(){
  //   if(isFirefox=navigator.userAgent.indexOf("Firefox")>0){
  //     $('.uploadbutton').click(function(){
  //       alert('aaa');
  //       $('#uploadinput').click(function(e){
  //         window.event? window.event.cancelBubble = true : e.stopPropagation();
  //       });

  //     })
  //   }
  // })
</script>
</body>

</html>