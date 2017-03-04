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
                        <h1 class="page-header">套餐延期</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                    	<div class="panel panel-primary">
                    		<div class="panel-heading">
                    			可延期套餐
                    		</div>
                    		<table class="table">
                    			 <thead>
                    			 	<tr>
                    			 		<th>订单编号</th>
                    			 		<th style="display:none">套餐编号</th>
                    			 		<th>套餐类型</th>
                              <th>教师类型</th>
                              <th>课时数量</th>
                              <th>学生数量</th>
                              <th>有效时长</th>
                             <!--  <th>可停课次数</th> -->
                    			 		<!-- <th>套餐还可延期</th> -->
                    			 		<th>套餐延期</th>
                              <!--<th>
                                停课申请
                              </th> -->
                    			 	</tr>
                    			 </thead>
                    			 <tbody>
                    			 	<?php if(is_array($package_list)): foreach($package_list as $key=>$vo): if($vo['status']) { ?>
                    			 	<tr>
                    			 		<td><?php echo ($vo["orderpackageID"]); ?></td>
                    			 		<td style="display:none"><?php echo ($vo["package_id"]); ?></td>
                      			 		<td><?php echo ($vo["packageName"]); ?>/
                                <?php if($vo['packageType'] == 0) {echo "课时类";}else{echo "卡类";} ?>/
                                <?php if($vo['classType'] == 0) {echo "一对一";}else{echo"小班";} ?></td>
                              <td> <?php if($vo['teacherNation'] == 0) {echo "中教";}else{echo "外教";} ?>/
                                <?php if($vo['teacherType'] == 0) {echo "普通";}else{echo "名师";} ?></td>
                              <td><?php echo ($vo["classNumber"]); ?></td>
                              <td><?php echo ($vo["studentNumber"]); ?></td>
                    			 		<td><?php echo (date('Y-m-d',$vo["startTime"])); ?>/<?php echo (date('Y-m-d',$vo["endTime"])); ?></td>
                    			 		<!-- <td><?php echo ($vo["delay_month"]); ?>个月</td> -->
  
                    			 		<td><a href="" data-toggle="modal" data-target=".bs-example-modal-sm" class="getcolinfo">申请延期</a></td>
                             <!--  <td><a href="" data-toggle="modal" data-target=".bs-example-modal-sm2" class="getcolinfo">申请停课</a></td> -->
                    			 	</tr>
                            <?php } endforeach; endif; ?>
                    			 	<!-- <tr>
                    			 		<td>1</td>
                    			 		<td>568923</td>
                    			 		<td>新生套餐</td>
                    			 		<td>30课时</td>
                    			 		<td>2016/1/1-2016/3/1</td>
                    			 		<td><a href="" data-toggle="modal" data-target=".bs-example-modal-sm" class="getcolinfo">点击申请延期</a></td>
                    			 	</tr> -->
                    			 </tbody>
                    		</table>
                    	</div>
                    </div>
                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          					  <div class="modal-dialog modal-sm">
          					    <div class="modal-content">
          					      <div class="modal-header">
          					      	申请延期(使用余额)
          					      </div>
          					      <div class="modal-body">
          						      	<div>
          								  <!-- Nav tabs -->
          								  <ul class="nav nav-tabs" role="tablist">
          								    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">免费延期</a></li> -->
          								    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">付费延期</a></li>
          								  </ul>
          								  <!-- Tab panes -->
          								  <div class="tab-content">

          								    <div role="tabpanel" class="tab-pane active" id="profile">
          								    	<form class="form-horizontal" action="<?php echo U('Student/MoneyDelayPackageAction');?>" method="post">
          								    		<div class="form-group">
          								    			<br>
          											    <label class="col-sm-4 control-label">订单编号:</label>
          											    <div class="col-sm-6">
          											      <input type="text" class="fromtable1 form-control" name="orderpackage_id" readonly="true">
          											    </div>
          											</div>
          											<div class="form-group">
          											    <label class="col-sm-4 control-label">套餐类型:</label>
          											    <div class="col-sm-6">
          											      <input type="text" class="fromtable2 form-control" readonly="true">
          											    </div>
          											</div>
          											<div class="form-group">
          											    <label class="col-sm-4 control-label">所需价格:</label>
          											    <div class="col-sm-6">
          											      <label class="control-label" id="countmoney">100元/月</label>
          											    </div>
          											</div>
          											<div class="form-group">
          											    <label class="col-sm-4 control-label">延期时长:</label>
          											    <div class="col-sm-6">
          											      <select class="form-control" name="delay_month" id="delaymonthnumber">
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
          											    <label class="control-label col-sm-1">月</label>
          											</div>
          											<div class="control-group" style="overflow: auto;">
          												<div  class="pull-right">
          										      		<button class="btn btn-default" data-dismiss="modal">
          										      			取消
          										      		</button>
                                        <button class="btn btn-warning" type="submit">
                                           	延期
                                        </button>
          										        </div>
          											</div>
          								    	</form>
          								    </div>
          								  </div>
          								</div>
          					      </div>
          					      <!-- <div class="modal-footer">
          					      		<button class="btn btn-default" data-dismiss="modal">
          					      			取消
          					      		</button>
          					      		<button class="btn btn-primary">
          					      			提交
          					      		</button>
          					      </div> -->
          					    </div>
          					  </div>
          					</div>
                    <div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          					  <div class="modal-dialog modal-md">
          					    <div class="modal-content">
          					      <div class="modal-header">
          					      	申请停课
          					      </div>
          					      <div class="modal-body">
          						      	<div>
          								  <!-- Nav tabs -->
          								  <ul class="nav nav-tabs" role="tablist">
          								    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">免费延期</a></li> -->
          								    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">停课申请</a></li>
          								  </ul>
          								  <!-- Tab panes -->
          								  <div class="tab-content">

          								    <div role="tabpanel" class="tab-pane active" id="profile">
          								    	<form class="form-horizontal" action="<?php echo U('Student/ApplyStopClass');?>" method="post">
          								    		<div class="form-group">
          								    			<br>
          											    <label class="col-sm-4 control-label">申请编号：</label>
          											    <div class="col-sm-6">
          											      <input type="text" class="fromtable1 form-control" name="orderpackage_id" readonly="true">
          											    </div>
          											</div>
          											<!-- <div class="form-group">
          											    <label class="col-sm-4 control-label">套餐类型:</label>
          											    <div class="col-sm-6">
          											      <input type="text" class="fromtable2 form-control" readonly="true">
          											    </div>
          											</div> -->
          											<div class="form-group">
                                    <label class="col-sm-4 control-label">起始时间：</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="stop_start_time" class="calendar form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">截止时间：</label>
                                  <div class="col-sm-6">
                                        <input type="text" name="stop_end_time" class="calendar form-control">
                                    </div>
          											</div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">停课理由：</label>
                                  <div class="col-sm-6">
                                    <textarea name="reason" rows="3" cols="20" class="form-control"></textarea>
                                  </div>
                                </div>
          											<div class="control-group" style="overflow: auto;">
          												<div  class="pull-right">
          										      		<button class="btn btn-default" data-dismiss="modal">
          										      			取消
          										      		</button>
          	                            <button class="btn btn-warning" type="submit">
          	                              停课
          	                            </button>
          										        </div>
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

    <!-- 时间选择插件 -->
    <script src="__PUBLIC__/tool/flatpickr.min.js"></script>

<!--     <script type="text/javascript">
    	$(".getcolinfo").click(function() {
    		$(".fromtable1").html($(this).parent().siblings(':first').next().html());
    		$(".fromtable2").html($(this).parent().siblings(':first').next().next().html());
    	})
    </script> -->

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();
        //初始化时间选择器
        $(".calendar").flatpickr({
            "enableTime": true,
            "minuteIncrement":30,
            "time_24hr": true,
            minDate:new Date()
        });

        $("#delaymonthnumber").change(function(){
          $('#countmoney').html("共计"+$(this).val()*100+"元");
        })
    </script>

</body>

</html>