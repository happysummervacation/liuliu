<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
这里加一个停课操作(是否要加停课操作??)
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>系统中心</title>

    <!-- Bootstrap Core CSS -->
    <link href="__PUBLIC__/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="__PUBLIC__/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="__PUBLIC__/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="__PUBLIC__/bower_components/datatables-responsive/css/responsive.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/bower_components/datatables-responsive">
    <!-- Custom CSS -->
    <link href="__PUBLIC__/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="__PUBLIC__/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                      <i class="fa fa-envelope fa-fw"></i>
                      <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php if(is_array($unreadmessage)): foreach($unreadmessage as $key=>$value): if(($value['isdelete']) == "0"): ?><li>
                                <a href="<?php echo U('Root/InformationCenter');?>">
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
                        <!-- 9.06修改01 -->
                            <a class="text-center" href="<?php echo U('Root/InformationCenter');?>">
                                <strong>查看所有消息</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        <!-- //9.06修改01 -->
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
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
                            <a href="<?php echo U('UserCenter/index');?>"><i class="fa fa-home fa-fw"></i> 系统中心</a>
                        </li>
                        <!-- <li>
                            <a href="#"><i class="fa fa-mortar-board fa-fw"></i> 教师管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Root/SearchTeacher');?>">搜索教师</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Root/CheckTeacher');?>">查看教师</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Root/CreateTeacher');?>">创建教师</a>
                                </li>
                            </ul>
                        </li> -->

                        <li>
                            <a href="<?php echo U('Root/SearchTeacher');?>"> <i class="fa fa-mortar-board fa-fw"></i> 搜索教师</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Info/showManagedUser');?>/personType/teacher"> <i class="fa fa-mortar-board fa-fw"></i> 查看教师</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Info/showCreateUser');?>/personType/teacher"> <i class="fa fa-mortar-board fa-fw"></i> 创建教师</a>
                        </li>

                        <!-- <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> 学员管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Root/SearchStudent');?>">搜索学生</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Root/CheckStudent');?>">查看学生</a>
                                </li>
                            </ul>
                        </li> -->
                        <li>
                             <a href="<?php echo U('Group/GroupManage');?>"><i class="fa fa-bell fa-fw"></i> 小班管理</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Root/SearchStudent');?>"> <i class="fa fa-users fa-fw"></i> 搜索学生</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Info/showManagedUser');?>/personType/student"> <i class="fa fa-users fa-fw"></i> 查看学生</a>
                        </li>

                        <!-- <li>
                            <a href="#"><i class="fa fa-umbrella fa-fw"></i> 顾问管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Root/SearchAdmin');?>">搜索顾问</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Root/CheckAdmin');?>">查看顾问</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Root/CreateAdmin');?>">创建顾问</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Root/DownloadLogfile');?>">
                                    操作历史
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <li>
                            <a href="<?php echo U('Root/SearchAdmin');?>"> <i class="fa fa-umbrella fa-fw"></i> 搜索顾问</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Info/showManagedUser');?>/personType/admin"> <i class="fa fa-umbrella fa-fw"></i> 查看顾问</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Info/showCreateUser');?>/personType/admin"> <i class="fa fa-umbrella fa-fw"></i> 创建顾问</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Root/DownloadLogfile');?>"> <i class="fa fa-umbrella fa-fw"></i>
                            操作历史
                            </a>
                        </li>

                        <!-- <li>
                          <a href="#"><i class="fa fa-umbrella fa-fw"></i> 最高管理员管理<span class="fa arrow"></span></a>
                          <ul class="nav nav-second-level">
                              <li>
                                  <a href="<?php echo U('Root/Information');?>">查看管理员</a>
                              </li>
                              <li>
                                  <a href="<?php echo U('Root/CreateRoot');?>">创建管理员</a>
                              </li>
                          </ul>
                        </li> -->

                        <li>
                            <a href="<?php echo U('Info/Information');?>"> <i class="fa fa-umbrella fa-fw"></i> 查看管理员</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Info/showCreateUser');?>/personType/root"> <i class="fa fa-umbrella fa-fw"></i> 创建管理员</a>
                        </li>



                        <li>
                            <a href="#"><i class="fa fa-laptop fa-fw"></i> 系统管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('System/showSystemSet');?>"> 参数设置</a>
                                </li>
                                <li>
                                     <a href="<?php echo U('Package/packageShow');?>"> 套餐管理</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Root/salaryMgr');?>">
                                        工资管理
                                    </a>
                                    <!-- <a href="">
                                        工资管理
                                    </a> -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-suitcase fa-fw"></i> 材料管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Book/showBookInfo');?>"> 教材管理</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Root/OtherMaterial');?>"> 其他教材管理</a>
                                </li>
                                 <li>
                                     <a href="<?php echo U('Root/VideoManage');?>"> 视频管理</a>
                                </li>
                            </ul>
                                    <!-- /.nav-second-level -->
                        </li>
                        <li>
                             <a href="<?php echo U('Root/Message');?>"><i class="fa fa-bell fa-fw"></i> 消息推送</a>
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
                        <h1 class="page-header">查看学员</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            学员列表
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="display:none">学员编号</th>
                                            <th>学员账号</th>
                                            <th>中文名</th>
                                            <th>英文名</th>
                                            <th>微信</th>
                                            <th>QQ</th>
                                            <th>phone</th>
                                            <th>email</th>
                                            <!-- <th>学员信息</th> -->
                                            <th>学员课表</th>
                                            <th>学员套餐</th>
                                            <th>账户余额</th>
                                            <th>账号状态</th>
                                            <th>停课时间</th>
                                            <th>系统操作</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <?php $i = 1; foreach ($students as $key => $value) {?>
                                        <tr>
                                            <td style="display:none" class="studentID"><?php echo ($value['ID']); ?></td>
                                            <td><?php echo ($value['account']); ?></td>
                                            <td><?php echo ($value['chinesename']); ?></td>
                                            <td><?php echo ($value['englishname']); ?></td>
                                            <td><?php echo ($value['weixin']); ?></td>
                                            <td><?php echo ($value['QQ']); ?></td>
                                            <td><?php echo ($value['phone']); ?></td>
                                            <td><?php echo ($value['email']); ?></td>
                                            <!-- <td><a href="" data-toggle="modal" data-target=".bs-example-modal-lg1" class="getpersoninfo">信息查看</a></td> -->
                                            <td><a href="<?php echo U('OrderClass/getStudentOrderClassTimeTable', array('user_id'=>$value['ID']));?>">课表查看</a></td>
                                            <td><a href="<?php echo U('Package/studentPackageShow',array('user_id'=>$value['ID']));?>">套餐查看</a></td>
                                            <td><?php echo ($value['student_sum_money']); ?></td>
                                            <td><?php if($value['status'] == 1) {echo "可用";} else {echo "不可用";}?></td>
                                            <td>
                                              <!-- <a href="#" data-toggle="modal" data-target="#stopclass" id="getstopclass">停课时间</a> -->

                                              <a data-toggle="modal" data-target="#stopclass" class="getstopclass">停课时间</a>
                                            </td>
                                            <td>
                                                <?php if(($value['status']) == "1"): ?><a href="<?php echo U('Info/UserManage', array('personType'=>'student','type'=>'resetStatus','user_id'=>$value['ID'],'status'=>'0'));?>">
                                                         <button class="btn btn-primary" style="margin:5px">禁用账号</button>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo U('Info/UserManage',array('personType'=>'student','type'=>'resetStatus','user_id'=>$value['ID'],'status'=>'1'));?>">
                                                         <button class="btn btn-primary" style="margin:5px">启用账号</button>
                                                    </a><?php endif; ?>
                                                <span>&nbsp;</span>
                                                <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg2" class="chongqian">
                                                    <button class="btn btn-primary" style="margin:5px">余额充值</button>
                                                </a>
                                                <button class="editStudent btn btn-primary" style="margin:5px">修改</button>
                                                <a href="<?php echo U('Info/ResetPassword',array('type'=>'check','user_id'=>$value['account']));?>" class="resetPasswordID"><button class="btn btn-primary" style="margin:5px">一键重置密码</button></a>
                                                <a href="<?php echo U('Info/UserManage',array('personType'=>'student','type'=>'delete','user_id'=>$value['ID']));?>" class="removeAccountID"><button class="btn btn-primary" style="margin:5px">彻底删除</button></a>
                                                <a href="#" data-toggle="modal" data-target="#modalmoneyinfo" class="stoppackage"><button type="button" name="button" class="btn btn-primary" style="margin:5px">停课</button></a>
                                            </td>
                                        </tr>
                                    <?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 模态框5,套餐停课处理 -->
                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalmoneyinfo">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                      停课申请
                                      </div>
                                      <div class="modal-body"  style="overflow: auto;">
                                          <form class="form" method="post" action="<?php echo U('StopClass/StopClassManage',array('type'=>'apply'));?>">
                                              <div class="form-group col-lg-4" >
                                                  <label>学生ID:</label>
                                                  <input type="text" name="studentID" class="form-control orderpackage_id" readonly="true">
                                              </div>
                                              <div class="form-group col-lg-4">
                                                  <label>起始时间</label>
                                                  <input type="text" name="startTime" class="form-control flatpickr starttime" >
                                              </div>
                                              <div class="form-group col-lg-4">
                                                  <label>截止时间</label>
                                                  <input type="text" name="endTime" class="form-control flatpickr stoptime">
                                              </div>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                          <button type="submit" class="btn btn-primary">提交</button>
                                      </div>
                                      </form>
                                  </div>
                                </div>
                            </div>
                            <!-- 模态框5 -->
                            <!-- 模态框1,查看用户信息 -->
                            <!-- <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        学员信息
                                        </div>
                                        <div class="modal-body"  style="overflow: auto;">
                                            <div class="col-lg-2">
                                                <img src="" alt="没有头像" style="height: 120px;width:120px;" id="personalimage">
                                            </div>
                                            <div class="col-lg-10">
                                                <table class="table information">

                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- 模态框1 -->
                             <!-- 模态框2,余额充值 -->
                            <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            余额充值
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="<?php echo U('Money/studentRecharge');?>" method="post">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">学员编号</label>
                                                <input type="text" name="user_id" class="form-control" placeholder="Count" id="chongzhicount" readonly="true">
                                              </div>
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">学员姓名</label>
                                                <input type="text" name="account" class="form-control" placeholder="Count" id="chongzhicount2" readonly="true">
                                              </div>
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">充值金额</label>
                                                <input type="number" name="money" class="form-control" placeholder="Money">
                                              </div>
                                              <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                                    <button type="submit" class="btn btn-primary">提交</button>
                                              </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 模态框2 -->
                            <!-- 模态框3,停课信息修改 -->
                            <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="stopclass">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        停课取消操作
                                        </div>
                                        <div class="modal-body"  style="overflow: auto;">
                                          <form class="" action="<?php echo U('StopClass/StopClassManage',array('type'=>'cancel'));?>" method="post">
                                            <div class="form-group">
                                              <label for="">停课编号</label>
                                              <input type="text" name="stopID" value="" class="form-control" id="stopID" readonly="true">
                                            </div>
                                            <div class="form-group">
                                              <label for="">学生名字</label>
                                              <input type="text" name="stu_name" value="" class="form-control" id="stu_name" readonly="true">
                                            </div>
                                            <div class="form-group">
                                              <label for="">开始时间</label>
                                              <input type="text" name="strattime" value="" class="form-control" id="stu_starttime" readonly="true">
                                            </div>
                                            <div class="form-group">
                                              <label for="">结束时间</label>
                                              <input type="text" name="stoptime" value="" class="form-control" id="stu_stoptime" readonly="true">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                            <button type="submit" class="btn btn-default">取消停课</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- 模态框3 -->
                        </div>
                    </div>
                </div>

                <div class="row" id="editStudentInfo">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            修改学生资料
                        </div>
                        <div class="panel-body">
						<form class="form-horizontal" action="<?php echo U('Info/UserManage',array('personType'=>'student','type'=>'update'));?>" method="post" role="form">
                            <div class="form-group">
								<label for="firstname" class="col-sm-2 control-label">账号</label>
								<div class="col-sm-10">
									<input id="account" type="text" readonly="true" name="account" class="form-control" placeholder="账号">
								</div>
							</div>
							<div class="form-group">
								<label for="firstname" class="col-sm-2 control-label">中文名</label>
								<div class="col-sm-10">
									<input id="chinesename" type="text" name="chinesename" class="form-control" placeholder="中文名">
								</div>
							</div>
							<div class="form-group">
								<label for="lastname" class="col-sm-2 control-label">英文名</label>
								<div class="col-sm-10">
									<input id="englishname" type="text" name="englishname" class="form-control" placeholder="英文名">
								</div>
							</div>
							<div class="form-group">
								<label for="lastname" class="col-sm-2 control-label">邮箱</label>
								<div class="col-sm-10">
									<input id="email" type="text" name="email" class="form-control" placeholder="邮箱">
								</div>
							</div>
							<div class="form-group">
								<label for="lastname" class="col-sm-2 control-label">电话</label>
								<div class="col-sm-10">
									<input id="phone" type="text" name="phone" class="form-control" placeholder="电话">
								</div>
							</div>
							<div class="form-group">
								<label for="lastname" class="col-sm-2 control-label">QQ</label>
								<div class="col-sm-10">
									<input id="qq" type="text" name="qq" class="form-control" placeholder="QQ">
								</div>
							</div>
							<div class="form-group">
								<label for="lastname" class="col-sm-2 control-label">微信</label>
								<div class="col-sm-10">
									<input id="wechat" type="text" name="weixin" class="form-control" placeholder="微信">
								</div>
							</div>
                            <div class="form-group">
								<label for="lastname" class="col-sm-2 control-label">年龄</label>
								<div class="col-sm-10">
									<input id="age" type="text" name="age" class="form-control" placeholder="年龄">
								</div>
							</div>
                            <div class="form-group">
                              <label for="lastname" class="col-sm-2 control-label">国籍</label>
                              <div class="col-sm-10">
                                <input id="country" type="text" name="country" class="form-control" placeholder="国籍">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="lastname" class="col-sm-2 control-label">性别</label>
                              <div class="col-sm-10" style="padding-top: 8px;">
                                <!-- <input id="" type="text" name="Basic" class="form-control" placeholder="性别"> -->
                                <select class="form-control" id="sex" name="sex">
                                  <option value="1">男</option>
                                  <option value="0">女</option>
                                </select>
                              </div>
                            </div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-default" id="">修改</button>
									</div>
								</div>
							</form>
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

    <!-- DataTables JavaScript -->
    <script src="__PUBLIC__/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="__PUBLIC__/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

        <script type="text/javascript" src="__PUBLIC__/tool/flatpickr.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
        $('#dataTables-example2').DataTable({
                responsive: true
        });
    });

    </script>

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();
        $('.chongqian').click(function(){
             $('#chongzhicount').val($(this).parent().parent().find('td').html());
             $('#chongzhicount2').val($(this).parent().parent().find('td').next().html());
        });

        $('.getpersoninfo').click(function(){
            var user_id=$(this).parents('tr').find('td').eq(0).html();
            $.ajax({
                type: "POST",
                url: "<?php echo U('Root/getstudentinformation');?>",
                data: "user_id="+user_id,
                success:function(msg){
                    if(msg!='error'){
                        var innerhtml=
                        "<tr><th>中文名</th><td>"+msg['0']['chinesename']
                        +"</td><th>英文名</th><td>"+msg['0']['englishname']
                        +"</td><th>国家</th><td>"+msg['0']['country']
                        +"</td><th>性别</th><td>"+((msg['0']['sex']==0)?"女":"男")
                        +"</td><th>年龄</th><td>"+msg['0']['age']
                        +"</td></tr>"
                        +"</td><th>QQ</th><td>"+msg['0']['QQ']
                        +"</td><th>电话</th><td>"+msg['0']['phone']
                        +"</td><th>微信</th><td>"+msg['0']['weixin']
                        +"</td><th>分管时间</th><td>"+msg['0']['accept_time']
                        +"</td><th>顾问中文名</th><td>"+msg['0']['adminchinesename']
                        +"</td></tr>"
                        +"</td><th>邮箱</th><td>"+msg['0']['email']
                        +"</td></tr>";
                        $('.information').html(innerhtml);
                        $('#personalimage').attr('src',msg['0']['image_path']);
                        // $('#personalproduct').html(msg['0']['introduction']);
                    }else{
                        alert('未知错误!');
                    }
                }
            })
        });


        $(".getstopclass").click(function(){
          var stu_no=$(this).parent().parent().find('td').html();
          $.ajax({
            type:'post',
            url:"<?php echo U('StopClass/ajaxGetStudentStopClass');?>",
            data:"student_id="+stu_no,
            success:function(msg){
              msg = JSON.parse(msg);
              $("#stopID").val("")
              $("#stu_name").val("");
              $("#stu_starttime").val("");
              $("#stu_stoptime").val("");

              $("#stopID").val(msg['stopclassID'])
              $("#stu_name").val(msg['chinesename']);
              $("#stu_starttime").val(msg['stopStartTime']);
              $("#stu_stoptime").val(msg['stopEndTime']);
            }
          })
        });
    </script>

    <script type="text/javascript">
      // $(document).ready(function(){
        $("#editStudentInfo").hide();
        $(".editStudent").click(function(){
          var studentID = $(this).parent().parent().find(".studentID").html();
          $.ajax({
            type: "POST",
            url: "<?php echo U('Info/UserManage',array('personType'=>'student','type'=>'checkUpdate'));?>",
            data: {
              type: "student",
              ID: studentID,
            },
            dataType: "json",
            success: function(data){
              $("#editStudentInfo").slideDown();
              $("#account").val(data.account);
              $("#chinesename").val(data.chinesename);
              $("#englishname").val(data.englishname);
              $("#email").val(data.email);
              $("#phone").val(data.phone);
              $("#qq").val(data.QQ);
              $("#wechat").val(data.weixin);
              $("#age").val(data.age);
              $("#country").val(data.country);
              $("#sex").val(data.sex);

            },
            error: function(jqXHR){
              alert(jqXHR.status);
            },
          });
        });
      // });
    </script>

    <script>
        $('.resetPasswordID').click(function(e){
        if(confirm('是否确认一键重置密码?')){
          return true;
        }else{
          return false;
        }
      })

      $('.removeAccountID').click(function(e){
        if(confirm('是否彻底删除该账号?')){
          return true;
        }else{
          return false;
        }
      })

      $('.delaymouth').click(function(){
          var starttime=$(this).parent().find('span').first().html();
          flatpickr(".flatpickr",{
              minDate:starttime
          });
          var stoptime=$(this).parent().find('span').last().html();
          var orderpackage_id=$(this).parent().find('td').first().html();
          $('#delay .orderpackage_id').val(orderpackage_id);
          $('#delay .starttime').val(starttime);
          $('#delay .stoptime').val(stoptime);
          $('#delay').modal();
      });

      $('.stoppackage').click(function(){
          flatpickr(".flatpickr",{
              minDate:new Date()
          });
          var orderpackage_id=$(this).parent().parent().find('td').first().html();
          $('#modalmoneyinfo .orderpackage_id').val(orderpackage_id);
          // $('#delay .starttime').val(starttime);
          // $('#delay .stoptime').val(stoptime);
      })
    </script>

</body>

</html>