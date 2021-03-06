<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

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

    <!-- 多选插件 -->
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/tool/lou-multi-select/css/multi-select.css">

    <!-- 时间选择插件 -->
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/tool/flatpickr.min.css">


    <style type="text/css">
      .sgBtn{width: 135px; height: 35px; line-height: 35px; margin-left: 10px; margin-top: 10px; text-align: center; background-color: #0095D9; color: #FFFFFF; float: left; border-radius: 5px;}
    </style>
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
                        <h1 class="page-header">小班课管理</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!-- /.row -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="border-radius: 0px;">
                            <div class="panel-heading">
                                现有小班课
                            </div>
                            <div class="panel-body" style="overflow: auto;">
                            <div class="dataTable_wrapper" style="max-width: 100%;">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="max-width: 100%;">
                              <thead>
                                <tr>
                                  <th>小班课编号</th>
                                  <th>小班课名称</th>
                                  <th>任课教师</th>
                                  <th>课程教材</th>
                                  <th>课程进度</th>
                                  <th>操作</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php foreach($classList as $key => $value){ ?>
                                <tr>
                                  <td><?php echo ($value['groupID']); ?></td>
                                  <td><?php echo ($value['groupName']); ?></td>
                                  <td><a href=""><?php echo ($value['account']); ?></a></td>
                                  <td><a href=""><?php echo ($value['material']); ?></a></td>
                                  <td><?php echo ($value['haveclass']); ?>/<?php echo $value['gclassNumber']+$value['gotherClassNum']; ?></td>
                                  <td>
                                     <div class="btn-group btn-group-sm">
                                        <button class="btn btn-default" type="button" onclick='load("<?php echo U('GroupClass/GroupClassRecode',array('groupID'=>$value['groupID']));?>")'>课程记录</button>
                                        <button class="btn btn-default" type="button" onclick='load("<?php echo U('Group:GroupStudentManage',array('groupID'=>$value['groupID']));?>")'>学生管理</button>
                                        <button class="btn btn-default" type="button" onclick='load("<?php echo U('Group:GroupTeacherManage',array('groupID'=>$value['groupID']));?>")'>教师管理</button>
                                        <button class="btn btn-default changeMgr" type="button" >教材管理</button>
                                      </div>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                            </div>
                            </div>
                            <div class="panel-footer clearfix">
                              <button class="btn btn-primary openclass" style="float: right;margin-left: 15px;">
                                新建小班
                              </button>
                              <!-- <button class="btn btn-default" style="float: right;" data-toggle="modal" data-target="#watchhistory">
                                小班历史查看
                              </button> -->
                              <button class="btn btn-default" style="float: right;" onclick="load('<?php echo U('Group:GroupHistory');?>')">小班历史查看</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 创建小班 -->
                <div class="row clearfix" id="openclassbox" style="display: none">
                  <div class="col-lg-12">
                    <div class="panel panel-default"  style="border-radius: 0px;">
                      <div class="panel-heading">
                        创建小班课
                        <i class="fa fa-remove pull-right openclass" style="cursor: pointer;"></i>
                      </div>
                      <div class="panel-body">
                        <div class="row clearfix">
                          <div class="col-lg-10">
                          <form class="form-horizontal" id="createXiaoBan" action="<?php echo U('Group/CreateGroup');?>" method="post">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">小班名称</label>
                              <div class="col-sm-10">
                                <input type="text" name="groupName" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">选择套餐</label>
                              <div class="col-sm-10">
                                <select class="form-control" id="packer_arr" name="packageID">
                                  <option></option>
                                  <?php foreach($packageList as $key => $value) { ?>
                                  <option value='<?php echo ($value["package_id"]); ?>' desc="<?php echo ($value['packageName']); ?>_<?php echo ($value['student_number']); ?>_<?php echo ($value['teacher_nation']); ?>_<?php echo ($value['teacher_type']); ?>_<?php echo ($value['class_number']); ?>" id="package_info_<?php echo ($value['package_id']); ?>"><?php echo ($value['package_name']); ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">套餐信息</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" id="package_detail" style="resize: none;" readonly="true"></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">选择教师</label>
                              <div class="col-sm-10">
                                 <select class="form-control" id="group_teacher" name="teacherID">
                                  <option></option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">教师薪资</label>
                              <div class="col-sm-10">
                                 <input type="number" name="teacherSalary" class="form-control">
                              </div>
                            </div>
                            <div class="form-group classtime">
                              <label for="inputPassword3" class="col-sm-2 control-label">选择时间</label>
                              <div class="col-sm-8">
                               <input type="text" class="form-control calendar">
                               </div>
                               <div class="col-sm-1">
                                 <button class="btn btn-primary clearTime" type="button">清除</button>
                               </div>
                               <div class="col-sm-1">
                                 <button class="btn btn-primary addTime" type="button">添加</button>
                               </div>
                            </div>
                            <!-- <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-default">查看可选学生</button>
                              </div>
                            </div> -->
                            <!-- <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">选择学生</label>
                              <div class="col-sm-4">
                               <select id='pre-selected-options' multiple='multiple'>
                                  <option value='elem_1'>elem 1</option>
                                  <option value='elem_2'>elem 2</option>
                                  <option value='elem_3'>elem 3</option>
                                  <option value='elem_4'>elem 4</option>
                                  ...
                                  <option value='elem_100'>elem 100</option>
                                </select>
                              </div>
                            </div> -->
                            <div class="form-group" style="display: none">
                              <input type="text" name="times" id='XiaobenTimes'>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-default openxiaoban">开放课程</button>
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
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- 提交小班开课 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">课程时间</h4>
          </div>
          <div class="modal-body">
            <table class="table">
              <thead>
                <tr>
                  <td>课程周次</td>
                  <td></td>
                  <td>每节课的时间</td>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" onclick="openXiaobanke()">确认开课</button>
          </div>
        </div>
      </div>
    </div>
    <!-- 查看小班历史 -->
    <div class="modal fade" id="watchhistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">课程时间</h4>
          </div>
          <div class="modal-body">
            <form class="form row" action="<?php echo U('Group/GroupHistory');?>" method="post">
              <div class="form-group col-sm-6">
                <label>年</label>
                <select class="form-control" name="year">
                  <option value="2016">2016</option>
                </select>
              </div>
              <div class="form-group col-sm-6">
                <label>月</label>
                <select class="form-control" name="month">
                  <option value="1">1</option>
                </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary">查看</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- 模态框1 -->
    <!--更换教材-->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="bookMgr">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                更换教材
                </div>
                  <div class="modal-body"  style="overflow: auto;">
                   <form class="form-horizontal" action="<?php echo U('Book/selectBookForGroup');?>" method="post" role="form" style>
                     <div class="form-group" style="margin: 10px;">
                       <label for="name">选择列表</label>
                         <select class="form-control" name="BookID" id="classlist">
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
  <!--模态框2-->
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

    <!-- 多选插件 -->
    <script type="text/javascript" src="__PUBLIC__/tool/lou-multi-select/js/jquery.multi-select.js"></script>


    <!-- 时间选择插件 -->
    <script src="__PUBLIC__/tool/flatpickr.min.js"></script>

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
      // 对Date的扩展，将 Date 转化为指定格式的String
      // 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，
      // 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)
      // 例子：
      // (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423
      // (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18
      Date.prototype.Format = function (fmt) { //author: meizz
          var o = {
              "M+": this.getMonth() + 1, //月份
              "d+": this.getDate(), //日
              "h+": this.getHours(), //小时
              "m+": this.getMinutes(), //分
              "s+": this.getSeconds(), //秒
              "q+": Math.floor((this.getMonth() + 3) / 3), //季度
              "S": this.getMilliseconds() //毫秒
          };
          if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
          for (var k in o)
          if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
          return fmt;
      }
      //跳转，url为传入参数
      function load(url){
        window.location.href=url;
      }
    </script>

    <script>
    //初始化时间
    upDateTime();

    //初始化表格
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
        $('#dataTables-example2').DataTable({
                responsive: true
        });
    });
     //初始化多选狂
    $('#pre-selected-options').multiSelect();


    //时间选择处理
    var i=0;
    var times=[];
    var myDate = new Date(); //获取今天日期
    myDate.setDate(myDate.getDate() + 7);
    //初始化时间选择器
    $(".calendar").flatpickr({
      "enableTime": true,
      "minuteIncrement":30,
      "time_24hr": true,
      "minDate":new Date(),
      // "maxDate":myDate,
      // mode: "multiple"
    });

    //这里处理创建的时候各种时间的处理

    $('.openclass').click(function(){
      $('#openclassbox').slideToggle();
    });

    //清除时间选择框的时间
    $('.clearTime').click(function(){
        $(this).parents('.form-group').find('input').val(' ');
      })
    $('.addTime').click(function(){
      $('.classtime').after('<div class="form-group addedtimes"><div class="col-sm-8 col-sm-offset-2"><input type="text"  class="form-control calendar'+i+'"></div><div class="col-sm-1"><button class="btn btn-primary clearTime2" type="button">清除</button></div><div class="col-sm-1"><button class="btn btn-danger deletethis" type="button">删除</button></div></div>');
      //时间选择器的初始化
      $(".calendar"+i).flatpickr({
        "enableTime": true,
        "minuteIncrement":30,
        "time_24hr": true,
        "minDate":new Date(<?php echo ($nowtime); ?>*1000),
        // "maxDate":myDate,
        // mode: "multiple"
      });
      $('.deletethis').click(function(){
        $(this).parents('.addedtimes').remove();
      });
      $('.clearTime2').click(function(){
        $(this).parents('.form-group').find('input').val("");
      });
      i++;
    });
    //假设获取到课时数量为24,这里需后台传输数据
    var classnumber=24;
    //提交数据的时候进行数据校验
    $('.openxiaoban').click(function(){
      var str="";
      var times=[];
      times[0]=[];
      if($('.classtime').find('input').val()==""){
        return alert('数据不完整');
      }
      times[0].push($('.classtime').find('input').val());
      str=str+"<tr><td>第1周<td><td>"+$('.classtime').find('input').val()+"</td>";
      var stop=false;
      $('.addedtimes').find('input').each(function(){
        if($(this).val()==""){
          stop=true;
          return alert('数据不完整');
        }
        if(times[0].indexOf($(this).val())!=-1){
          stop=true;
          return alert('存在重复时间!请在检查一下!');
        }
        times[0].push($(this).val());
        str=str+"<td>"+$(this).val()+'</td>';
      });
      if(stop){
        return;
      }
      str=str+"</tr>"
      var count=Math.ceil(classnumber/times[0].length);
      for (var j = 1; j < count; j++) {
        str=str+'<tr><td>第'+(j+1)+'周<td>';
        times[j]=[];
        for (var x = 0; x < times[0].length; x++) {
          var temp = new Date(times[j-1][x]);
          temp.setDate(temp.getDate() + 7);
          var t=temp.Format("yyyy-MM-dd hh:mm");
          times[j][x]=t;
          str=str+'<td>'+t+'</td>';
        };
        str=str+"</tr>";
      };
      $('#XiaobenTimes').val(times);
      $('#myModal').find('tbody').html(str);
      $('#myModal').modal();
    });

    function openXiaobanke(){
      $('#createXiaoBan').submit();
    }

    $('.changeMgr').click(function(){
      var data='';
      data=$(this).parents('tr').find('td').eq(0).html();
      $.ajax({
        utl:"<?php echo U('Group/ajaxGetMaterialInfo');?>",
        type:'post',
        data:'groupID='+data,
        success:function(msg){
          alert(msg);
          var tr=JSON.parse(msg);
          var str="";
          for(var i=0;i<tr.length;i++){
            str=str+"<option value='"+tr[i]['bookid']+"_"+tr[i]['imagepath']+"'>"+tr[i]['bookname']+"</option>";
          };
          $('#classlist').html(str);

        },
        error:function(err){
          alert(err)
        }
      })
      $('#bookMgr').modal();
    });

    $('#classlist').change(function(){
      var src=$(this).val().split("_");
      $('#bookMgr').find('img').attr('src',src[1]);
    });

    //获取到的套餐数据的处理
    $('#packer_arr').change(function(){
      $('#package_detail').html("");
      var temp_package_info = $(this).val();
      var desc=$('#package_info_'+temp_package_info).attr('desc');
      desc=desc.split('_');
      str="套餐类型:"+desc[0]+"\t"+
          "学生人数"+desc[1]+"\t"+
          "教师类型"+((desc[2]==0)?'中教':'外教')+"\t"+
          "教师类别"+((desc[3]==0)?'普通':'名师')+"\t"+
          "班级课时"+desc[4];
      //对课程数量赋值
      classnumber=desc[4];
      $('#package_detail').html(str);
      console.log(temp_package_info);
      $.ajax({
        url:"<?php echo U('Group/ajaxGetTeacherInfo');?>",
        type:'post',
        data:"package_id="+temp_package_info,
        success:function(msg){
          var message=(msg!=null)?JSON.parse(msg):null;
          var str='';
          for(var i=0;i<message.length;i++){
            str=str+"<option value="+message[i]['ID']+">"+message[i]['englishname']+"</option>";
          };
          $('#group_teacher').html(str);
        },
        error:function(error){
          alert(error);
        }
      })
    });
    </script>

</body>

</html>