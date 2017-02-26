<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

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
   <!--  [if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-- -->

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
                            <a href="<?php echo U('Admin/index');?>"><i class="fa fa-home fa-fw"></i> 顾问中心</a>
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
                             <a href="<?php echo U('Admin/FeedBack');?>"><i class="fa fa-exchange fa-fw"></i> 接入学生</a>
                        </li>
                        <li>
                             <a href="<?php echo U('Admin/MyExamination');?>"><i class="fa fa-hand-o-right fa-fw"></i> 顾问考核</a>
                        </li>
                         <li>
                             <a href="<?php echo U('Admin/Notice');?>"><i class="fa fa-question-circle fa-fw"></i> 顾问须知</a>
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
                        <h1 class="page-header">所有学员</h1>
                    </div>
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
                                            <th>学员ID</th>
                                            <th>学员账号</th>
                                            <th>中文名</th>
                                            <th>英文名</th>
                                            <th>学员性别</th>
                                            <!-- <th>个人课表</th> -->
                                            <th>其他信息</th>
                                            <th>账号状态</th>
                                            <!-- <th>安排试听课</th> -->
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <?php if(is_array($student_list)): foreach($student_list as $key=>$vo): ?><tr>
                                            <td><?php echo ($vo["ID"]); ?></td>
                                            <td><?php echo ($vo["account"]); ?></td>
                                            <td><?php echo ($vo["chinesename"]); ?></td>
                                            <td><?php echo ($vo["englishname"]); ?></td>
                                            <td>
                                                <?php if(($vo["sex"]) == "0"): ?>女<?php endif; ?>
                                                <?php if(($vo["sex"]) == "1"): ?>男<?php endif; ?>
                                            </td>
                                            <td><a href="" data-toggle="modal" data-target=".bs-example-modal-lg3" class="getpersoninfo">信息查看</a></td>
                                            <td>
                                                <?php if(($vo["status"]) == "0"): ?>禁用<?php endif; ?>
                                                <?php if(($vo["status"]) == "1"): ?>开启<?php endif; ?>
                                            </td>
                                            <!-- <td><a href="<?php $check = md5($value['register_id']); echo U('Admin/StuPersonalClass',array('register_id'=>$value['register_id'],'check'=>$check));?>">点击查看</a></td>
                                            <td><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg2" class="getmoreinfo">点击查看</a></td>
                                            <td>
                                                <?php if($value['can_use_account'] == 0) echo "不可用";else echo "可用";?>
                                            </td> -->
                                            <!-- <td><a href="#">改变账户状态</a></td> -->
                                            <!-- <td><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg1" class="getstudentid">选择教师</a></td> -->
                                        </tr><?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 用来查看学生的信息-->
                            <div class="modal fade bs-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        学员信息
                                        </div>
                                        <div class="modal-body"  style="overflow: auto;">
                                            <div class="col-lg-2">
                                                <img src="" alt="没有头像" style="height: 120px;width:120px;" id="personalimage">
                                                <!-- <h3>个人信息</h3> -->
                                                <!-- <p id="personalproduct"></p> -->
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
                            </div>
                            <!-- 模态框1,查看用户课表 -->
                            <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                  <div class="modal-header">
                                        选择教师
                                        </div>
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" role="tablist">
                                              <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">外教</a></li>
                                              <!-- <li role="presentation"><a href="#profile" role="tab" data-toggle="tab">中教</a></li> -->
                                              <li role="presentation"><a href="#messages" role="tab" data-toggle="tab">名师</a></li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                              <div role="tabpanel" class="tab-pane active" id="home">
                                                  <h4>普通教师列表</h4>
                                                  <div class="lope">
                                                    <?php foreach ($teacher_result as $key => $value) { if($value['teacher_level'] == '0'){?>
                                                        <div class="col-lg-12 laoshiif waitao">
                                                            <div class="col-xs-3 laoshiif">
                                                                <a href="<?php echo U('Admin/SendLesson',array('id'=>$value['register_id'],'status'=>md5($value['register_id'])));?>" class="choosetea"><img src="<?php echo ($value['image_path']); ?>"></a>
                                                            </div>
                                                            <div class="col-xs-7 laoshiif">
                                                                <h3><?php echo ($value['teacher_name']); ?></h3>
                                                                <p><?php echo ($value['introduction']); ?></p>
                                                            </div>
                                                            <!-- <div class="col-xs-2 laoshiif">
                                                                <a href="<?php echo U('Student/TeacherInformation',array('id'=>$value['register_id'],'status'=>md5($value['register_id'])));?>">
                                                                    <button type="button" class="btn btn-default btn-circle btn-lg">
                                                                        <i class="fa fa-link"></i >
                                                                    </button>
                                                                </a>
                                                            </div>   -->
                                                        </div>
                                                    <?php }}?>
                                                </div>
                                              </div>
                                              <!-- <div role="tabpanel" class="tab-pane" id="profile">
                                                  <h4>中教列表</h4>
                                                  <div class="lope">
                                                    <?php foreach ($teacher_result as $key => $value) { if($value['teacher_level'] == '0' && ($value['country'] == '中国' || $value['country'] == 'china')) {?>
                                                        <div class="col-lg-12 laoshiif waitao">
                                                            <div class="col-xs-3 laoshiif">
                                                                <a href="<?php echo U('Admin/SendLesson',array('id'=>$value['register_id'],'status'=>md5($value['register_id'])));?>" class="choosetea"><img src="<?php echo ($value['image_path']); ?>"></a>
                                                            </div>
                                                            <div class="col-xs-7 laoshiif">
                                                                <h3><?php echo ($value['teacher_name']); ?></h3>
                                                                <p><?php echo ($value['introduction']); ?></p>
                                                            </div> -->
                                                            <<!-- div class="col-xs-2 laoshiif">
                                                                <a href="<?php echo U('Student/TeacherInformation',array('id'=>$value['register_id'],'status'=>md5($value['register_id'])));?>">
                                                                    <button type="button" class="btn btn-default btn-circle btn-lg">
                                                                        <i class="fa fa-link"></i >
                                                                    </button>
                                                                </a>
                                                            </div>  -->
                                                 <!--        </div>
                                                    <?php }}?>
                                                </div>
                                              </div> -->
                                              <div role="tabpanel" class="tab-pane" id="messages">
                                                  <h4>名师列表</h4>
                                                  <div class="lope">
                                                    <?php foreach ($teacher_result as $key => $value) { if($value['teacher_level'] == '1') {?>
                                                        <div class="col-lg-12 laoshiif waitao">
                                                            <div class="col-xs-3 laoshiif">
                                                                <a href="<?php echo U('Admin/SendLesson',array('id'=>$value['register_id'],'status'=>md5($value['register_id'])));?>" class="choosetea"><img src="<?php echo ($value['image_path']); ?>"></a>
                                                            </div>
                                                            <div class="col-xs-7 laoshiif">
                                                                <h3><?php echo ($value['teacher_name']); ?></h3>
                                                                <p><?php echo ($value['introduction']); ?></p>
                                                            </div>
                                                            <!-- <div class="col-xs-2 laoshiif">
                                                                <a href="<?php echo U('Student/TeacherInformation',array('id'=>$value['register_id'],'status'=>md5($value['register_id'])));?>">
                                                                    <button type="button" class="btn btn-default btn-circle btn-lg">
                                                                        <i class="fa fa-link"></i >
                                                                    </button>
                                                                </a>
                                                            </div>  -->
                                                        </div>
                                                    <?php }}?>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                            <button type="submit" class="btn btn-primary">提交</button>
                                        </div>
                                </div>
                              </div>
                            </div>
                            <!-- 模态框1 -->
                            <!-- 模态框2,查看用户信息 -->
                            <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        教师信息
                                        </div>
                                         <div class="modal-body">
                                           邮箱:
                                            <span class="emailinfo"></span>
                                            <br>
                                            联系号码:
                                            <span class="telinfo"></span>
                                            <br>
                                            QQ:
                                            <span class="QQinfo"></span> &nbsp;
                                            ZOOM:
                                            <span class="zoominfo"></span> &nbsp;
                                            skype:
                                            <span class="skypeinfo"></span>
                                            <br>
                                            地域:
                                            <span class="areainfo"></span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 模态框2 -->
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
    <script src="__PUBLIC__/js/md5.js"></script>

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
    //axaj请求返回用户信息
    // $(".getmoreinfo").click(function(){
    //     var SCri=$(this).parent().siblings(':first').next().html();
    //     var request = new XMLHttpRequest();
    //     var re="";
    //     var obj="";
    //     request.open("POST",'__URL__/doinfo');
    //     var data = "userID="+SCri;
    //     // alert(data);
    //     request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //     request.send(data);
    //     request.onreadystatechange = function() {
    //             if (request.readyState===4) {
    //                 if (request.status===200) {
    //                     re=request.responseText;
    //                     obj=JSON.parse(re);
    //                     $(".emailinfo").html(obj.email);
    //                     $(".telinfo").html(obj.phonenumber);
    //                     $(".QQinfo").html(obj.qq);
    //                     $(".zoominfo").html(obj.zoom);
    //                     $(".skypeinfo").html(obj.skype);
    //                     $(".areainfo").html(obj.country);
    //                 } else {
    //                     alert("发生错误：" + request.status);
    //                 }
    //             }
    //     }
    // })en
    var stuID;
    var check;
    // var teaID;
    // var status;
    $('.getstudentid').click(function(){
        stuID=$(this).parent().parent().children(':first').html();
        check=hex_md5(stuID);
        // var n="<?php echo U('Admin/SendLesson',array('id'=>$value['register_id'],'status'=>md5($value['register_id'])));?>";
        // var n = ($('.choosetea').attr('href')).split('/')[6];
        // alert(n);
        // $('.choosetea').attr('href',n+'/stuid/'+stuID+'/check/'+check);
        // alert($('.choosetea').parent().html());
        // $.UrlUpdateParams(window.location.href, "mid");

    });
    $('.choosetea').click(function(){
            teaID=$(this).attr('href');
            // teaID=teaID.split('/')[6];
            // status=status.split('/')[7];
            // alert(teaID);
            // alert(hex_md5(teaID));
            $('.choosetea').attr('href',teaID+'/stuid/'+stuID+'/check/'+check);
    })
    </script>

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();
    </script>

    <script type="text/javascript">
        $('.getpersoninfo').click(function(){
            // alert('asd');
            var user_id = $(this).parents('tr').find('td').eq(0).html();
            $.ajax({
                type:"POST",
                url:"<?php echo U('Admin/getstudentinformation');?>",
                data:"user_id="+user_id,
                success:function(msg){
                    if(msg != 'error'){
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
                        // +"</td><th>接入时间</th><td>"+msg['0']['accept_time']
                        +"</td></tr>"
                        +"</td><th>顾问编号</th><td>"+msg['0']['student_manage_id']
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
        })
    </script>

</body>

</html>