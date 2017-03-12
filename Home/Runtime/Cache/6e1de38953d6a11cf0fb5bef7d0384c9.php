<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

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
                        <h1 class="page-header">学员信息</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-primary">
                            <div class="panel-heading">学员信息</div>
                            <div class="panel-body">
                                <form enctype="multipart/form-data" action="<?php echo U('Info/ChangeUserInformation');?>" method="post">
                                    <div class="col-lg-8">
                                        <div class="col-lg-6">
                                            <h4>学员昵称：</h4>
                                            <input type="text" class="form-control" name="account" value="<?php echo ($data['account']); ?>" disabled="disabled">
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>中文姓名：</h4>
                                            <input type="text" class="form-control" name="chinesename" value="<?php echo ($data['chinesename']); ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>英语姓名：</h4>
                                            <input type="text" class="form-control" name="englishname" value="<?php echo ($data['englishname']); ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>年龄：</h4>
                                            <input type="text" class="form-control age" name="age" value="<?php echo ($data['age']); ?>" maxlength="3">
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>性别：</h4>
                                            <select class="form-control" name="sex">
                                                <?php
 if($data['sex'] == 0){ echo '<option selected="selected" value="0">女</option>'; }else{ echo '<option selected="selected" value="1">男</option>'; } ?>
                                                <?php
 if($data['sex'] == 0){ echo '<option value="1">男</option>'; }else{ echo '<option value="0">女</option>'; } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>邮箱：</h4>
                                            <input type="text" class="form-control" name="email" value="<?php echo ($data['email']); ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>联系号码：</h4>
                                            <input type="text" class="form-control" name="phone" value="<?php echo ($data['phone']); ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>QQ：</h4>
                                            <input type="text" class="form-control" name="qq" value="<?php echo ($data['QQ']); ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>微信：</h4>
                                            <input type="text" class="form-control" name="weixin" value="<?php echo ($data['weixin']); ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>skype：</h4>
                                            <input type="text" class="form-control" name="skype" value="<?php echo ($data['skype']); ?>">
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>地址：</h4>
                                            <input type="text" class="form-control" name="country" value="<?php echo ($data['country']); ?>">
                                        </div>

                                        <div class="col-lg-12">
                                            <h4>教材：</h4>
                                            <?php if(empty($book)){echo "还没有教材";}else{ ?>
                                              <?php if(is_array($book)): foreach($book as $key=>$vo): if($vo != "" && $vo != ";;"){ $bookname = "";$bookname = explode(";",$vo['material'])[1] ?>
                                                  <input type="text" class="form-control" readonly="true" value="<?php echo ($bookname); ?>">
                                                <?php } endforeach; endif; ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" style="text-align: center">
                                        <br>
                                        <!--这里的图片的路径要改-->
                                        <div id="result">
                                        <img id="touxxx" src="<?php if($data['image_path'] == null){echo '';} else {echo $data['image_path'];}?>"  style="width:130px;border: 2px solid #CCC;height: 130px;"  alt="没有头像!">
                                        </div>
                                        <br>
                                        <br>
                                        <div class="uploadbutton btn btn-default" style="width:50%;">
                                            <input type="file" nv-file-select="" uploader="uploader" multiple   name="photo" value="上传头像" id="file_input"/>
                                            上传头像
                                        </div>
                                        <br/>
                                        图片大小不要超过2M
                                        <!-- <input class="btn btn-default" value="上传头像" type="file" name="photo"/> -->
                                    </div>
                                    <div class="col-lg-12">
                                        <br>

                                    </div>

                            </div>
                            <div class="panel-footer" style="overflow: auto">
                                <button class="btn btn-primary" type="submit" style="float: right;width: 10%;">保存</button>
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
                alert("请检查您的年龄填写是否正确");
                $(this).val('');
            }
        })

        var result = document.getElementById("result");
        var input = document.getElementById("file_input");

        if(typeof FileReader==='undefined'){
            result.innerHTML = "抱歉，你的浏览器不支持 FileReader";
            input.setAttribute('disabled','disabled');
        }else{
            input.addEventListener('change',readFile,false);
        }

        function readFile(){
            var file = this.files[0];
            if(!/image\/\w+/.test(file.type)){
                alert("文件图片类型文件");
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