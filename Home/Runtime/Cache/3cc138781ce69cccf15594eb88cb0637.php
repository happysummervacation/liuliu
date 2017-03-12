<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>溜溜英语用户登录</title>

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

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4" style="margin-top: 60px;font-family: 微软雅黑;">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">请登录</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo U('Login/DoLogin');?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="用户名" name="account" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密码" name="password" type="password" value="">
                                </div>
                                <!-- <div class="form-group">
                                    <input class="form-control" placeholder="验证码" name="Code" type="text" value="">
                                </div>
                                <div>
                                    <image src="<?php echo U('Code/CreateCode');?>" onclick="javascript:this.src='<?php echo U('Code/CreateCode');?>?id='+new Date().getMilliseconds()">
                                </div> -->
                                <div class="checkbox form-group" style="overflow: auto;">
                                    <!-- <label>
                                        &nbsp;<input name="remember" type="checkbox" value="Remember Me">记住用户名
                                    </label> -->
                                    <div class="pull-right">
                                    	<a href="#" data-toggle="modal" data-target="#exampleModal">忘记密码?</a>
                                        |
                                        <a href="/liuliu">回到主页</a>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">登录</button>
                            </fieldset>
                        </form>
                        <hr>
                        <div  style="text-align: center;font-size: 10px;">
                        	<h6>现在还没有账号?</h6>
                        	<a href="<?php echo U('Login/Register');?>">创建账号</a>
                        </div>

                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				  <div class="modal-dialog" role="document">
            <form action="<?php echo U('Login/resetPassword');?>" method="post">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="exampleModalLabel">忘记密码?</h4>
				      </div>
				      <div class="modal-body">
				        <!-- <form> -->
				          <div class="form-group">
				            <label for="recipient-name" class="control-label">输入你的邮箱地址来重置你的密码:</label>
				            <input type="text" class="form-control" placeholder="Email" name="email">
				          </div>
				        <!-- </form> -->
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				        <!-- <button type="button" class="btn btn-success" onclick="alert('抱歉,邮件服务器还在建设中.请联系管理员重置你的密码!!!')">发送</button> -->
                <button type="submit" class="btn btn-default" >发送</button>
				      </div>
				    </div>
          </form>
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

    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

</body>

</html>