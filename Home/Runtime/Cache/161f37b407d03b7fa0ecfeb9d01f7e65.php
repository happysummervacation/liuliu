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
                        <h1 class="page-header">查看顾问</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            顾问列表
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>顾问编号</th>
                                            <th>顾问姓名</th>
                                            <th>微信</th>
                                            <th>QQ</th>
                                            <th>phone</th>
                                            <th>email</th>
                                            <!-- <th>顾问信息</th> -->
                                            <th>工资信息</th>
                                            <th>分管学生</th>
                                            <th>账号状态</th>
                                            <th>系统操作</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <?php $i = 1; foreach ($admins as $key => $value) {?>
                                        <tr>
                                            <td class="adminID"><?php echo ($value['ID']); ?></td>
                                            <td><?php echo ($value['account']); ?></td>
                                             <td><?php echo ($value['weixin']); ?></td>
                                            <td><?php echo ($value['QQ']); ?></td>
                                            <td><?php echo ($value['phone']); ?></td>
                                            <td><?php echo ($value['email']); ?></td>
                                            <!-- <td><a href="#" data-toggle="modal" data-target="#modalpersoninfo" class="getpersoninfo" >查看信息</a></td> -->
                                            <td><a href="#" data-toggle="modal" data-target="#modalmoneyinfo" class="getmoneyinfo" >查看工资</a></td>
                                            <td><a href="#" data-toggle="modal" data-target="#modalstdinfo" class="getstdlist" >查看学员</a></td>
                                            <td><?php if($value['status'] == 1) {echo "可用";} else {echo "不可用";}?></td>
                                            <td>
                                                <?php if(($value['status']) == "1"): ?><a href="<?php echo U('Info/UserManage', array('personType'=>'admin','type'=>'resetStatus','user_id'=>$value['ID'],'status'=>'0'));?>">
                                                        <button class="btn btn-primary" style="margin:5px">禁用账号</button>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo U('Info/UserManage',array('personType'=>'admin','type'=>'resetStatus','user_id'=>$value['ID'],'status'=>'1'));?>">
                                                         <button class="btn btn-primary" style="margin:5px">启用账号</button>
                                                    </a><?php endif; ?>
                                                <button type="button" class="editAdmin btn btn-primary" name="button" style="margin:5px">修改</button>
                                                <a href="<?php echo U('Info/ResetPassword',array('type'=>'check','user_id'=>$value['account']));?>" class="resetPasswordID"><button class="btn btn-primary" style="margin:5px">一键重置密码</button></a>
                                                <a href="<?php echo U('Info/UserManage',array('personType'=>'admin','type'=>'delete','user_id'=>$value['ID']));?>" class="removeAccountID"><button class="btn btn-primary" style="margin:5px">彻底删除</button></a>
                                            </td>
                                        </tr>
                                    <?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="editAdminInfo">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            修改顾问资料
                        </div>
                        <div class="panel-body">
                          <form class="form-horizontal" action="<?php echo U('Info/UserManage',array('personType'=>'admin','type'=>'update'));?>" method="post" role="form">
                            <div class="form-group">
                              <label for="firstname" class="col-sm-2 control-label">账号</label>
                              <div class="col-sm-10">
                                <input id="account" type="text" readonly="true" name="account" class="form-control" placeholder="账号" >
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

    <!-- 模态框,查看用户信息 -->
    <!-- <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalpersoninfo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                顾问信息
                </div>
                <div class="modal-body" style="overflow: auto;">
                    <div class="col-lg-2">
                        <img src="" alt="没有头像" style="height: 120px;width:120px;" id="personalimage">
                        <h3>个人介绍</h3>
                        <p id="personalproduct"></p>
                    </div>
                    <div class="col-lg-10">
                        <table class="table teacherinformation">

                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- 模态框 -->
    <!-- 模态框2,查看用户工资信息 -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalmoneyinfo">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                工资信息
                </div>
                <div class="modal-body" style="overflow: auto;">
                    <div class="col-lg-12">
                      <div class="form-group col-lg-5">
                        <label for="year">年份</label>
                        <select class="form-control year" name="year">
                          <option value="2016">2016年</option>
                          <option value="2017">2017年</option>
                          <option value="2018">2018年</option>
                          <option value="2019">2019年</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-5">
                        <label for="month">月份</label>
                        <select class="form-control month" name="month">
                          <option value="1">1月</option>
                          <option value="2">2月</option>
                          <option value="3">3月</option>
                          <option value="4">4月</option>
                          <option value="5">5月</option>
                          <option value="6">6月</option>
                          <option value="7">7月</option>
                          <option value="8">8月</option>
                          <option value="9">9月</option>
                          <option value="10">10月</option>
                          <option value="11">11月</option>
                          <option value="12">12月</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-2">
                        <label for="" style="visibility:hidden">提交篩選</label><br>
                        <button type="submit" name="button" class="btn btn-primary" id="findmoneybytime">提交</button>
                      </div>
                    </div>
                    <table class="table table-hover" id="adminmoneytable">
                      <thead>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 模态框2 -->
    <!-- 模态框3,查看接入学生 -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalstdinfo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                分管学生
                </div>
                <div class="modal-body" style="overflow: auto;">
                    <table class="table" id="stduentLIST">
                        <thead>
                            <tr>
                                <th>学员编号</th>
                                <th>学员昵称</th>
                                <th>分管时间</th>
                                <th>联系方式</th>
                                <th>账户余额</th>
                                <th>本月充值</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 模态框 -->
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

        $('.getpersoninfo').click(function(){
            var user_id=$(this).parents('tr').find('td').eq(0).html();
            $.ajax({
                type: "POST",
                url: "<?php echo U('Root/getadmininformation');?>",
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
                        +"</td><th>skype</th><td>"+msg['0']['skype']
                        +"</td></tr>"
                        +"</td><th>邮箱</th><td>"+msg['0']['email']
                        +"</td><th>PAYPAL</th><td>"+msg['0']['paypal']
                        +"</td><th>银行卡</th><td>"+msg['0']['bankcard']
                        +"</td></tr>";
                        $('.teacherinformation').html(innerhtml);
                        $('#personalimage').attr('src',msg['0']['image_path']);
                        $('#personalproduct').html(msg['0']['introduction']);
                    }else{
                        alert('未知错误!');
                    }
                }
            })
        })

        $('.getstdlist').click(function(){
            var user_id=$(this).parents('tr').find('td').eq(0).html();
            $('#stduentLIST tbody').html("");
            $.ajax({
                type: "POST",
                url: "<?php echo U('Root/getaccessstudentliet');?>",
                data: "user_id="+user_id,
                success:function(msg){
                   if(msg!='error'){
                    for(var i=0;i<msg.length;i++){
                        var time=new Date(parseInt(msg[i]['accept_time'])*1000).toLocaleString();
                        var  studentlist="<tr><td>"
                        +msg[i]['ID']+"</td><td>"
                        +msg[i]['account']+"</td><td>"
                        +time+"</td><td>"
                        +msg[i]['phone']+"</td><td>"
                        +msg[i]['student_sum_money']+"</td><td>"
                        +msg[i]['monthmoney']+"</td></tr>";
                        $('#stduentLIST tbody').append(studentlist);
                    }
                   }else{
                        alert('未知错误!');
                   }
                }
            })
        })

        $(".getmoneyinfo").click(function(){
          $("#adminmoneytable thead").html("");
          $("#adminmoneytable tbody").html("");
          userid=$(this).parent().parent().find('td').html();
        })

        $("#findmoneybytime").click(function(){
          var year=$('.year').val();
          var month=$('.month').val();
          $.ajax({
            type:"POST",
            url:"<?php echo U('Root/GetAdminMoneyWithTime');?>",
            data:"user_id="+userid+"&year="+year+"&month="+month,
            success:function(e){
              var a=eval(e);
              if(a[0]['money']!=null){

                $("#adminmoneytable thead").html("<tr><td>学生充值金额</td><td>分管学员总数</td><tr>");
                $("#adminmoneytable tbody").html("<tr><td>"+a[0]['money']+"</td><td>"+a[0]['student_number']+"</td><tr>")
              }else {
                $("#adminmoneytable thead").html("");
                $("#adminmoneytable tbody").html("没有数据");
              }
            }
          })
        });
    </script>
    <script type="text/javascript">
      // $(document).ready(function(){
        $("#editAdminInfo").hide();
        $(".editAdmin").click(function(){
          var adminID = $(this).parent().parent().find(".adminID").html();
          $.ajax({
            type: "POST",
            url: "<?php echo U('Info/UserManage',array('personType'=>'admin','type'=>'checkUpdate'));?>",
            data: {
              type: "admin",
              ID: adminID,
            },
            dataType: "json",
            success: function(data){
              $("#editAdminInfo").slideDown();
              $("#account").val(data.account);
              $("#chinesename").val(data.chinesename);
              $("#englishname").val(data.englishname);
              $("#email").val(data.email);
              $("#phone").val(data.phone);
              $("#qq").val(data.QQ);
              $("#wechat").val(data.weixin);
              $("#age").val(data.age);
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
    </script>
</body>

</html>