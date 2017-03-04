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
                        <h1 class="page-header">Teaching Materials</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Teaching Material</div>
                        <div class="panel-body">
                        <!-- <?php foreach ($bookresult as $key => $value) {?>
                            <div class="col-lg-3">
                                <div class="panel panel-default" style="height: 250px;">
                                    <div class="panel-body">
                                        <div class="col-xs-6">
                                             <img src="../../resource/img/book1.jpg" style="width: 100%;">
                                            <img src="<?php echo ($value['book_image_path']); ?>" style="width: 100%;height:150px;">
                                        </div>
                                        <div class="col-xs-6">
                                            <p>教材名称:<br><?php echo ($value['book_name']); ?></p>
                                            <p>教材类型:<br><?php echo (pathinfo($value['download_link'])['extension'])?>文档</p>
                                            <p>教材页码:<br><?php echo ($value['page']); ?>page</p>
                                        </div>
                                        <div class="col-lg-12">
                                            <br>
                                            <a href="__PUBLIC__/generic/web/viewer.html?file=../../..<?php echo ($value['download_link']); ?>"><button class="btn btn-primary" style="width: 45%;">在线打开</button></a>
                                            <a href="<?php
 $suffix_parts = path_info($value['download_link']); $suffix = $suffix_parts['extension']; $filename = $suffix_parts['filename']; echo U('Teacher/DownLoadBook',array('suffix'=>$suffix,'downfilename'=>$value['book_name'],'filename'=>$filename));?>"><button class="btn btn-primary" style="width: 45%;">
                                            下载</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <!-- <?php }?>  -->
                        <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#shaoer" data-toggle="tab">Children Category</a>
                                </li>
                                <li><a href="#chengren" data-toggle="tab">Adult Category</a>
                                </li>
                                <li><a href="#yasi" data-toggle="tab">IELTS Category</a>
                                </li>
                                <li><a href="#yiduiduo" data-toggle="tab">Small Classes</a>
                                </li>
                            </ul>

                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="shaoer">
                                    <?php if(is_array($bookresult)): foreach($bookresult as $key=>$vo): ?><div class="col-lg-3" style="text-align:center;">
                                    <div class="panel panel-default" style="margin-top: 10px;width: 280px;">
                                        <div class="panel-heading simpleline">Teaching Material's Name:<?php echo ($vo["bookname"]); ?></div>
                                        <div class="panel-body">
                                            <img src="<?php echo ($vo["bookimagelink"]); ?>" style="width: 80%;height: 200px">
                                        </div>
                                        <div class="panel-footer">
                                            <a href="__PUBLIC__/generic/web/viewer.html?file=../../.<?php echo ($vo['download_link']); ?>"><button class="btn btn-danger" style="width: 45%">Open online</button></a>
                                            <?php $tem = path_info($vo['download_link']);$bookname = $tem['filename'];?>
                                            <a href="<?php echo U('Teacher/DownloadBook',array('name'=>$bookname));?>"><button  class="btn btn-primary " style="width: 45%">Download</button></a>
                                        </div>

                                    </div>
                                    </div><?php endforeach; endif; ?>
                                </div>
                                <div class="tab-pane fade" id="chengren">
                                    <?php if(is_array($list1)): foreach($list1 as $key=>$vo): ?><div class="col-lg-3" style="text-align:center;">
                                      <div class="panel panel-default" style="margin-top: 10px;width: 280px;">
                                          <div class="panel-heading simpleline">Teaching Material's Name:<?php echo ($vo["bookname"]); ?></div>
                                          <div class="panel-body">
                                              <img src="<?php echo ($vo["bookimagelink"]); ?>" style="width: 80%;height: 200px">
                                          </div>
                                          <div class="panel-footer">
                                              <a href="__PUBLIC__/generic/web/viewer.html?file=../../.<?php echo ($vo['download_link']); ?>"><button class="btn btn-danger" style="width: 45%">Open online</button></a>
                                              <?php $tem = path_info($vo['download_link']);$bookname = $tem['filename'];?>
                                              <a href="<?php echo U('Teacher/DownloadBook',array('name'=>$bookname));?>"><button  class="btn btn-primary " style="width: 45%">Download</button></a>
                                          </div>

                                      </div>
                                      </div><?php endforeach; endif; ?>
                                </div>
                                <div class="tab-pane fade" id="yasi">
                                    <?php if(is_array($list2)): foreach($list2 as $key=>$vo): ?><div class="col-lg-3" style="text-align:center;">
                                      <div class="panel panel-default" style="margin-top: 10px;width: 280px;">
                                          <div class="panel-heading simpleline">Teaching Material's Name:<?php echo ($vo["bookname"]); ?></div>
                                          <div class="panel-body">
                                              <img src="<?php echo ($vo["bookimagelink"]); ?>" style="width: 80%;height: 200px">
                                          </div>
                                          <div class="panel-footer">
                                              <a href="__PUBLIC__/generic/web/viewer.html?file=../../.<?php echo ($vo['download_link']); ?>"><button class="btn btn-danger" style="width: 45%">Open online</button></a>
                                              <?php $tem = path_info($vo['download_link']);$bookname = $tem['filename'];?>
                                              <a href="<?php echo U('Teacher/DownloadBook',array('name'=>$bookname));?>"><button  class="btn btn-primary " style="width: 45%">Download</button></a>
                                          </div>

                                      </div>
                                      </div><?php endforeach; endif; ?>
                                </div>
                                <div class="tab-pane fade" id="yiduiduo">
                                    <?php if(is_array($list3)): foreach($list3 as $key=>$vo): ?><div class="col-lg-3" style="text-align:center;">
                                      <div class="panel panel-default" style="margin-top: 10px;width: 280px;">
                                          <div class="panel-heading simpleline">Teaching Material's Name:<?php echo ($vo["bookname"]); ?></div>
                                          <div class="panel-body">
                                              <img src="<?php echo ($vo["bookimagelink"]); ?>" style="width: 80%;height: 200px">
                                          </div>
                                          <div class="panel-footer">
                                              <a href="__PUBLIC__/generic/web/viewer.html?file=../../.<?php echo ($vo['download_link']); ?>"><button class="btn btn-danger" style="width: 45%">Open online</button></a>
                                              <?php $tem = path_info($vo['download_link']);$bookname = $tem['filename'];?>
                                              <a href="<?php echo U('Teacher/DownloadBook',array('name'=>$bookname));?>"><button  class="btn btn-primary " style="width: 45%">Download</button></a>
                                          </div>

                                      </div>
                                      </div><?php endforeach; endif; ?>
                                </div>
                        </div>
                        </div>
                        <!-- <div class="panel-footer" >
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">上传教材</button>
                        </div> -->
                    </div>
                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Upload Materials</h4>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data" action="<?php echo U('Teacher/UploadBook');?>" method="post">
                                  <div class="form-group form-inline">
                                    <label for="recipient-name" class="control-label">Teaching Material's Name:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="book_name">
                                  </div>
                                  <!-- <div class="form-group form-inline">
                                    <label for="message-text" class="control-label">教材类型(必选):</label>
                                    <select class="form-control">
                                        <option>PDF</option>
                                        <option>PPT</option>
                                        <option>WORD</option>
                                        <option>TXT</option>
                                    </select>
                                  </div> -->
                                  <div class="form-group form-inline">
                                    <label for="recipient-name" class="control-label">Material's Current Page:</label>
                                    <input type="text" name="page" class="form-control" />
                                  </div>
                                  <div class="form-group form-inline">
                                    <label for="recipient-name" class="control-label">Teaching Material's Type:</label>
                                    <select class="form-control" name="book_type">
                                        <option>Business English</option>
                                        <option>Children 's English</option>
                                        <option>Practical spoken language</option>
                                        <option>TOEFL Speaking</option>
                                        <option>Interview English</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="message-text" class="control-label">Upload Materials(Must):</label>
                                    <!-- <button class="btn btn-default">点击添加文件</button> -->
                                    <input type="file" nv-file-select="" uploader="uploader" multiple   name="book" value="Click to Add File"/>
                                    <!-- <input name="book" type="file" class="btn btn-default" value="点击添加文件" /> -->
                                  </div>
                                  <div class="form-group">
                                    <label for="message-text" class="control-label">Upload Cover(Optional):</label>
                                    <!-- <button class="btn btn-default">点击添加文件</button> -->
                                    <input type="file" nv-file-select="" uploader="uploader" multiple   name="book_image" value="Click to Add File"/>
                                    <!-- <input name="book_image" type="file" class="btn btn-default" value="点击添加文件" /> -->
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>

                                </form>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary">提交</button>
                            </div> -->
                        </div>
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

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();
    </script>

</body>

</html>