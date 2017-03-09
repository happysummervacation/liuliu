<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
1.这里面学生消耗的课时数需要进行统计得出
2.这里的停课操作取消
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
    <link href="__PUBLIC__/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

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

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">学员套餐</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            学员套餐
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>编号</th>
                                            <!-- <th style="display:none">套餐编号</th> -->
                                            <th>套餐类型</th>
                                            <th style="display:none">学员编号</th>
                                            <th>课程数</th>
                                            <th>套餐价格</th>
                                            <th>有效时长</th>
                                            <th>延期时长</th>
                                            <th>赠送课时</th>
                                            <th>课时消耗</th>
                                            <!-- <th>可停课次数</th> -->
                                            <th>状态</th>
                                            <th>教材</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $student_id=$_GET['user_id']; ?>
                                        <?php foreach($orderPackageList as $key=>$value){ if($value['isdelete']==0){ ?>
                                            <tr>
                                                <td class="packageID"><?php echo ($value['orderpackageID']); ?></td>
                                                <!-- <td style="display:none"><?php echo ($value['package_id']); ?></td> -->
                                                <td>
                                                    <?php switch($value['packageType']): case "0": ?>课时类<?php break;?>
                                                        <?php case "1": ?>卡类<?php break; endswitch;?>
                                                    /
                                                    <?php echo ($value['packageName']); ?>
                                                    /
                                                    <?php switch($value['classType']): case "0": ?>一对一<?php break;?>
                                                        <?php case "1": ?>小班<?php break; endswitch;?>
                                                </td>
                                                <td style="display:none"><?php echo ($value['studentID']); ?></td>
                                                <td><?php echo ($value['classNumber']); ?></td>
                                                <td><?php echo ($value['packageMoney']); ?></td>
                                                <td class="delaymouth" style="cursor:pointer;"><span><?php echo (date("Y-m-d",$value['startTime'])); ?></span>到
                                                <span><?php echo (date("Y-m-d",$value['endTime'])); ?></span></td>
                                                <td><?php printf('%.2f',$value['delayTime']/3600/24) ?>天</td>
                                                <td class="sendclass"  style="cursor:pointer;"><?php echo ($value['otherClass']); ?></td>
                                                <td><?php echo ($value['haveClass']); ?></td>
                                                <!-- <td><?php echo ($value['stop_number']); ?></td> -->
                                                <td><?php if($value['status'] == "0") {echo "无效";} else {echo "有效";}?></td>
                                                <td>
                                                  <?php $tem = "";$tem = explode(":",$value['material'])[1]; ?>
                                                  <?php if($value['classType'] == "1" || $value['classType'] == 1){ ?>
                                                      这是小班课,请在班级中进行指定教材
                                                  <?php }else{ ?>
                                                      <?php echo ($tem); ?>
                                                  <?php } ?>
                                                </td>
                                                <td>
                                                  <a href="<?php echo U('OrderPackage/OrderPackageManage', array('orderpackageID'=>$value['orderpackageID'],'type'=>'loseff'));?>" class="cancelOrderPackageID">套餐无效</a>
                                                  <a href="<?php echo U('OrderPackage/OrderPackageManage', array('orderpackageID'=>$value['orderpackageID'],'type'=>'effect'));?>" class="effectOrderPackageID">套餐有效</a>
                                                  <!-- <a href="#" data-toggle="modal" data-target="#modalmoneyinfo" class="stoppackage" >停课</a> -->
                                                  <?php if($value['classType'] == "1" || $value['classType'] == 1){ ?>

                                                  <?php }else{ ?>
                                                      <button  class="bookMgr">教材管理</button>
                                                  <?php } ?>

                                                </td>
                                            </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer" style="overflow: auto;">
                            <div class="pull-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#add">
                                    添加套餐
                                </button>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#history">
                                    购买历史
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- 模态框1,修改套餐有效期 -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="delay">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                套餐有效期
                </div>
                <div class="modal-body"  style="overflow: auto;">
                    <form class="form" method="post" action="<?php echo U('OrderPackage/OrderPackageManage',array('type'=>'delay'));?>">
                        <div class="form-group col-lg-4">
                            <label>记录编号:</label>
                            <input type="text" name="orderpackage" class="form-control orderpackage_id" readonly="true">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>起始时间</label>
                            <input type="text" class="form-control starttime" disabled="disabled">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>截止时间</label>
                            <input type="text" name="stoptime" class="form-control flatpickr stoptime">
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
    <!-- 模态框1 -->
    <!-- 模态框2,修改赠送课时 -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="send">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                赠送课时
                </div>
                <div class="modal-body"  style="overflow: auto;">
                    <form class="form" method="post" action="<?php echo U('SendClass/sendClassNum',array('user_id'=>$studentID));?>">
                        <div class="form-group col-lg-3">
                            <label>记录编号</label>
                            <input type="text" name="orderpackage_id" class="form-control orderpackage_id" readonly="true">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>添加或者删除</label>
                            <select class="form-control" name="type">
                                <option value="1">添加</option>
                                <option value="0">删除</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>数量</label>
                            <input type="text" name="number" class="form-control classnumber">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>赠送理由</lable>
                            <textarea class="form-control" name="reason"></textarea>
                        </div>
                        <div class="form-group col-lg-3" style="float: right;">
                            <label style=" visibility: hidden;">提交按钮</label><br>
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <!-- <button type="button" class="btn btn-primary">查看赠送记录</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="bookMgr">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                教材管理
                </div>

                  <div class="modal-body"  style="overflow: auto;">
                   <form class="form-horizontal" action="<?php echo U('Book/selectBookForStudent');?>" method="post" role="form" style>
                     <div class="form-group" style="margin: 10px;">
                       <label for="name">选择列表</label>
                         <select class="form-control" name="BookID" id="classList">
                         </select>
                     </div>
                     <div class="form-group" style="margin: 10px;">
                       <label for="name">课程预览</label>
                       <div class="">
                         <div class="panel panel-default" style="margin-top: 10px;width: 280px;">
                             <div class="panel-heading simpleline">
                                 教材名称:<span id="bookName"></span>
                             </div>
                             <div class="panel-body" style="text-align: center;">
                                 <img id="bookImg" src="" style="width: 80%;height: 200px;">
                             </div>
                         </div>
                       </div>
                       <input type="hidden" id="packageID" name="packageId" value="">
                       <input type="hidden" id="bookhidden" name="bookname" value="">
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
    <!-- 模态框3,添加套餐 -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="add">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    添加套餐
                    </div>
                <div class="modal-body"  style="overflow: auto;">
                    <form class="form" method="post" action="<?php echo U('Package/pakcageOrderDeal',array('user_id'=>$user_id));?>">
                    <div class="form-group col-lg-6">
                        <label>学员编号</label>
                        <input type="text" name="student_id" readonly="true" class="form-control addpackagestuname">
                    </div>
                    <div class="form-group col-lg-6">
                        <label>选择套餐</label>
                        <select class="form-control packageidlist" name="package_id">
                          <?php foreach($packageid as $key=>$value){ ?>
                                <option value="<?php echo ($value['package_id']); ?>"><?php echo ($value['package_id']); ?></option>
                          <?php } ?>
                        </select>
                    </div>
                    <div class="class-group">
                        <table class="table packagedetail">
                            <thead>
                                <tr>
                                    <th>套餐类型</th>
                                    <th>课时类型</th>
                                    <th>课程类型</th>
                                    <th>教师类型</th>
                                    <th>教师类别</th>
                                    <th>有效期(天)</th>
                                    <th>套餐内容</th>
                                    <th>剩余课时</th>
                                    <th>班级人数</th>
                                    <th>套餐价格</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
    <!-- 模态框3 -->
    <!-- 模态框4,查看历史记录 -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="history">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                购买历史
                </div>
                <div class="modal-body"  style="overflow: auto;">
                    <table class="table table-bordered table-hover" id="dataTables_history">
                        <thead>
                            <tr>
                                <th>订单编号</th>
                                <th>套餐编号</th>
                                <th>学员编号</th>
                                <th>课程时长</th>
                                <th>有效时长</th>
                                <th>延期时长</th>
                                <th>赠送课时</th>
                                <th>课时消耗</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($packageinfomation as $key=>$value){ ?>
                                <tr>
                                    <td><?php echo ($value['orderpackage_id']); ?></td>
                                    <td><?php echo ($value['package_id']); ?></td>
                                    <td><?php echo ($value['student_id']); ?></td>
                                    <td><?php echo ($value['total_class']); ?></td>
                                    <td><span><?php echo (date("Y-m-d",$value['start_time'])); ?></span>到
                                    <span><?php echo (date("Y-m-d",$value['end_time'])); ?></span></td>
                                    <td><?php echo ($value['delay_month']); ?>月</td>
                                    <td><?php echo ($value['other_class']); ?></td>
                                    <td><?php echo ($value['have_class']); ?></td>
                                    <td><?php if($value['status'] == "0") {echo "无效";} else {echo "有效";}?></td>
                                    <td><a href="<?php echo U('Root/deletestudentpackage',array('orderpackage_id'=>$value['orderpackage_id']));?>" >删除</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 模态框4 -->
    <!-- 模态框5,套餐停课处理 -->
    <!-- <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalmoneyinfo">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
              <div class="modal-header">
              停课申请
              </div>
              <div class="modal-body"  style="overflow: auto;">
                  <form class="form" method="post" action="<?php echo U('Root/DealStudentStopClass');?>">
                      <div class="form-group col-lg-4">
                          <label>记录编号:</label>
                          <input type="text" name="orderpackage" class="form-control orderpackage_id" readonly="true">
                      </div>
                      <div class="form-group col-lg-4">
                          <label>起始时间</label>
                          <input type="text" name="start_time" class="form-control flatpickr starttime" >
                      </div>
                      <div class="form-group col-lg-4">
                          <label>截止时间</label>
                          <input type="text" name="end_time" class="form-control flatpickr stoptime">
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                  <button type="submit" class="btn btn-primary">提交</button>
              </div>
              </form>
          </div>
        </div>
    </div> -->
    <!-- 模态框5 -->
    <!-- </div> -->

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

        getpackageinformation();

        $('#dataTables-example').DataTable({
                responsive: true
        });

        $('#dataTables_history').DataTable({
                responsive: true,
                searching: false
        });

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

        $('.sendclass').click(function(){
            var orderpackage_id=$(this).parent().find('td').first().html();
            $('#send .orderpackage_id').val(orderpackage_id);
            $('#send').modal();
        })


        $('.packageidlist').change(function(){
            getpackageinformation();
        });

    });
    //根据ID获取套餐的详细信息
    function getpackageinformation(){
        var student_id="<?php echo ($student_id); ?>";
        $('.addpackagestuname').val(student_id);
        var package_id=$('.packageidlist').val();
        $.ajax({
            type: "POST",
            url: "<?php echo U('Package/AjaxgetPackageInfor');?>",
            data:{
                    package_id:package_id
                },
                dataType:"json",
            success:function(msg){
                if (msg=="error") {
                    // alert('未知错误！');
                }else{
                    var packageinformation="<tr><td>"
                    +msg['0']['packageName']+"</td><td>"
                    +msg['0']['package_type']+"</td><td>"
                    +msg['0']['class_type']+"</td><td>"
                    +msg['0']['teacher_nation']+"</td><td>"
                    +msg['0']['teacher_type']+"</td><td>"
                    +msg['0']['time']+"</td><td>"
                    +msg['0']['package_content']+"</td><td>"
                    +msg['0']['class_number']+"</td><td>"
                    +msg['0']['student_number']+"</td><td>"
                    +msg['0']['package_money']+"</td><td>"
                    +"<input name='starttime' style='display:none;' value='"+msg['0']['starttime']+"'>"
                    +"<input name='stoptime' style='display:none;' value='"+msg['0']['stoptime']+"'>"
                    +"<input name='category' style='display:none;' value='"+msg['0']['category']+"'>"
                    +"<input name='package_money' style='display:none;' value='"+msg['0']['package_money']+"'>"
                    $('.packagedetail tbody').html(packageinformation);
                }
            }
        });
    }
    </script>

    <script type="text/javascript">
        $('.bookMgr').click(function(){
        var packageID = $(this).parent().parent().find(".packageID").html();
        // alert(packageID)
        nowPackage = packageID;
        $("#packageID").val(nowPackage);
        $.ajax({
          type: "POST",
          url: "<?php echo U('Book/AjaxGetBookInfoWithOrderClassID');?>",
          data: {
            ID: packageID,
          },
          dataType: "json",
          success: function(data){
            var newOPt = ""
            var count = 0;
            var bookHash = new Array();
            $("#classList").empty();
            for(i in data){
              newOPt = newOPt + '<option value="' + data[i].bookid + '">' + data[i].bookname + '</option>';
              bookHash[data[i].bookid] = count;
              count ++;
            }
            $("#classList").append(newOPt);
            $("#bookhidden").val(data[0].bookname);
            $("#bookName").html(data[0].bookname);
            $("#bookImg").attr("src", data[0].bookimagelink);
            booksInfo = data;
            booksHash = bookHash;
          },
          error: function(jqXHR){
            alert(jqXHR.status);
          },
        });

        $('#bookMgr').modal();

    })
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#classList").click(function(){
          var thisId = parseInt(booksHash[$(this).val()])
          $("#bookName").html(booksInfo[thisId].bookname);
          $("#bookhidden").val(booksInfo[thisId].bookname);
          $("#bookImg").attr("src", booksInfo[thisId].bookimagelink);
        });
      });
    </script>

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();
    </script>

    <script type="text/javascript">
        $(".cancelOrderPackageID").click(function(){
            if(confirm('是否真的设置该学生套餐无效?')){
              return true;
            }else{
              return false;
            }
        })
    </script>
    <script>
        $(".effectOrderPackageID").click(function(){
            if(confirm('是否真的设置学生的套餐有效,一旦设置有效,学生将可再次使用套餐?')){
                return true;
            }else{
                return false;
            }
        })
    </script>
</body>


</html>