<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
将教师上传的笔记放教师的日评中(这个暂时没有完成)
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
                                    <a href="<?php echo U('Comment/studentComment');?>"><i class="fa fa-book fa-fw"></i> 评价教师</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Comment/showCommentFromTeacher');?>"><i class="fa fa-book fa-fw"></i> 教师的评价</a>
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
                        <h1 class="page-header">教师评论</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">教师评论</div>
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#dayV" data-toggle="tab">课程评论</a>
                                </li>
                                <li><a href="#weekV" data-toggle="tab">周评</a>
                                </li>
                                <li><a href="#mouthV" data-toggle="tab">月评</a>
                                </li>
                                <li><a href="#TestClassV" data-toggle="tab">试听评论</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="dayV">
                                    <h4>课程评论</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>评论编号</th>
                                                <th>评论教师</th>
                                                <th>评论等级</th>
                                                <th>评论内容</th>
                                                <th>评论时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(is_array($classcomment)): foreach($classcomment as $key=>$value): if($value['isdelete']==0){?>
                                                 <tr>
                                                     <td><?php echo ($value['oneteachercomID']); ?></td>
                                                     <td><?php echo ($value['englishname']); ?></td>
                                                     <td><?php echo ($value['commentlevel']); ?></td>
                                                     <td><?php echo ($value['commentcontent']); ?></td>
                                                     <td><?php echo (date("Y-m-d H:i:s",$value['createTime'])); ?></td>
                                                 </tr>
                                            <?php } endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="weekV">
                                    <h4>周评</h4>
                                     <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>评论编号</th>
                                                <th>评论教师</th>
                                                <th>当前进度</th>
                                                <th>未来进度</th>
                                                <th>评论等级</th>
                                                <th>评论内容</th>
                                                <th>评论时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(is_array($weekcomment)): foreach($weekcomment as $key=>$value): if($value['isdelete']==0){?>
                                                 <tr>
                                                     <td><?php echo ($value['oneteachercomID']); ?></td>
                                                     <td><?php echo ($value['englishname']); ?></td>
                                                     <td><?php echo ($value['curProgress']); ?></td>
                                                     <td><?php echo ($value['furProgress']); ?></td>
                                                     <td><?php echo ($value['commentlevel']); ?></td>
                                                     <td><?php echo ($value['commentcontent']); ?></td>
                                                     <td><?php echo (date("Y-m-d H:i:s",$value['createTime'])); ?></td>
                                                 </tr>
                                            <?php } endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="mouthV">
                                    <h4>月评</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>评论编号</th>
                                                <th>评论教师</th>
                                                <th>评论等级</th>
                                                <th>
                                                  相关周评
                                                </th>
                                                <th>评论内容</th>
                                                <th>评论时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <!-- <tr>
                                            <td>2</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td><a href="#" id="getweekcommontatthismonth" data-target="#xianguanzhoup" data-toggle="modal">查看相关周评</a></td>
                                            <td>1</td>
                                            <td>1</td>
                                          </tr> -->
                                            <?php if(is_array($monthcomment)): foreach($monthcomment as $key=>$value): if($value['isdelete']==0){?>
                                                 <tr>
                                                     <td><?php echo ($value['oneteachercomID']); ?></td>
                                                     <td><?php echo ($value['englishname']); ?></td>
                                                     <td><?php echo ($value['commentlevel']); ?></td>
                                                     <td>
                                                       <a href="#" id="getweekcommontatthismonth" data-toggle="modal" data-target="#xianggaunzp">相关周评</a>
                                                     </td>
                                                     <td><?php echo ($value['commentcontent']); ?></td>
                                                     <td><?php echo (date("Y-m-d H:i:s",$value['createTime'])); ?></td>
                                                 </tr>
                                              <?php } endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- 试听课评论START-->
                                <div class="tab-pane fade" id="TestClassV">
                                    <table class="table">
                                      <h4>试听评论</h4>
                                        <thead>
                                            <tr>
                                                <th>评论编号</th>
                                                <th>评论教师</th>
                                                <th>总体评论</th>
                                                <th>听评论</th>
                                                <th>说评论</th>
                                                <th>读评论</th>
                                                <th>写评论</th>
                                                <th>评论内容</th>
                                                <th>评论时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php if(is_array($testcomment)): foreach($testcomment as $key=>$value): if($value['isdelete']==0){?>
                                                 <tr>
                                                     <td><?php echo ($value['oneteachercomID']); ?></td>
                                                     <td><?php echo ($value['englishname']); ?></td>
                                                     <td><?php echo ($value[0]); ?></td>
                                                     <td><?php echo ($value[1]); ?></td>
                                                     <td><?php echo ($value[2]); ?></td>
                                                     <td><?php echo ($value[3]); ?></td>
                                                     <td><?php echo ($value[4]); ?></td>
                                                     <td><?php echo ($value['commentcontent']); ?></td>
                                                     <td><?php echo (date("Y-m-d H:i:s",$value['createTime'])); ?></td>
                                                 </tr>
                                            <?php } endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- 试听课评论END -->
                            </div>
                        </div>
                        <div class="panel-footer" style="overflow: auto;">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->


            <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="xianggaunzp">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                      相关周评信息
                  </div>
                  <div class="modal-body">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>
                              周评编号
                            </th>
                            <th>
                              周评时间
                            </th>
                            <th>
                              周评等级
                            </th>
                            <th>
                              周评内容
                            </th>
                          </tr>
                        </thead>
                        <tbody id="xianguanzhouptbody">

                        </tbody>
                      </table>
                  </div>
                  <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary">提交</button>
                  </div> -->
                </div>
              </div>
            </div>





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

        $("#getweekcommontatthismonth").click(function(){
          var monthV_id=$(this).parent().parent().find('td').html();
          // alert(monthV_id);
          $.ajax({
            type:'post',
            url: "<?php echo U('Student/GetMonthWeekComment');?>",
            data: "monthV_id="+monthV_id,
            success:function(classes){
              if(classes!='error'){
                var content="";
                classes = JSON.parse(classes);
                // alert(classes);
                // console.log(classes);
                for (var i = 0; i < classes.length; i++) {
                  content="<tr><td>"+
                  classes[i]['oneteachercomID']+"</td><td>"+
                  classes[i]['createTime']+"</td><td>"+
                  classes[i]['commentlevel']+"</td><td>"+
                  classes[i]['commentcontent']+"</td></tr>"
                }
                // console.log(content);
                $('#xianguanzhouptbody').html(content);
              }else{
                alert("获取失败！");
              }
            }
          })
        });

    </script>

</body>

</html>