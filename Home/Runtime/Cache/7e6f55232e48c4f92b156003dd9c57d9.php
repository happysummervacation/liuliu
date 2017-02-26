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

	<link href="__PUBLIC__/css/MyPackage.css" type="text/css">
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
                                    <a  href="<?php echo U('UserCenter/getManageInfo');?>"><i class="fa fa-legal fa-fw"></i> 已有套餐</a>
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
                        <h1 class="page-header">我的套餐</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-4 col-md-6">
	                    <div class="panel panel-red">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-coffee fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">
                                        	<?php echo ($classCount); ?>
                                        </div>
	                                    <div>剩余课时</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="#classincoding">
	                            <div class="panel-footer">
	                                <span class="pull-left">课时记录</span>
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
	                                    <i class="fa fa-star fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">
	                                    	<?php echo ($packageCount); ?>
	                                    </div>
	                                    <div>可用套餐</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="#packagecoding">
	                            <div class="panel-footer">
	                                <span class="pull-left">套餐历史</span>
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
	                                    <i class="fa fa-credit-card fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">
                                            <?php echo ($money); ?>
                                        </div>
	                                    <div>账户余额</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="#boughtcoding">
	                            <div class="panel-footer">
	                                <span class="pull-left">消费历史</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
                	</div>
                </div>
                <div class="row">
	                <div class="col-lg-12">
	                    <div class="panel panel-red" name="classincoding">
	                        <div class="panel-heading">
	                            课时消费历史
	                        </div>
	                        <!-- /.panel-heading -->
	                        <div class="panel-body">
	                            <div class="table-responsive" style="height: 300px;overflow: auto;">
	                                <table class="table table-hover">
	                                    <thead>
	                                        <tr>
	                                            <th>订单编号</th>
	                                            <th style="display:none">课程编号</th>
	                                            <th>课程类型</th>
	                                            <th>任课教师</th>
	                                            <th>上课时间</th>
	                                            <th>消耗课时</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
                                        <?php if(is_array($student_consume_result)): foreach($student_consume_result as $key=>$vo): ?><tr>
	                                            <td><?php echo ($vo["orderclass_id"]); ?></td>
	                                            <td style="display:none"><?php echo ($vo["class_id"]); ?></td>
	                                            <td><?php echo ($vo["class_type"]); ?></td>
	                                            <td><?php echo ($vo["englishname"]); ?></td>
                                              <td><?php echo (date('Y-m-d H:i:s',$vo["start_time"])); ?></td>
	                                            <td>1</td>
	                                        </tr><?php endforeach; endif; ?>
	                                    </tbody>
	                                </table>
	                            </div>
	                            <!-- /.table-responsive -->
	                        </div>
	                        <!-- /.panel-body -->
	                    </div>
	                    <!-- /.panel -->
	                </div>
	                <!-- /.col-lg-6 -->
	            </div>
	            <div class="row">
	            	<div class="col-lg-12">
	                    <div class="panel panel-primary" id="packagecoding">
	                        <div class="panel-heading">
	                            可用套餐
	                        </div>
	                        <!-- /.panel-heading -->
                          <!-- <?php dump($package_list);?> -->
	                        <div class="panel-body">
	                            <div class="table-responsive" style="height: 300px;overflow: auto;">
	                                <table class="table table-hover">
	                                    <thead>
	                                        <tr>
	                                            <th>订单编号</th>
	                                            <th style="display:none">套餐编号</th>
	                                            <th>套餐类型</th>
	                                            <th>有效期至</th>
	                                            <th>已用/总数</th>
	                                            <th>套餐价格(RMB)</th>
                                              <th>状态</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                    	<?php if(is_array($package_list)): foreach($package_list as $key=>$vo): ?><tr>
                                                <td><?php echo ($vo["orderpackage_id"]); ?></td>
                                                <td style="display:none"><?php echo ($vo["package_id"]); ?></td>
                                                <td><?php echo ($vo['package_category']); ?>/<?php echo ($vo["package_type"]); ?></td>
                                                <td><?php echo ($vo["end_time"]); ?></td>
                                                <td><?php echo ($vo["have_class"]); ?>/<?php echo $vo['total_class']+$vo['other_class'];?></td>
                                                <td><?php echo ($vo["package_money"]); ?></td>
                                                <td>
                                                  <!--课程一旦用完订购的对应套餐就设为失效-->
                                                  <?php if($vo['status'] == '0'){echo "失效";} else {echo "有效";}?>
                                                </td>
                                            </tr><?php endforeach; endif; ?>
                                        </tbody>
	                                </table>
	                            </div>
	                            <!-- /.table-responsive -->
	                        </div>
	                        <!-- /.panel-body -->
	                    </div>
	                    <!-- /.panel -->
	                </div>
	                <!-- /.col-lg-6 -->
	            </div>
	            <div class="row">
                <div class="col-lg-12" id="boughtcoding">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                           	 消费历史
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" style="height: 300px;overflow: auto;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>交易时间</th>
                                            <th>交易内容</th>
                                            <th>交易金额</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php if(is_array($trade_list)): foreach($trade_list as $key=>$vo): ?><tr>
                                            <td><?php echo ($vo["ope_id"]); ?></td>
                                            <td><?php echo ($vo["ope_time"]); ?></td>
                                            <td><?php echo ($vo["remark"]); ?></td>
                                            <td><?php echo ($vo["ope_money"]); ?></td>
                                        </tr><?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             送课历史
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" style="height: 300px;overflow: auto;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>操作人</th>
                                            <th>送课时间</th>
                                            <th>赠送课时</th>
                                            <th>赠送原因</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(is_array($sendclass_result)): foreach($sendclass_result as $key=>$vo): ?><tr>
                                            <td><?php echo ($vo["chinesename"]); ?>-管理员</td>
                                            <td><?php echo ($vo["send_time"]); ?></td>
                                            <td><?php echo ($vo["send_number"]); ?></td>
                                            <td><?php echo ($vo["remark"]); ?></td>
                                        </tr><?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>

            <div class="row">
              <div class="col-lg-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                           停课记录
                      </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                          <div class="table-responsive" style="height: 300px;overflow: auto;">
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>停课开始时间</th>
                                          <th>停课结束时间</th>
                                          <th>操作人</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php if(is_array($stopclass)): foreach($stopclass as $key=>$vo): ?><tr>
                                          <td><?php echo (date('Y-m-d',$vo["stop_start_time"])); ?></td>
                                          <td><?php echo (date('Y-m-d',$vo["stop_end_time"])); ?></td>
                                          <td><?php echo ($vo["chinesename"]); ?>-管理员</td>
                                      </tr><?php endforeach; endif; ?>
                                  </tbody>
                              </table>
                          </div>
                          <!-- /.table-responsive -->
                      </div>
                      <!-- /.panel-body -->
                  </div>
                  <!-- /.panel -->
              </div>
              <!-- /.col-lg-6 -->
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