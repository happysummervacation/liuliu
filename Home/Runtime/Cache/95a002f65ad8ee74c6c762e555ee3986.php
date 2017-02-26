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
    <!-- 9.06 修改04 -->
    <!-- DataTables CSS -->
    <link href="__PUBLIC__/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="__PUBLIC__/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- //9.06 修改04 -->
    <!-- Timeline CSS -->
    <link href="__PUBLIC__/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="__PUBLIC__/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!-- <link href="__PUBLIC__/bower_components/morrisjs/morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="__PUBLIC__/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    	th,td{
    		text-align: center;
    		width: 50px;
    	}
    	table {

    	}
    </style>

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
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">设置教师工资</h1>
          </div>
        </div>
        <div class="row">
					<div class="col-lg-6 col-lg-offset-3">
							<div class="panel panel-primary">
								<div class="panel-heading">
									设置教师工资类别
								</div>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>课程类别</th>
											<th>教师类型</th>
											<th>是否任教</th>
											<th>单课时价格</th>
										</tr>
									</thead>
									<tbody id="teacherPayInfo">
									</tbody>
								</table>
								<div class="panel-footer" style="overflow: auto;">
									<button class="btn btn-primary" style="float: right" id="onsubmit">
										提交
									</button>
								</div>
							</div>
					</div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="__PUBLIC__/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="__PUBLIC__/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="__PUBLIC__/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="__PUBLIC__/bower_components/raphael/raphael-min.js"></script>
    <script src="__PUBLIC__/bower_components/morrisjs/morris.min.js"></script>
    <script src="__PUBLIC__/js/morris-data.js"></script> -->

    <!-- 9.06修改05 -->
    <!-- DataTables JavaScript -->
    <script src="__PUBLIC__/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="__PUBLIC__/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example1').DataTable({
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

        /**
         * 传过来的数据
         */
        var teacherpayinfo=[
            {classtype:'1|少儿',teachertype:'1|名师',money:'30',infomationid:'1001'},
            {classtype:'2|成人',teachertype:'0|普通',money:'60',infomationid:'1002'}
        ];

        /**
         * 配置表数据
         */
        var config=[
            {typename:'少儿类',id:'1'},
            {typename:'成人类',id:'2'},
            {typename:'雅思类',id:'3'}
        ]

        //教师ID
        var teacherid='22';

        //表格初始化
        $("#teacherPayInfo").html(" ");
        //数组转换成表格
        var temparrforteacher=[];
        var comparearr=[];
        for (var i = 0; i < teacherpayinfo.length; i++) {
            //填充教师已有信息
            var classinfo=teacherpayinfo[i]['classtype'].split('|');
            var teachertype = teacherpayinfo[i]['teachertype'].split('|');
            var tr_str='<tr><td style="height: 30px;line-height: 30px;" value="'+teacherpayinfo[i]['infomationid']+'_'+classinfo[0]+'"">'
                    +classinfo[1]+'类课程'+
                    '</td><td><select class="form-control teachertype"><option value="0">普通教师</option><option value="1">名师</option></select></td><td style="height: 30px;line-height: 30px;"><input type="checkbox" name="" checked="checked"></td><td><input type="number" name="" class="form-control" value="'+teacherpayinfo[i]['money']+'"></td></tr>';
            $('#teacherPayInfo').append(tr_str);
            $('.teachertype').eq(i).val(teachertype[0]);
            //提取类别ID
            temparrforteacher.push(classinfo[0]);
            //拼接
            comparearr.push(teacherpayinfo[i]['infomationid']+'_'+classinfo[0]+'_'+teachertype[0]+'_'+teacherpayinfo[i]['money']+'_1');
        }
        console.log(comparearr);
        //补充其余配置信息
        if(config.length>teacherpayinfo.length){
            for (var i = 0; i < config.length; i++) {
                if(temparrforteacher.indexOf(config[i]['id'])==-1){
                    var tr_str='<tr><td style="height: 30px;line-height: 30px;" value="'+config[i]['id']+'"">'
                                +config[i]['typename']+'课程'+
                                '</td><td><select class="form-control teachertype"><option value="0">普通教师</option><option value="1">名师</option></select></td><td style="height: 30px;line-height: 30px;"><input type="checkbox" name=""></td><td><input type="number" name="" class="form-control"></td></tr>';
                    $('#teacherPayInfo').append(tr_str);
                }
            }
        }


        $('#onsubmit').click(function(){
            var info=[];
            $('#teacherPayInfo').find('tr').each(function(){
                var v3=$(this).find('input[type=checkbox]').is(':checked');
                var v1=$(this).find('td').eq(0).attr('value');
                if(v3){
                    var v2=$(this).find('select').val();
                    var v4=$(this).find('input[type=number]').val();
                    info.push(v1+'_'+v2+'_'+v4+'_1');
                }else if(v1.length>=4){
                    var v2=$(this).find('select').val();
                    var v4=$(this).find('input[type=number]').val();
                    info.push(v1+'_'+v2+'_'+v4+'_0');
                }
            });
            //删除重复数据
            for (var i = 0; i < comparearr.length; i++) {
                if(info.indexOf(comparearr[i])!=-1){
                    info.splice(info.indexOf(comparearr[i]),1);
                }
            }
            // console.info(info);
            //post提交数据
            data=JSON.stringify(info);
            $.post("访问方法",{data:data,teacherid:teacherid},function(result){
                alert(result);
            });
        })
    </script>

</body>

</html>