<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Center</title>

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
            <div class="topmen">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/liuliu/index.php" ><strong>66Speak Home Page</strong></a>
            </div>
            <!-- /.navbar-header -->
            <!-- 显示北京时间 -->
           <div style="text-align: center;position:fixed;right: 45%;" class="hidden-xs">
                <h3 align="center">Beijing Time&nbsp;&nbsp;&nbsp;<span class="time"><?php echo date('Y/m/d H:i:s',$nowtime);?></span></h3>
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
                        <!-- <?php dump($unreadmessage) ?> -->
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php if(is_array($unreadmessage)): foreach($unreadmessage as $key=>$value): if(($value['isdelete']) == "0"): ?><li>
                                <a href="<?php echo U('Teacher/InformationCenter');?>">
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
                            <a class="text-center" href="<?php echo U('Teacher/InformationCenter');?>">
                                <strong>All Messages</strong>
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
                        <li><a href="<?php echo U('Login/doLogout');?>"><i class="fa fa-sign-out fa-fw"></i> Quit</a>
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
                        </li>
                        <li>
                          <a href="<?php echo U('Teacher/index');?>"><i class="fa fa-home fa-fw"></i> Teacher Center</a>
                        </li>
                            <li>
                                <a href="<?php echo U('Class/getTeacherClassPlan');?>"><i class="fa fa-calendar fa-fw"></i> Current Month's Schedule</a>
                            </li>
                             <li>
                                <a href="<?php echo U('Comment/TeacherCommentManage',array('type'=>'now'));?>"><i class="fa fa-calendar fa-fw"></i> Course Feedback</a>
                            </li>
                            <li>
                                <!--HistoryFeedback-->
                               <a href="<?php echo U('Comment/TeacherCommentManage',array('type'=>'history'));?>"><i class="fa fa-calendar fa-fw"></i> Feedback History</a>
                           </li>
                        <li>
                            <a href="#"><i class="fa fa-film fa-fw"></i> Video Upload<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Video/showVideoInfo');?>?type=history"> Video History</a>
                                </li>
                                <li>
                                    <!-- <a href="__PUBLIC__/plug-in/examples/simple/index.html">现在上传</a> -->
                                    <a href="<?php echo U('Video/showVideoInfo');?>?type=updateVideo"> Upload Video</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Video/showVideoInfo');?>?type=updateIntroduction"> Upload Introduction Video</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> Teacher Information<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <!-- <a href="Information.html">个人信息修改</a> -->
                                    <a href="<?php echo U('Info/Information');?>"> Teacher Information</a>
                                </li>
                                <li>
                                    <!-- <a href="Information.html">个人信息修改</a> -->
                                    <a href="<?php echo U('Teacher/QualificationsInformation');?>"> Qualification Information</a>
                                </li>
                                <li>
                                    <!-- <a href="ResetPassword.html">密码修改</a> -->
                                    <a href="<?php echo U('Info/resetPassword');?>"> Password Reset</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-credit-card fa-fw"></i> Teacher Salary<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <!-- <a href="MyMoney.html">我的工资</a> -->
                                    <a href="<?php echo U('Money/teacherSalaryManage',array('type'=>'mymoney'));?>"> Teacher Salary</a>
                                </li>
                                <li>
                                    <!-- <a href="HowCaculate.html">工资计算</a> -->
                                    <a href="<?php echo U('Money/teacherSalaryManage',array('type'=>'howcacu'));?>"> Salary Settlement</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo U('Book/showBookInfo');?>"><i class="fa fa-book fa-fw"></i> Teaching Material</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Teacher/MyContract');?>"><i class="fa fa-gavel fa-fw"></i> Teacher Contracts</a>
                        </li>
                        <li>
                            <a href="<?php echo U('UserCenter/showRule');?>"><i class="fa fa-exclamation-triangle fa-fw"></i> Teacher need to know</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Info/contractAdmin');?>"><i class="fa fa-exclamation-triangle fa-fw"></i> Admin Information</a>
                        </li>
                        <!-- <li>
                          <span ><?php echo date('Y/m/d H:i:s',$nowtime);?></span>
                        </li> -->
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
                        <h1 class="page-header">Teacher's Information</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Information Modification</div>
                            <div class="panel-body">
                                <form enctype="multipart/form-data" action="<?php echo U('Info/ChangeUserInformation');?>" method="post">
                                    <div class="col-lg-8">
                                        <div class="col-lg-6">
                                            <h4>Nickname：</h4>
                                            <input type="text" class="form-control" value="<?php echo ($data['account']); ?>"  disabled="disabled"/>
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>Chinese Name：</h4>
                                            <input type="text" name="chinesename" class="form-control" value="<?php echo ($data['chinesename']); ?>"  />
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>English Name：</h4>
                                            <input type="text" name="englishname" class="form-control" value="<?php echo ($data['englishname']); ?>"  />
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>Age：</h4>
                                            <input type="text" name="age" class="form-control" value="<?php echo ($data['age']); ?>"   maxlength="3"/>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>Gender：</h4>
                                            <select class="form-control" name="sex">
                                                <?php
 if($data['sex'] == 0){ echo '<option selected="selected" value="0">Female</option>'; }else{ echo '<option selected="selected" value="1">Male</option>'; } ?>

                                                <?php
 if($data['sex'] == 1){ echo '<option value="0">Female</option >'; }else{ echo '<option value="1">Male</option >'; } ?>

                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>Email：</h4>
                                            <input type="text" name="email" class="form-control" value="<?php echo ($data['email']); ?>"   />
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>Phone Number：</h4>
                                            <input type="text" name="phone" class="form-control" value="<?php echo ($data['phone']); ?>"  />
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>QQ：</h4>
                                            <input type="text" name="qq" class="form-control" value="<?php echo ($data['QQ']); ?>"  >
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>Wechat：</h4>
                                            <input type="text" name="weixin" class="form-control" value="<?php echo ($data['weixin']); ?>"  >
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>ZOOM：</h4>
                                            <input type="text" name="zoom" class="form-control" value="<?php echo ($data['zoom']); ?>"  >
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>Skype：</h4>
                                            <input type="text" name="skype" class="form-control" value="<?php echo ($data['skype']); ?>" >
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>Bank Card：</h4>
                                            <input type="text" name="bankcard" class="form-control" value="<?php echo ($data['bankcard']); ?>"  >
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>Paypal：</h4>
                                            <input type="text" name="paypal" class="form-control" value="<?php echo ($data['paypal']); ?>" >
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>Area：</h4>
                                            <input class="form-control" name="country" type="text" value="<?php echo ($data['country']); ?>" maxlength="300"/>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>Introduction：</h4>
                                            <input type="text" name="introduction" class="form-control" value="<?php echo ($data['introduction']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4" style="text-align: center">
                                        <br>
                                        <div id="result">
                                        <img src="<?php echo ($data['image_path']); ?>" style="width:130px;border: 2px solid #CCC;height: 130px;"  alt="No Head Picture!" id="image"/>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="uploadbutton btn btn-default" style="width:50%;" >
                                            <input type="file" nv-file-select="" uploader="uploader" multiple   name="photo" value="Upload Head Picture" id="file_input"/>
                                            Update
                                        </div>
                                        <br/>
                                        no more 2M
                                        <!-- <input type="file" name="photo" value="上传头像" class="btn btn-default"> -->
                                    </div>
                                    <div class="col-lg-12">
                                        <br>
                                    </div>
                            </div>
                            <div class="panel-footer" style="overflow: auto">
                                <button type="submit" class="btn btn-primary" style="float: right;width: 10%;">Save</button>
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

    <!-- jQuery -->
    <script src="__PUBLIC__/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="__PUBLIC__/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="__PUBLIC__/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

    <script type="text/javascript" src="__PUBLIC__/js/Countries.js"></script>


    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();

        $('.age').change(function(){
            if ($(this).val()<0||$(this).val()>150) {
                alert("Age doesn't meet the requirements!");
                $(this).val('');
            }
        })

        var result = document.getElementById("result");
        var input = document.getElementById("file_input");

        if(typeof FileReader==='undefined'){
            result.innerHTML = "Sorry，Your browser does not support FileReader";
            input.setAttribute('disabled','disabled');
        }else{
            input.addEventListener('change',readFile,false);
        }

        function readFile(){
            var file = this.files[0];
            if(!/image\/\w+/.test(file.type)){
                alert("The file must be a picture");
                return false;
            }
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e){
                $('#result img').attr('src',this.result);
            }
        }
    </script>
</body>

</html>