<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
1.将获取到的课程数据分成小班课程与一对一课程
2.对于不同课程类型有不同的课程操作
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

    <!-- DataTables CSS -->
    <link href="__PUBLIC__/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

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
                             <a href="<?php echo U('Admin/MyExamination');?>"><i class="fa fa-hand-o-right fa-fw"></i> 顾问考核</a>
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
                        <h1 class="page-header">学员课表</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
               <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            一对一课表
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="display:none">订课编号</th>
                                            <th style="display:none">课程编号</th>
                                            <th>课程类型</th>
                                            <th>教材名</th>
                                            <th style="display:none">学员编号</th>
                                            <th style="display:none">套餐编号</th>
                                            <th>课程时间</th>
                                            <!-- <th>订课时间</th> -->
                                            <th>课堂笔记</th>
                                            <th>课程状态</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php if(is_array($classdata)): foreach($classdata as $key=>$value): ?><tr>
                                                <td style="display:none"><?php echo ($value['oneorderclassID']); ?></td>
                                                <td style="display:none"><?php echo ($value['classID']); ?></td>
                                                <td>
                                                    <!-- <?php switch($value['class_type']): case "0": ?>少儿<?php break;?>
                                                        <?php case "1": ?>成人<?php break;?>
                                                        <?php case "3": ?>多人<?php break;?>
                                                        <?php case "4": ?>小班<?php break;?>
                                                        <?php default: ?>无<?php endswitch;?> -->
                                                    <?php echo ($value['packageName']); ?>/
                                                    <?php switch($value['classType']): case "0": ?>一对一<?php break;?>
                                                        <?php case "1": ?>小班<?php break; endswitch;?>/
                                                    <?php switch($value['teacherNation']): case "0": ?>中教<?php break;?>
                                                        <?php case "1": ?>外教<?php break; endswitch;?>/
                                                    <?php switch($value['teacherType']): case "0": ?>普教<?php break;?>
                                                        <?php case "1": ?>名教<?php break; endswitch;?>
                                                </td>
                                                <?php $bookname=explode(":",$value['material'])[1] ?>
                                                <td><?php echo ($bookname); ?></td>
                                                <td style="display:none"><?php echo ($value['studentID']); ?></td>
                                                <td style="display:none"><?php echo ($value['orderpackageID']); ?></td>
                                                <td>
                                                    <?php echo (date("Y-m-d H:i",$value['classStartTime'])); ?>
                                                    ~
                                                    <?php echo (date("Y-m-d H:i",$value['classEndTime'])); ?>
                                                </td>
                                                <td>
                                                    <?php if(is_null($value['note_link'])||$value['note_link']==""){ ?>
                                                       空
                                                     <?php }else{ ?>
                                                    <a href="<?php echo U('Root/DownLoad',array('ID'=>$value['orderclassID']));?>">下载</a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <!-- <?php switch($value['class_status']): case "0": ?>尚未上课<?php break;?>
                                                        <?php case "1": ?>正常完成<?php break;?>
                                                        <?php case "2": ?>学员缺课<?php break;?>
                                                        <?php case "3": ?>老师缺课<?php break;?>
                                                        <?php case "4": ?>学员退课<?php break;?>
                                                        <?php case "5": ?>老师退课<?php break;?>
                                                        <?php case "6": ?>老师迟到<?php break;?>
                                                        <?php case "7": ?>学员迟到<?php break;?>
                                                        <?php case "8": ?>其他状况<?php break;?>
                                                        <?php case "9": ?>意外终止，重新安排<?php break;?>
                                                        <?php default: ?>未知<?php endswitch;?> -->
                                                    <?php switch($value['classStatus']): case "0": ?>尚未上课<?php break;?>
                                                        <?php case "1": ?>正常完成<?php break;?>
                                                        <?php case "2": ?>学员退课<?php break;?>
                                                        <?php case "3": ?>老师早退<?php break;?>
                                                        <?php case "4": ?>教师迟到<?php break;?>
                                                        <?php case "5": ?>教师缺课<?php break;?>
                                                        <?php case "6": ?>教师退课<?php break;?>
                                                        <?php case "7": ?>意外情况<?php break;?>
                                                        <?php default: ?>未知<?php endswitch;?>
                                                </td>
                                                <td>
                                                      <a href="#" class="changestatus" >更改状态</a>&nbsp;&nbsp;
                                                      <!-- <a href="<?php echo U('Root/deletestudentpersonalclass', array('orderclass_id'=>$value['orderclass_id'],'class_id'=>$value['class_id']));?>"
                                                      class="deleteStudentClassID">删除</a> -->

                                                      <?php $check = md5($value['oneorderclassID']) ?>
                                                      <a href="<?php echo U('OrderClass/studentOrderClassManage', array('ID'=>$value['oneorderclassID'],'token'=>$check,'type'=>'stuorderclasscancel'));?>"
                                                      class="cancelStudentClass">学生退课</a>

                                                      <a href="<?php echo U('OrderClass/studentOrderClassManage', array('ID'=>$value['oneorderclassID'],'token'=>$check,'type'=>'teaorderclasscancel'));?>"
                                                      class="cancelTeacherClass">教师退课</a>
                                                </td><?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer" style="overflow: auto">
                            <div class="pull-right">
                                <a href="<?php echo U('Root/BookingCourse',array('user_id'=>$student_id,'check'=>md5($student_id)));?>">
                                    <button class="btn btn-primary">
                                        添加课程
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                     <div class="panel panel-default">
                         <div class="panel-heading">
                             小班课表(暂时没有完成)
                         </div>
                         <div class="panel-body">
                             <div class="dataTable_wrapper">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                     <thead>
                                         <tr>
                                             <th style="display:none">订课编号</th>
                                             <th style="display:none">课程编号</th>
                                             <th>课程类型</th>
                                             <th>教材名</th>
                                             <th style="display:none">学员编号</th>
                                             <th style="display:none">套餐编号</th>
                                             <th>课程时间</th>
                                             <!-- <th>订课时间</th> -->
                                             <th>课堂笔记</th>
                                             <th>课程状态</th>
                                             <th>操作</th>
                                         </tr>
                                     </thead>
                                     <tbody >
                                         <?php if(is_array($classdata)): foreach($classdata as $key=>$value): ?><tr>
                                                 <td style="display:none"><?php echo ($value['oneorderclassID']); ?></td>
                                                 <td style="display:none"><?php echo ($value['classID']); ?></td>
                                                 <td>
                                                     <!-- <?php switch($value['class_type']): case "0": ?>少儿<?php break;?>
                                                         <?php case "1": ?>成人<?php break;?>
                                                         <?php case "3": ?>多人<?php break;?>
                                                         <?php case "4": ?>小班<?php break;?>
                                                         <?php default: ?>无<?php endswitch;?> -->
                                                     <?php echo ($value['packageName']); ?>/
                                                     <?php switch($value['classType']): case "0": ?>一对一<?php break;?>
                                                         <?php case "1": ?>小班<?php break; endswitch;?>/
                                                     <?php switch($value['teacherNation']): case "0": ?>中教<?php break;?>
                                                         <?php case "1": ?>外教<?php break; endswitch;?>/
                                                     <?php switch($value['teacherType']): case "0": ?>普教<?php break;?>
                                                         <?php case "1": ?>名教<?php break; endswitch;?>
                                                 </td>
                                                 <?php $bookname=explode(":",$value['material'])[1] ?>
                                                 <td><?php echo ($bookname); ?></td>
                                                 <td style="display:none"><?php echo ($value['studentID']); ?></td>
                                                 <td style="display:none"><?php echo ($value['orderpackageID']); ?></td>
                                                 <td>
                                                     <?php echo (date("Y-m-d H:i",$value['classStartTime'])); ?>
                                                     ~
                                                     <?php echo (date("Y-m-d H:i",$value['classEndTime'])); ?>
                                                 </td>
                                                 <td>
                                                     <?php if(is_null($value['note_link'])||$value['note_link']==""){ ?>
                                                        空
                                                      <?php }else{ ?>
                                                     <a href="<?php echo U('Root/DownLoad',array('ID'=>$value['orderclassID']));?>">下载</a>
                                                     <?php } ?>
                                                 </td>
                                                 <td>
                                                     <!-- <?php switch($value['class_status']): case "0": ?>尚未上课<?php break;?>
                                                         <?php case "1": ?>正常完成<?php break;?>
                                                         <?php case "2": ?>学员缺课<?php break;?>
                                                         <?php case "3": ?>老师缺课<?php break;?>
                                                         <?php case "4": ?>学员退课<?php break;?>
                                                         <?php case "5": ?>老师退课<?php break;?>
                                                         <?php case "6": ?>老师迟到<?php break;?>
                                                         <?php case "7": ?>学员迟到<?php break;?>
                                                         <?php case "8": ?>其他状况<?php break;?>
                                                         <?php case "9": ?>意外终止，重新安排<?php break;?>
                                                         <?php default: ?>未知<?php endswitch;?> -->
                                                     <?php switch($value['classStatus']): case "0": ?>尚未上课<?php break;?>
                                                         <?php case "1": ?>正常完成<?php break;?>
                                                         <?php case "2": ?>学员退课<?php break;?>
                                                         <?php case "3": ?>老师早退<?php break;?>
                                                         <?php case "4": ?>教师迟到<?php break;?>
                                                         <?php case "5": ?>教师缺课<?php break;?>
                                                         <?php case "6": ?>教师退课<?php break;?>
                                                         <?php case "7": ?>意外情况<?php break;?>
                                                         <?php default: ?>未知<?php endswitch;?>
                                                 </td>
                                                 <td>
                                                   <a href="#" class="changestatus" >更改状态</a>&nbsp;&nbsp;
                                                   <a href="<?php echo U('Root/deletestudentpersonalclass',array('orderclass_id'=>$value['orderclass_id'],'class_id'=>$value['class_id']));?>" class="deleteStudentClassID">删除</a>
                                                   <?php $check = md5($value['orderclass_id']) ?>
                                                   <a href="<?php echo U('Root/CancelStudentOrderClass',array('ID'=>$value['orderclass_id'],'token'=>$check));?>" class="cancelStudentClass">学生取消课程</a>
                                                   <a href="#" class="cancelTeacherClass">教师退课</a>
                                                 </td><?php endforeach; endif; ?>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        <!-- 模态框1,更改课程状态 -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="classstatus">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        更改课程状态
                    </div>
                    <div class="modal-body"  style="overflow: auto;">
                        <form class="form" method="post" action="<?php echo U('OrderClass/studentOrderClassManage',array('type'=>'cgestatus','classtype'=>'one'));?>">
                            <div class="form-group">
                                <label>订课编号</label>
                                <input type="text" name="orderclassID" readonly="true"  class="form-control orderclassID">
                            </div>
                            <div class="form-group">
                                <label>课程状态</label>
                                <select class="form-control classstatus" name="classStatus">
                                    <option value="-1">&nbsp;</option>
                                    <!-- <option value="0">尚未上课</option> -->
                                    <option value="1">正常完成</option>
                                    <!-- <option value="2">学员退课</option> -->
                                    <option value="3">老师早课</option>
                                    <option value="4">老师迟到</option>
                                    <option value="5">老师缺课</option>
                                    <!-- <option value="6">老师迟到</option> -->
                                    <option value="7">其他情况</option>
                                </select>
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
        <!-- 模态框4 -->
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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('.changestatus').click(function(){
            var orderclass_id=$(this).parent().parent().find('td').eq(0).html();
            $('.orderclassID').val(orderclass_id);
            $('#classstatus').modal();
        });
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
    </script>

    <script type="text/javascript">
        $('.deleteStudentClassID').click(function(e){
            if(confirm('是否删除该条学生课程数据')){
                return true;
            }else{
                return false;
            }
        })

        $('.cancelStudentClass').click(function(e){
            if(confirm('是否为该学生退课(取消课程)')){
                return true;
            }else{
                return false;
            }
        })

        $(".cancelTeacherClass").click(function(){
            if(confirm('是否为该教师退课(取消课程)')){
                return true;
            }else{
                return false;
            }
        })
    </script>>

</body>

</html>