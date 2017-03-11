<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
1.在订课中,需要获取的数据有课程的ID,订购的套餐的ID号
2.显示的课程不能是上课前两小时之内的课程
3.一对一中卡类套餐还没有进行判断
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

    <link href="__PUBLIC__/css/BookingCourse.css" rel="stylesheet" type="text/css">
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
                        <h1 class="page-header">预约课程</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row">
                    <!-- 选择课程 -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            预约课程
                        </div>
                        <div class="panel-body">
                            <div>
                                <ul class="nav nav-pills">
                                <li class="active" id="chooseclassbyorder">
                                    <a href="#chclass" data-toggle="tab">选择课程</a>
                                </li>
                                <li id="choosebookbyorder">
                                    <a href="#chbook" data-toggle="tab">选择教材</a>
                                </li >
                                <li id="updatechoosebyorder"><a href="#upch" data-toggle="tab">提交选择</a></li>
                                </ul>
                            </div>
                            <div class="tab-content" style="margin-top: 20px;">
                                <div class="tab-pane fade in active" id="chclass">

                                    <div class="tab-content" style="margin-top: 20px;">
                                        <div class="tab-pane fade in active" id="byteacher">
                                        <div class="row">
                                        <div class="form-group">
                                          <form class="" action="<?php echo U('Student/getclassbytime');?>" method="post">
                                            <div class="col-lg-3">
                                                <label>起始时间</label>
                                                <input type="text" name="start_time" class="calendar form-control">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>截止时间</label>
                                                <input type="text" name="end_time" class="calendar form-control">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>教师类别</label>
                                                <select class="form-control" name="teacher_type">
                                                    <option value="0">中教</option>
                                                    <option value="1">外教</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style=" visibility: hidden;">提交</label>
                                                <br>
                                                <button type="submit" class="btn btn-primary tijiaoshaixuan"  style="float: right;">
                                                    提交筛选
                                                </button>
                                            </div>
                                          </form>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <!-- 一个教师的信息 在这里循环输出-->
                                        <!-- 先输出有频率的教师-->
                                        <!-- <?php dump($rate_result); dump($teacher_result);?> -->
                                        <?php foreach($rate_result as $key => $value) {?>
                                        <?php foreach($teacher_result as $t_key => $t_value) {?>
                                        <?php if($value['teacher_id'] == $t_value['ID']) {?>
                                            <div class="col-lg-3" style="margin-top: 20px;">
                                                <div class="col-xs-6">
                                                    <a href="<?php echo U('Student/TeacherInfo',array('ID'=>$value['teacher_id']));?>"><img src="<?php echo ($t_value['image_path']); ?>" alt='没有头像' style="height: 100px;width: 100px;"></a>
                                                </div>
                                                <div class="col-xs-6">
                                                    <h3 style="margin:0px"><?php echo ($t_value['englishname']); ?></h3>
                                                    <label>
                                                        <!-- <button class="btn btn-default btn-xs">名师</button> -->
                                                        <?php if($t_value['teacher_type'] == '1'){?>
                                                            <button class="btn btn-default btn-xs">外教</button>
                                                        <?php }else{?>
                                                            <button class="btn btn-default btn-xs">中教</button>
                                                        <?php }?>
                                                    </label>
                                                    <!-- <p>中文名</p> -->
                                                    <span style="display: none;"><?php echo ($t_value['ID']); ?></span>
                                                </div>
                                                <div class="col-xs-12" style="text-align: center;">
                                                    <button class="btn btn-default xuanzekecheng"  style="width: 65%;margin-top: 15px;">
                                                        可选课程
                                                    </button>
                                                </div>
                                            </div>
                                            <!--如果进入该if，表示有该数据，就将该教师的信息从返回的教师信息列表中删除-->

                                        <?php unset($teacher_result[$t_key]);}}}?>
                                        <!-- <?php dump($teacher_result);?> -->
                                        <!--将剩余的教师的信息显示出来-->
                                        <?php foreach($teacher_result as $key => $value){?>
                                            <div class="col-lg-3" style="margin-top: 20px;">
                                                <div class="col-xs-6">
                                                    <a href="<?php echo U('Student/TeacherInfo',array('ID'=>$value['ID']));?>"><img src="<?php echo ($value['image_path']); ?>" alt='没有头像' style="height: 100px;width: 100px;"></a>
                                                </div>
                                                <div class="col-xs-6">
                                                    <h3 style="margin:0px"><?php echo ($value['englishname']); ?></h3>
                                                    <label>
                                                        <!-- <button class="btn btn-default btn-xs">名师</button> -->
                                                        <?php if($value['teacher_type'] == '1'){?>
                                                        <button class="btn btn-default btn-xs">外教</button>
                                                        <?php }else{?>
                                                            <button class="btn btn-default btn-xs">中教</button>
                                                        <?php }?>
                                                        <!-- <?php if($value['level'] == '0'){ ?>
                                                            <button class="btn btn-default btn-xs">普教</button>
                                                        <?php }else{ ?>
                                                            <button class="btn btn-default btn-xs">名教</button>
                                                        <?php } ?> -->
                                                    </label>
                                                    <!-- <p>中文名</p> -->
                                                    <span style="display: none;"><?php echo ($value['ID']); ?></span>
                                                </div>
                                                <div class="col-xs-12" style="text-align: center;">
                                                    <button class="btn btn-default xuanzekecheng"  style="width: 65%;margin-top: 15px;">
                                                        可选课程
                                                    </button>
                                                </div>
                                            </div>
                                        <?php }?>
                                        <!-- // -->
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="chbook">
                                    <div class="row">
                                    <!--教材展示区-->
                                    <?php if(is_array($book_result)): foreach($book_result as $key=>$first): if(is_array($first)): foreach($first as $key=>$second): ?><div class="col-lg-2" style="text-align: center;">
                                            <div class="col-xs-12">
                                                <span><?php echo ($second['bookname']); ?></span>
                                                <p style="display: none"><?php echo ($second['bookid']); ?></p>
                                            </div>
                                            <div class="col-xs=12" style="padding: 5px;">
                                                <img src="<?php echo ($second['bookimagelink']); ?>" alt="教材封面" style="height: 130px;width: 100px;">
                                            </div>
                                            <div class="col-xs-12">
                                                <button class="btn btn-default btn-sm getbookinfo">选择教材</button>
                                            </div>
                                        </div><?php endforeach; endif; endforeach; endif; ?>
                                    <!--教材展示区-->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="upch">
                                    <div class="col-md-12">
                                        <table class="table table-hover" id="jiaoshikebiao3">
                                            <thead>
                                                <tr>
                                                    <th>课程编号</th>
                                                    <th>上课时间</th>
                                                    <!-- <th>任课教师</th> -->
                                                    <th>课程类型</th>
                                                    <!-- <th>课程数量</th> -->
                                                    <th>套餐ID</th>
                                                    <!-- <th>教材名称</th> -->
                                                    <th>删除记录(<a id="deleteall">删除全部</a>)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 col-md-offset-4" style="margin-top: 20px;">
                                        <button class="btn btn-primary" style="width: 100%;" id="submitorderclasslist">提交课程</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="teacherclass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">可选课程</h4>
                          </div>
                          <!-- <div class="modal-body"> -->
                            <!-- <table class="table table-hover" id="jiaoshikebiao1">
                                <thead>
                                    <tr>
                                        <td>课程编号</td>
                                        <td>上课时间</td>
                                        <td>任课教师</td>
                                        <td>课程类型</td>
                                        <td>选课数量</td>
                                        <td>选择课程</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table> -->
                          <!-- </div> -->
                          <div class="modal-body">
                              <form class="form">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label class="label-form">年份</label>
                                        <select class="form-control" name="year" id="yeararr">

                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                         <label class="label-form">月份</label>
                                        <select class="form-control" name="month" id="montharr">

                                        </select>
                                    </div>
                                     <div class="col-sm-3">
                                        <label class="label-form">第几周</label>
                                        <select class="form-control" name="month" id="weekarr">

                                        </select>
                                    </div>
                                     <div class="col-sm-3">
                                        <label class="label-form">可用套餐</label>
                                        <select class="form-control" name="month" id="packageid">

                                        </select>
                                    </div>
                                </div>
                              </form>
                              <hr>
                              <div class="col-lg-12" style="padding:15px;">
                                <div style="background-color:blue;width:10px;height:10px;display:none"></div>&nbsp;
                                &nbsp;&nbsp;&nbsp;
                                <div style="background-color:green;width:10px;height:10px;display:none;"></div>&nbsp;
                              </div>
                          <table id="teachertable" class="table table-hover table-bordered">
                              <thead>
                                  <tr>
                                    <td  style="text-align: center;">DATE</td>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;">TIME\DAY</td>
                                    <th style="text-align: center;">星期一</th>
                                    <th style="text-align: center;">星期二</th>
                                    <th style="text-align: center;">星期三</th>
                                    <th style="text-align: center;">星期四</th>
                                    <th style="text-align: center;">星期五</th>
                                    <th style="text-align: center;">星期六</th>
                                    <th style="text-align: center;">星期七</th>
                                  </tr>
                              </thead>
                              <tbody style="text-align: center;">
                              </tbody>
                          </table>
                           </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelclasschoose">取消</button>
                            <button type="button" class="btn btn-primary" id="makesure">确认</button>
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

    <script src="__PUBLIC__/js/md5.js"></script>
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

    <script src="__PUBLIC__/js/time.js"></script>

    <!-- 时间选择插件 -->
    <script src="__PUBLIC__/tool/flatpickr.min.js"></script>

    <!-- 教师课表初始化 -->
    <script type="text/javascript">

    </script>
    <script type="text/javascript">
        $(function(){
            $('#chooseclassbyorder').css('display','block');
            $('#choosebookbyorder').css('display','none');
            $('#updatechoosebyorder').css('display','none');
        })

        //初始化时间选择器
        $(".calendar").flatpickr({
            "enableTime": true,
            "minuteIncrement":30,
            "time_24hr": true,
        });

        //全局变量
        var PACKAGEINFO=[];//套餐信息
        var TEMPCLASSL=[];//选定课程的缓存队列
        //流程逻辑
        function step1(){
            $('#chooseclassbyorder').css('display','none');
            $('#choosebookbyorder').css('display','block');
            $('#updatechoosebyorder').css('display','none');


            $('#teacherclass').modal('hide');
            $('#chooseclassbyorder').removeClass('active');
            $('#chclass').removeClass('in active');
            $('#choosebookbyorder').addClass('active');
            $('#chbook').addClass('in active');
            step2();
        }

        function step2(){
            $('#chooseclassbyorder').css('display','block');
            $('#choosebookbyorder').css('display','none');
            $('#updatechoosebyorder').css('display','block');


            $('#choosebookbyorder').removeClass('active');
            $('#chbook').removeClass('in active');
            $('#updatechoosebyorder').addClass('active');
            $('#upch').addClass('in active');
            // step3();
        }

        function step3(temp){
            var upclassinfo="<tr><td>"
            +temp['class_id']+"</td><td>"
            +temp['class_time']+"</td><td>"
            +temp['class_type']+"</td><td>"
            +temp['package_id']+"</td><td>"
            +"<a href='#' class='deleterecord'>删除</a></td></tr>";
            $("#jiaoshikebiao3 tbody").append(upclassinfo);
            $('.deleterecord').click(function(){
                $(this).parent().parent().remove();
            })
        }

        function removeitemformarr(id,objarr){
            for (var i = 0; i < objarr.length; i++) {
                if(id==objarr[i]['class_id']){
                    return i;
                }
            }
            return false;
        }
        //表格初始化函数
        function tableinit(year,month,week,classarr,time){
            $("#teachertable tbody").html("");

            // console.log(TEMPCLASSL);
            //去掉已被选择的课程
            // 获取提交表格里的所有课程ID
            var aCLASS_ID=new Array();
            var length=$('#jiaoshikebiao3 tbody tr').length;
            for(var j=0;j<length;j++){
                aCLASS_ID[j]=$('#jiaoshikebiao3 tbody tr').eq(j).find('td').html();
            };

            // console.log(aCLASS_ID);

            // console.info(classarr);
            var ttdate=new Date(year,month,0);
            var ttmond=ttdate.getDate();
            ttdate.setDate(1);
            // console.log(classarr);
            var marr=time.sort(function(a,b){
                var h1= parseInt(a.substr(0,2));
                var h2= parseInt(b.substr(0,2));
                if(h1!=h2){
                    return h1-h2;
                }else{
                    var m1=parseInt(a.substr(3,2));
                    var m2=parseInt(b.substr(3,2));
                    return m1-m2;
                }
            });
            var firstwekday=(ttdate.getDay() == 0)?7:ttdate.getDay();//本月一号是周几
            var startd=(week-1)*7-firstwekday+2;
            if(month<10){
              month='0'+month;
            };
            for (var i = 0; i < 7; i++) {
                if((startd+i)>0 && (startd+i)<=ttmond){
                    $("#teachertable thead th").eq(i).html((month)+"-"+(startd+i));
                }else{
                    $("#teachertable thead th").eq(i).html("////////");
                }
                $("#teachertable thead th").eq(i).css('text-align','center');
            };
            for(var i=0;i<marr.length;i++){
                $("#teachertable tbody").append("<tr>"+
                "<th style='text-align:center;'>"+marr[i]+"</th><td></td><td></td><td></td><td></td><td></td><td></td><td></td>"
                +"</tr>");
            }
            //把课程填写进去
            $("#teachertable tbody td").each(function(){
                var t=$(this).parent().find('th').html();//时间
                var inx=$(this).parent().find('td').index(this)%7;//第几天
                var d=$("#teachertable thead th").eq(inx).html().substr(3,2);
                // console.log(d);
                if(d<10){
                  d='0'+d;
                }
                // console.log(d);
                var start_time=year+"-"+month+"-"+d+" "+t;
                for(var i=0;i<classarr.length;i++){
                    if(classarr[i]['start_time'].substr(0,16)==start_time){
                            var flag=aCLASS_ID.indexOf(classarr[i]['class_id']);
                            if(flag=='-1'){
                                $(this).css('background-color','green');
                                $(this).css('color','green');
                                $(this).addClass('normal');
                                $(this).addClass('chooseclass');
                                $(this).val(classarr[i]['class_id']);
                                $(this).attr('classtype',classarr[i]['class_type']);
                            }
                    }
                }
            });

             //点击预约课程，获取课程ID存放到全局变量里,点击确认按钮执行下一步

            $('.chooseclass').click(function(){
                if($(this).hasClass('ordered')){
                    $(this).css('background-color','green');
                    $(this).css('color','green');
                    $(this).removeClass('ordered');
                    $(this).removeAttr('package');
                    var res=removeitemformarr($(this).val(),TEMPCLASSL);
                    if(res||res==0){
                        TEMPCLASSL.splice(res,1);
                    }else{
                        alert(res);
                    }
                }else{
                    var packafenumarr=$("#packageid").val().split('_');
                    $(this).css('background-color','#aaa');
                    $(this).css('color','#aaa');
                    $(this).addClass('ordered');
                    $(this).attr('package',packafenumarr[0]);
                    //获取相关信息存入临时数组
                    var t=$(this).parent().find('th').html();//时间
                    var inx=$(this).parent().find('td').index(this)%7;//第几天
                    var d=$("#teachertable thead th").eq(inx).html().substr(3,2);
                    var sda=new Array();
                    var start_time=year+"-"+month+"-"+d+" "+t;
                    var CLASSINFO=[];
                    CLASSINFO['class_time']=start_time;
                    CLASSINFO['class_id']=$(this).val();
                    CLASSINFO['class_type']=$(this).attr('classtype');
                    CLASSINFO['package_id']=$(this).attr('package');
                    TEMPCLASSL.push(CLASSINFO);
                };
            });

            // $("#packageid").change(function(){
            //     $("#makesure").html('确认选择');
            // });

            $('#makesure').click(function(){
                var tempclass = [];
                for (var i = 0; i < TEMPCLASSL.length; i++) {
                    step3(TEMPCLASSL[i]);
                }
                // console.log(TEMPCLASSL);
                TEMPCLASSL = [];
                step1();
            });
            $("#cancelclasschoose").click(function(){
                TEMPCLASSL = [];
            });
        }

        //批量删除
        $('#deleteall').click(function(){
            TEMPCLASSL = [];
            $(this).parents('table').find('tbody').html('');
        })


        var packafenumarr=0;
        //根据教师的ID获取教师的课程信息
        $('.xuanzekecheng').click(function(){
            //先获取老师的ID
            var teacher_id=$(this).parent().parent().find('span').html();
            // alert(teacher_id);
            $.ajax({
                type:'post',
                url: "<?php echo U('Class/ajaxGetTeacherClassInfo');?>/user_id/<?php echo ($studentID); ?>",
                data: "teacher_id="+teacher_id,
                success:function(classes){
                 if(classes=='error'||classes==''||classes==null)
                 {
                     $("#jiaoshikebiao1 tbody").html("");
                     $("#yeararr").html("");
                     $("#montharr").html("");
                     $("#weekarr").html("");

                     $("#teachertable tbody").html("");
                    $("#jiaoshikebiao1 tbody").html("<tr><td colspan='6' style='text-align:center'>该教师没有可选课程</td></tr>");
                 }
                 else if(classes == "0"){
                     $("#jiaoshikebiao1 tbody").html("");
                     $("#yeararr").html("");
                     $("#montharr").html("");
                     $("#weekarr").html("");

                     $("#teachertable tbody").html("");
                    $("#jiaoshikebiao1 tbody").html("<tr><td colspan='6' style='text-align:center'>你没有激活状态的套餐，无法进行定课</td></tr>");
                 }
                 else if(classes == "1"){
                   alert('你的套餐无法选择该教师的课程');
                   return;
                 }
                 else
                 {
                    classes = JSON.parse(classes);
                    $("#jiaoshikebiao1 tbody").html("");
                    $("#yeararr").html("");
                    $("#montharr").html("");
                    $("#weekarr").html("");
                    var arr=new Array();
                    var yarr=new Array();

                    for(var i=0;i<classes.length;i++){
                            /**
                             * 1.classes内部存放了所有的课程信息
                             * 2.把课程信息的时间分成年月日提取出来
                             * 3.写成一个数组，存放 ｛年，月，日，时间，第几周，第几天，第几行｝
                             * 4.根据这个数组，渲染表格，表格里面放课程ID
                             */
                            var year=parseInt(classes[i]['start_time'].substr(0,4));
                            var month=parseInt(classes[i]['start_time'].substr(5,2));
                            var day=parseInt(classes[i]['start_time'].substr(8,2));
                            var time=classes[i]['start_time'].substr(11,5);
                            var date=new Date(year,month,0);
                            date.setDate(1);
                            var firstwekday=(date.getDay() == 0)?7:date.getDay();//本月一号是周几
                            var dijizhou=(day<=(7-firstwekday+1))?1:(parseInt((day-(7-firstwekday+1)+6)/7)+1);//第几周
                            var dijitian=(day<=(7-firstwekday+1))?(firstwekday+day-1):((day-(7-firstwekday+1)+6)%7+1);//第几天
                            arr.push({"class_id":classes[i]['classID'],"start_time":classes[i]['start_time'],"class_type":classes[i]['class_type'],"year":year,"month":month,"dijizhou":dijizhou,"time":time});
                            if(yarr.indexOf(year)=='-1'){
                                yarr.push(year);
                            }

                    }

                    var hasmonth=function(year){
                        var montharr=[];
                        for (var i = 0; i < arr.length; i++) {
                            if(year==arr[i]['year']){
                                if(montharr.indexOf(arr[i]['month'])==-1){
                                    montharr.push(arr[i]['month']);
                                }
                            }
                        }
                        return montharr;
                    }

                    var hasweek=function(year,month){
                        var weekarr=[];
                        for (var i = 0; i < arr.length; i++) {
                            if((year==arr[i]['year'])&&(month==arr[i]['month'])){
                                if(weekarr.indexOf(arr[i]['dijizhou'])==-1){
                                    weekarr.push(arr[i]['dijizhou']);
                                }
                            }
                        }
                        return weekarr;
                    }

                    var hastime=function(year,month,week){
                        var timearr=[];
                        for (var i = 0; i < arr.length; i++) {
                            if(year==arr[i]['year']&&month==arr[i]['month']&&week==arr[i]['dijizhou']){
                                if(timearr.indexOf(arr[i]['time'])==-1){
                                    timearr.push(arr[i]['time']);
                                }
                            }
                        }
                        return timearr;
                    }


                    yarr.sort(function(a,b){
                        return a-b;
                    });

                    for (var i = 0; i < yarr.length; i++) {
                        $("#yeararr").append("<option>"+yarr[i]+"</option>");
                    }

                    var tyear=$("#yeararr").val();
                    //获取有多少月
                    var montharr=hasmonth(tyear);
                    montharr.sort(function(a,b){
                        return a-b;
                    });
                    for (var i = 0; i < montharr.length; i++) {
                        $("#montharr").append("<option>"+montharr[i]+"</option>");
                    }
                    //获取有多少周
                    var tmonth=$("#montharr").val();
                    // console.log(tmonth);
                    var weekarr=hasweek(tyear,tmonth);
                    // console.log(weekarr);
                    weekarr.sort(function(a,b){
                            return a-b;
                    });
                    for (var i = 0; i < weekarr.length; i++) {
                        $("#weekarr").append("<option>"+weekarr[i]+"</option>");
                    }
                    //获取有多少时间
                    var tweek=$('#weekarr').val();
                    var tarr=hastime(tyear,tmonth,tweek);
                    // console.log(arr);
                    //这里做初始化表格和课程的渲染
                    tableinit(tyear,tmonth,tweek,arr,tarr);
                    $("#yeararr").change(function(){
                        $("#montharr").html(" ");
                        var tyear=$("#yeararr").val();
                        //获取有多少月
                        var montharr=hasmonth(tyear);
                        montharr.sort(function(a,b){
                            return a-b;
                        });
                        for (var i = 0; i < montharr.length; i++) {
                            $("#montharr").append("<option>"+montharr[i]+"</option>");
                        }
                        var tyear=$("#yeararr").val();
                        var tmonth=$("#montharr").val();
                        var tweek=$("#weekarr").val();
                        var tarr=hastime(tyear,tmonth,tweek);
                        tableinit(tyear,tmonth,tweek,arr,tarr);
                    });
                    $("#montharr").change(function(){
                        $("#weekarr").html(" ");
                        var tyear=$("#yeararr").val();
                        var tmonth=$("#montharr").val();
                        var weekarr=hasweek(tyear,tmonth);
                        weekarr.sort(function(a,b){
                            return a-b;
                        });
                        for (var i = 0; i < weekarr.length; i++) {
                            $("#weekarr").append("<option>"+weekarr[i]+"</option>");
                        }

                        var tyear=$("#yeararr").val();
                        var tmonth=$("#montharr").val();
                        var tweek=$("#weekarr").val();
                        var tarr=hastime(tyear,tmonth,tweek);
                        tableinit(tyear,tmonth,tweek,arr,tarr);
                    });
                    $("#weekarr").change(function(){
                        var tyear=$("#yeararr").val();
                        var tmonth=$("#montharr").val();
                        var tweek=$("#weekarr").val();
                        var tarr=hastime(tyear,tmonth,tweek);

                        tableinit(tyear,tmonth,tweek,arr,tarr);
                    });

                 }
                    $('#teacherclass').modal();

                }
            });
            //加入套餐数据
            $.ajax({
              type:'post',
                url: "<?php echo U('OrderPackage/ajaxGetStuOrderPackageInfo');?>/user_id/<?php echo ($studentID); ?>",
                data: "teacher_id="+teacher_id,
                success:function(packages){
                    if(packages!="[]"){
                        $("#packageid").html(" ");
                        var packageinfo=JSON.parse(packages);
                        for (var i = 0; i < packageinfo.length; i++) {
                            // $("#packageid").append("<option value='"+packageinfo[i]['packageid']+"_"+packageinfo[i]['packagenumber']+"' style='overflow:hidden'>"+packageinfo[i]['packagename']+"</option>");
                            $("#packageid").append("<option value='"+packageinfo[i]['orderpackageID']+"_"+
                            packageinfo[i]['packageNum']+"' style='overflow:hidden'>"+packageinfo[i]['packageName']+"(课程剩余:"+packageinfo[i]['packageNum']+")"+
                            "</option>");
                            var tt=[];
                            tt['package_id']=packageinfo[i]['orderpackageID'];
                            tt['package_num']=packageinfo[i]['packageNum'];
                            tt['getnum']=0;
                            PACKAGEINFO.push(tt);
                        };
                        $("#makesure").html('确认选择');
                    }else{
                        alert("没有指定类型的套餐");
                    };
                }
            });
        })




            //点击选择教材，获取教材ID存放到全局变量里，然后执行逻辑step2
            // $('.getbookinfo').click(function(){
            //     var book_id=$(this).parent().parent().find('p').html();
            //     BOOKINFO=book_id;
            //     step2();
            // })

            //提交预约课程的记录
            $('#submitorderclasslist').click(function(){
                var CLASS_ID=new Array();
                // var BOOK_ID=new Array();
                //需要做重复时间的判断,定义一个新的数组来存放时间,每次循环,判断是否在数组中存在相同的项,是则停止且报错,否则加入数组
                var TIME_ARR=new Array();
                var length=$('#jiaoshikebiao3 tbody tr').length;
                if(length<1){
                    alert('课程数量为零!请选择课程!');
                    return;
                };
                for (var i = 0; i < PACKAGEINFO.length; i++) {
                    PACKAGEINFO[i]['getnum']=0;
                }
                for(var j=0;j<length;j++){
                    var classinfo={};
                    classinfo['class_id']=$('#jiaoshikebiao3 tbody tr').eq(j).find('td').html();
                    classinfo['package_id']=$('#jiaoshikebiao3 tbody tr').eq(j).find('td').eq(3).html();

                    //获取时间
                    classinfo['class_time']=$('#jiaoshikebiao3 tbody tr').eq(j).find('td').eq(1).html();

                    //判断可以加入数组还是直接退出
                    if(TIME_ARR.indexOf(classinfo['class_time'])==-1){
                        //不存在,则加入
                        TIME_ARR.push(classinfo['class_time']);
                    }else{
                        alert('存在相同时间段的课程,请确认');
                        return;
                    }

                    if(classinfo['package_id']==null){
                        alert('套餐数据为空!');
                        return;
                    }
                    if(classinfo['class_id']==null){
                        alert('课程数据错误!');
                        return;
                    }
                    CLASS_ID.push(classinfo);
                };
                var flag=true;
                $("#jiaoshikebiao3 tbody tr").each(function(){

                    for (var i = 0; i < PACKAGEINFO.length; i++) {
                        if(PACKAGEINFO[i]['package_id']==$(this).find('td').eq(3).html()){
                            PACKAGEINFO[i]['getnum']++;
                        }
                        if(PACKAGEINFO[i]['getnum']>PACKAGEINFO[i]['package_num']){
                            flag=false;
                        }
                    }
                });
                var updata_id = JSON.stringify(CLASS_ID);
                // var updata_book = JSON.stringify(BOOK_ID);
                console.log(updata_id);
                if(flag==false){
                    alert('提交課程超過可選的課程數量!請檢查套餐課程數量是否足夠!');
                    return;
                }else{
                    $.ajax({
                        type:'post',
                        url: "<?php echo U('OrderClass/studentOneOrderClass');?>/user_id/<?php echo ($studentID); ?>",
                        data:'id_data='+updata_id,
                        success:function(classes){
                            if(classes!='error'){
                                alert(classes);
                                location.reload();//刷新页面
                            }else{
                                alert(classes);
                                location.reload();//刷新页面
                            }
                        }
                    });
                }
            })

    </script>

</body>

</html>