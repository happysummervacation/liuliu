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
                            <a href="<?php echo U('Info/showCreateUser');?>/personType/teacher"> <i class="fa fa-mortar-board fa-fw"></i> 查看教师</a>
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
                            <a href="<?php echo U('Root/CheckStudent');?>"> <i class="fa fa-users fa-fw"></i> 查看学生</a>
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
                            <a href="<?php echo U('Root/CheckAdmin');?>"> <i class="fa fa-umbrella fa-fw"></i> 查看顾问</a>
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
                                    <a href="<?php echo U('Root/TimeSet');?>"> 参数设置</a>
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
                                    <a href="<?php echo U('Root/MaterialManage');?>"> 教材管理</a>
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
                        <h1 class="page-header">套餐管理</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            套餐列表
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>套餐编号</th>
                                            <th>套餐名称</th>
                                            <th>套餐价格</th>
                                            <th>课程类型</th>
                                            <th>教师类型</th>
                                            <th>教师国籍</th>
                                            <th>套餐类型</th>
                                            <th>学生类型</th>
                                            <th>学生人数</th>
                                            <th>课时数量</th>
                                            <th>创建时间</th>
                                            <th>生效时期</th>
                                            <th>系统操作</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr>
                                            <!-- 示例 -->
                                            <td>1001</td>
                                            <td>清明大礼包</td>
                                            <td>7874</td>
                                            <td value='0'>少儿</td>
                                            <td value='1'>名师</td>
                                            <td value='0'>中教</td>
                                            <td value='0'>课时类</td>
                                            <td value='0'>一对一</td>
                                            <td >1</td>
                                            <td>17</td>
                                            <td>2017-2-19 8:00:00</td>
                                            <td>30</td>
                                            <td>
                                                <button class="btn btn-default modifypackage" data-toggle="modal" data-target="#packagemodify">修改</button>
                                                <button class="btn btn-danger">删除</button>
                                            </td>
                                            <span style="display: none" name='description'>这里是套餐描述</span>
                                            <!-- 示例 -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer" style="overflow: auto;">
                            <div class="pull-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#packageopen">开放套餐</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

            <!-- 模态框,套餐修改 -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="packagemodify">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            套餐信息
                        </div>
                        <div class="modal-body" style="overflow: auto;">
                            <form class="form-horizontal" method="post" action="<?php echo U('Package/packageManage');?>/type/update" onsubmit="javascript:return confirm('您确认要提交表单吗？');">
                                <div class="form-group">
                                <label  class="col-sm-4 control-label">套餐名称</label>
                                <div class="col-sm-6">
                                  <input type="text" name="packageName" class="form-control">
                                </div>
                                </div>
                                <div class="form-group">
                                  <label  class="col-sm-4 control-label">套餐价格</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="packagPrice" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label  class="col-sm-4 control-label">课程类型</label>
                                  <div class="col-sm-6">
                                    <select class="form-control" name="classType">
                                        <option value="1">成人类</option>
                                        <option value="0">少儿</option>
                                        <option value="2">雅思类</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">教师类型</label>
                                  <div class="col-sm-6">
                                    <select  class="form-control" name="teacherType">
                                        <option value="0">普通</option>
                                        <option value="1">名师</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">教师国籍</label>
                                  <div class="col-sm-6">
                                    <select  class="form-control" name="teacherNation">
                                        <option value="0">中教</option>
                                        <option value="1">外交</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">套餐类型</label>
                                  <div class="col-sm-6">
                                    <select  class="form-control" name="packageType">
                                        <option value="0">课时套餐</option>
                                        <option value="1">卡类套餐</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">学生类型</label>
                                  <div class="col-sm-6">
                                    <select  class="form-control" name="studentType">
                                        <option value="0">一对一课程</option>
                                        <option value="1">小班课程</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">学生人数</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="studentNumber" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">课时数量</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="classNumber" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">生效天数</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="dayNumber" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">套餐描述</label>
                                  <div class="col-sm-6">
                                    <textarea name='description' class="form-control"></textarea>
                                  </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary" >提交</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 模态框 -->
            <!-- 模态框,套餐开放 -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="packageopen">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            套餐信息
                        </div>
                        <div class="modal-body" style="overflow: auto;">
                            <form class="form-horizontal" method="post" action="<?php echo U('Package/packageManage');?>/type/add" onsubmit="javascript:return confirm('您确认要提交表单吗？');">
                                <div class="form-group">
                                <label  class="col-sm-4 control-label">套餐名称</label>
                                <div class="col-sm-6">
                                  <input type="text" name="packageName" class="form-control">
                                </div>
                                </div>
                                <div class="form-group">
                                  <label  class="col-sm-4 control-label">套餐价格</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="packagPrice" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label  class="col-sm-4 control-label">课程类型</label>
                                  <div class="col-sm-6">
                                    <select class="form-control" name="classType">
                                        <option value="1">成人类</option>
                                        <option value="0">少儿</option>
                                        <option value="2">雅思类</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">教师类型</label>
                                  <div class="col-sm-6">
                                    <select  class="form-control" name="teacherType">
                                        <option value="0">普通</option>
                                        <option value="1">名师</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">教师国籍</label>
                                  <div class="col-sm-6">
                                    <select  class="form-control" name="teacherNation">
                                        <option value="0">中教</option>
                                        <option value="1">外交</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">套餐类型</label>
                                  <div class="col-sm-6">
                                    <select  class="form-control" name="packageType">
                                        <option value="0">课时套餐</option>
                                        <option value="1">卡类套餐</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">学生类型</label>
                                  <div class="col-sm-6">
                                    <select  class="form-control" name="studentType">
                                        <option value="0">一对一课程</option>
                                        <option value="1">小班课程</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group studentNumberlist">
                                  <label class="col-sm-4 control-label">学生人数</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="studentNumber" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">课时数量</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="classNumber" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">生效天数</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="dayNumber" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">套餐描述</label>
                                  <div class="col-sm-6">
                                    <textarea name='description' class="form-control"></textarea>
                                  </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary" >提交</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 模态框 -->
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

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();

        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive: true
            });

            fillform();
        });
        // alert($('.modifypackage').parents('tr').children().eq(3).attr('value'));
        function fillform(){
            $('input[name=packageName]').eq(0).val($('.modifypackage').parents('tr').children().eq(1).html());
            $('input[name=packagPrice]').eq(0).val($('.modifypackage').parents('tr').children().eq(2).html());
            $('select[name=classType]').eq(0).val($('.modifypackage').parents('tr').children().eq(3).attr('value'));
            $('select[name=teacherType]').eq(0).val($('.modifypackage').parents('tr').children().eq(4).attr('value'));
            $('select[name=teacherNation]').eq(0).val($('.modifypackage').parents('tr').children().eq(5).attr('value'));


            $('select[name=packageType]').eq(0).val($('.modifypackage').parents('tr').children().eq(6).attr('value'));
            $('select[name=studentType]').eq(0).val($('.modifypackage').parents('tr').children().eq(7).attr('value'));
            $('input[name=studentNumber]').eq(0).val($('.modifypackage').parents('tr').children().eq(8).html());
            $('input[name=classNumber]').eq(0).val($('.modifypackage').parents('tr').children().eq(9).html());
            $('input[name=dayNumber]').eq(0).val($('.modifypackage').parents('tr').children().eq(11).html());
            $('textarea[name=description]').eq(0).html($('span[name=description]').html());

            if($('select[name=studentType]').eq(0).val()==0){
                $('input[name=studentNumber]').eq(0).attr('readonly','readonly');
            }else{
                $('input[name=studentNumber]').eq(0).removeAttr('readonly');
            }
            changereadonly(1);
        }

        function changereadonly(number){
            if($('select[name=studentType]').eq(number).val()==0){
                $('input[name=studentNumber]').eq(number).val('1');
                $('input[name=studentNumber]').eq(number).attr('readonly','readonly');
            }else{
                $('input[name=studentNumber]').eq(number).val(' ');
                $('input[name=studentNumber]').eq(number).removeAttr('readonly');
            }
        }

        $('select[name=studentType]').eq(1).change(function(){
            changereadonly(1);
        });
        $('select[name=studentType]').eq(0).change(function(){
            changereadonly(0);
        });
    </script>
</body>

</html>