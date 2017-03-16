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
                        <h1 class="page-header">小班课学生管理</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="panel panel-default"  style="border-radius: 0px;">
                        <div class="panel-heading">
                          小班学生管理                         
                        </div>
                        <div class="panel-body" style="overflow: auto;">
                            <div class="dataTable_wrapper" style="max-width: 100%;">
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example2" style="max-width: 100%;">
                                <thead>
                                  <tr>
                                    <th>学生ID</th>
                                    <th>学生名</th>
                                    <th>以上课时</th>
                                    <th>剩余课时</th>
                                    <th>操作</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php foreach($studentList as $key => $value){ ?>
                                  <tr>
                                    <td><?php echo ($value['studentID']); ?></td>
                                    <td><?php echo ($value['account']); ?></td>
                                    <td><?php echo ($value[haveclass]); ?></td>
                                    <td><?php echo ($value[classNumber]); ?></td>
                                    <td>
                                      <div class="btn-group btn-group-sm">
                                        <button class="btn btn-default" type="button">详细信息</button> 
                                      <!--   <button class="btn btn-default" type="button">换班</button>  -->
                                        <!-- <button class="btn btn-default" type="button">请假</button> -->
                                        <button class="btn btn-default removeclass" type="button" >退班</button>
                                      </div>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                        <div class="panel-footer clearfix">
                          <button class="btn btn-primary pull-right" id="addstudent"> 添加学生</button>
                        </div>
                      </div>
                    </div>
                </div>
        		<div class="row clearfix second-table" id="openclassbox" style="display:none">
      			  <div class="col-lg-12">
      		    	<div class="panel panel-default"  style="border-radius: 0px;">
      			       	<div class="panel-heading">
      	               添加学生                       
      	             </div>
      			     <table class="table" id="cleartime">
      						<thead>
      							<tr>
        							<th>学号ID</th>
        							<th>学生名</th>
                      <th>套餐名称</th>
                      <th>套餐剩余课时</th>
      							</tr>
      							</thead>
      							<tbody>
                    <?php foreach($addstudentList as $key => $value){ ?>
        							<tr>
        							  <td><?php echo ($value['ID']); ?></td>
        							  <td><?php echo ($value['account']); ?></td>
                        <td><select class="form-control package_list">
                          <?php foreach($value['packageList'] as $key => $package){ ?>
                          <option value="<?php echo ($package['orderpackageID']); ?>_<?php echo ($package['classNum']); ?>"><?php echo ($package['packageName']); ?></option> 
                    <?php } ?>
                      </select></td>
                      <td><?php echo ($addstudentList[$value['ID']]['packageList'][0]['classNum']); ?></td>
      							  <td><button class="btn btn-primary chooseclass" data-toggle="modal" data-target="#checkclass"> 添加课程</button></td>
      							</tr> 
                    <?php } ?>
      							</tbody>
      					</table>       
      		 		</div>
      		  </div>   
		</div>
    </div>        
            <!-- /.container-fluid -->
</div>
        <!-- /#page-wrapper -->
<div class="modal fade" id="checkclass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">给&nbsp;<span id="stu_acc"></span>&nbsp;选择课程(剩余课时&nbsp;<span id="res_cls"></span>&nbsp;节)<span id="packageID" style="display: none;"></span></h4>
          </div>
          <div class="modal-body">
            <table class="table">
              <thead>
                <tr>
                  <th>课程编号</th>
                  <th style="text-align: center;">选择时间</th>
                  <th>选择课程</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($orderclassList as $key => $value){ ?>
              	<tr>
                  <td><?php echo ($value['groupClassSchID']); ?></td>
					        <td><?php echo (date('Y-m-d H:i',$value['classStartTime'])); ?></td>
					        <td><input  type="checkbox" name="check"/></td>
              	</tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="send">确认提交</button>
          </div>
        </div>
      </div>
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

    <!-- 多选插件 -->
    <script type="text/javascript" src="__PUBLIC__/tool/lou-multi-select/js/jquery.multi-select.js"></script>


    <!-- 时间选择插件 -->
    <script src="__PUBLIC__/tool/flatpickr.min.js"></script>

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
      //初始化表格
      
     
      $('#addstudent').click(function(){
      $('#openclassbox').slideToggle();
    });
       
      $(document).ready(function() {
          $('#dataTables-example2').DataTable({
                  responsive: true
          });
      });

      function load(url){
        window.location.href=url;
      }
	
      $('.removeclass').click(function (){
        var re=confirm('退课将会取消此学生在这个小班剩余的所有课程！\n请确认您的操作！');
        var stu_id=$(this).parents('tr').find('td').eq(0).html();
        if(re){
          window.location.href="<?php echo U('GroupClass/RemoveClass');?>"+"/groupID/<?php echo ($groupID); ?>/studentID/"+stu_id;
        }else{
          return;
        }
      })
      
      
      //获取课程数据
      $('.chooseclass').click(function(){
      	var student_id = $(this).parents('tr').find('td').eq(0).html();
        var studen_res = $(this).parents('tr').find('td').eq(3).html();
        $('#stu_acc').html(student_id);
        $('#res_cls').html(studen_res);
        $('#packageID').html($(this).parents('tr').find('select').val().split("_")[0]);
        $('input[name="check"]').removeAttr('checked');
        if(studen_res<0){
          $('#send').attr('disabled','disabled');
        }else{
          $('#send').removeAttr('disabled');
        }
      });
      
      $('input[name="check"]').click(function(){
        var clasnum = parseInt($('#res_cls').html());
        if($(this).is(':checked')){
          clasnum--;
        }else{
          clasnum++;
        }
        $('#res_cls').html(clasnum);
        if(clasnum<0){
          $('#send').attr('disabled','disabled');
        }else{
          $('#send').removeAttr('disabled');
        }
      })
		  $('.package_list').change(function(){
        var tem=$(this).val();
        var te=tem.split('_');
        $(this).parents('tr').find('td').eq(3).html(te[1]);
      });
      $('#send').click(function(){
        $(this).attr('disabled','disabled');
      	var arrays=new Array();
      	var len=document.getElementsByName('check');
      	for(var i=0;i<len.length;i++){
      		if(len[i].checked){
      		var temp = $('#checkclass').find('tbody tr').eq(i).find('td').eq(0).html();
      		//add arr
      		arrays.push(temp);
      		}
      	}
      	data=JSON.stringify(arrays);
      	$.ajax({
      		url:"<?php echo U('GroupClass/ajaxOrderGroupClass');?>",
      		type:'post',
      		data:'classList='+data+"&student="+$('#stu_acc').html()+"&packageID="+$('#packageID').html()+"&groupID="+<?php echo ($groupID); ?>,
          async:true,
          success:function(msg){
            if(msg!=''){
              alert(msg);
            }else{
              alert('失败！');
            }
             location.reload();//flash
          },
          error:function(error){
            alert(error);
          }
      	});
      });
    </script>
  
</body>

</html>