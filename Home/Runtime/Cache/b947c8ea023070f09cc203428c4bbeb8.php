<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
这个暂时不急(暂时还不清楚对方的对于这个的需求)
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>顾问中心</title>

    <!-- Bootstrap Core CSS -->
    <link href="__PUBLIC__/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="__PUBLIC__/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="__PUBLIC__/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

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
                                <a href="<?php echo U('Admin/InformationCenter');?>">
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
                            <a class="text-center" href="<?php echo U('Admin/InformationCenter');?>">
                                <strong>查看所有消息</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- 中英文切换 -->
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-language fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><img src="__PUBLIC__/resource/img/chinese.png"></i>    &nbsp;&nbsp;中文&nbsp;&nbsp; </i><i class="fa  fa-check"></i></a>
                        </li>

                        <li class="divider"></li>
                        <li><a href="#"><img src="__PUBLIC__/resource/img/english.png"></i>    &nbsp;&nbsp;English</a>
                        </li>
                    </ul>
                </li> -->
                <!-- 用户 -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo U('Login/doLogout');?>"><i class="fa fa-sign-out fa-fw"></i> 注销</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>

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
                            <a href="<?php echo U('UserCenter/index');?>"><i class="fa fa-home fa-fw"></i> 顾问中心</a>
                        </li>
                        <!-- <li>
                            <a href="#"><i class="fa fa-mortar-board fa-fw"></i> 教师管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Admin/SearchTeacher');?>">搜索教师账户</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Admin/CheckTeacher');?>">查看教师</a>
                                </li>
                            </ul>
                        </li> -->

                        <li>
                            <a href="<?php echo U('Info/showManagedUser');?>/personType/teacher"> <i class="fa fa-mortar-board fa-fw"></i> 查看教师</a>
                        </li>

                        <!-- <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> 学员管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Admin/SearchStudent');?>">搜索学生账号</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Admin/CheckStudent');?>">分管学员</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Admin/MyStudent');?>">查看学员</a>
                                </li>
                            </ul>
                        </li> -->

                        <li>
                            <a href="<?php echo U('Info/showManagedUser');?>/personType/student/isMy/myStudent"> <i class="fa fa-users fa-fw"></i> 分管学员</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Info/showManagedUser');?>/personType/student/isMy/allStudent"> <i class="fa fa-users fa-fw"></i> 查看学员</a>
                        </li>


                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> 课程顾问信息<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <!-- <a href="Information.html">个人信息</a> -->
                                    <a href="<?php echo U('Info/Information');?>"> 课程顾问信息</a>
                                </li>
                                <li>
                                    <!-- <a href="ResetPassword.html">修改密码</a> -->
                                    <a href="<?php echo U('Info/resetPassword');?>">修改密码</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                             <a href="<?php echo U('Book/showBookInfo');?>"><i class="fa fa-exchange fa-fw"></i> 教材库</a>
                        </li>
                        <li>
                             <a href="<?php echo U('UserCenter/accessStudent');?>"><i class="fa fa-exchange fa-fw"></i> 接入学生</a>
                        </li>
                        <li>
                             <a href="<?php echo U('UserCenter/showAdminExam');?>"><i class="fa fa-hand-o-right fa-fw"></i> 顾问考核</a>
                        </li>
                         <li>
                             <a href="<?php echo U('UserCenter/showRule');?>"><i class="fa fa-question-circle fa-fw"></i> 顾问须知</a>
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
                        <h1 class="page-header">顾问考核</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo ($acceptStdNum); ?></div>
                                            <div>本月新学员分管人数</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">数据由来:新学员分管记录</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-calculator fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo ($mystdNum); ?></div>
                                            <div>本月老学员充值次数</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">数据由来:老学员充值记录</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-money fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo ($mystdMoney); ?></div>
                                            <div>本月老学员充值总金额</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">数据由来:老学员充值记录</span>
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
                                    考核规则
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="well">
                                            <h3>考核依据</h3>
                                        </div>
                                        <p>课程顾问考核依据为老学员充值次数,分管新学员人数.</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="well">
                                            <h3>计算公式</h3>
                                            <p>老学员充值考核分数:</p>
                                            <p>金额=充值次数*a+充值总金额*b</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="well">
                                            <p>这里的内容后面根据甲方改善</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">分管新学员记录</div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>学员编号</th>
                                            <th>学员账号</th>
                                            <th>联系方式</th>
                                            <th>分管时间</th>

                                        </tr>
                                    </thead>
                                        <?php if(is_array($res)): foreach($res as $key=>$value): ?><tbody>
                                            <tr>
                                                <td><?php echo ($value['ID']); ?></td>
                                                <td><?php echo ($value['account']); ?></td>
                                                <td><?php echo ($value['phone']); ?></td>
                                                <td><?php echo (date("Y-m-d H:i:s",$value['accept_time'])); ?></td>
                                            </tr><?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">老学员充值记录</div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>订单编号</th>
                                            <th>充值账号</th>
                                            <th>充值金额</th>
                                            <th>充值时间</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php if(is_array($mystd)): foreach($mystd as $key=>$value): ?><tr>
                                                <td><?php echo ($value['student_id']); ?></td>
                                                <td><?php echo ($value['account']); ?></td>
                                                <td><?php echo ($value['ope_money']); ?></td>
                                                <td><?php echo (date("Y-m-d H:i:s",$value['ope_time'])); ?></td>
                                            </tr><?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
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

    <!-- DataTables JavaScript -->
    <script src="__PUBLIC__/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="__PUBLIC__/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();
    </script>

</body>

</html>