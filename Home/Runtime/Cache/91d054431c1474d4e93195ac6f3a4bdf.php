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
    <style type="text/css">
        #payboard{

        }
        #payboard ul li{
            list-style: none;
            font-size: 20px;
            line-height: 45px;
            height: 45px;
        }
    </style>
</head>

<body style="font-family: 微软雅黑;">

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
                <a class="navbar-brand" href="index.html" ><strong>溜溜英语</strong></a>
            </div>
            <!-- /.navbar-header -->
            <!-- 消息中心 -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- 中英文切换 -->
                <li class="dropdown">
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
                </li>
                <!-- 用户 -->
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
                        <li><a href="<?php echo U('Login/DoLogout');?>"><i class="fa fa-sign-out fa-fw"></i> 注销</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>

        <div class="row">
          	<div class="col-lg-4 col-lg-offset-4">
               <div class="panel panel-default" style="margin-top: 80px;">
                   <div class="panel-body" id="payboard">
                   <form method="post" action="<?php echo U('Package/pakcageOrderDeal');?>">
                       <ul>
                           <!-- <li><input type="radio" name="pay_method" id="netbank" value="netbank"/>&nbsp;<label for="netbank">网银支付</label></li> -->
                           <li><input type="radio" name="pay_method" id="zhifupay" value="alipay" />&nbsp;<label for="zhifupay">支付宝</label></li>
                           <li><input type="radio" name="pay_method" id="yuepay" value="balance" />&nbsp;<label for="yuepay">余额支付</label></li>
                           <input type="hidden" value="<?php echo ($package_id); ?>" name="package_id" />
                       </ul>
                   </div>
                   <div class="panel-footer" style="overflow: auto;">
                       <button class="btn btn-primary" type="submit">
                           	立即支付
                       </button>
                       <button class="btn btn-danger pull-right" type="reset" onclick="history.back()">
                          	 取消
                       </button>
                   </div>
                   </form>
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
        <!-- Custom Theme JavaScript -->
        <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

       <script type="text/javascript">
           $(".suredel").click(function () {
               confirm('您确定要删除吗?');
               //确认返回true
           });
       </script>
</body>
</html>