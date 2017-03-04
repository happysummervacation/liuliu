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
    <link href="__PUBLIC__/bowaer_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

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
                                    <a href="<?php echo U('Teacher/MyMoney');?>"> Teacher Salary</a>
                                </li>
                                <li>
                                    <!-- <a href="HowCaculate.html">工资计算</a> -->
                                    <a href="<?php echo U('Teacher/HowCaculate');?>"> Salary Settlement</a>
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
                        <h1 class="page-header">Feedback History</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                  <div class="col-lg-12">
                    <form class="form" action="<?php echo U('Comment/TeacherCommentManage',array('type'=>'history'));?>" method="post">
                      <div class="col-lg-5 form-group">
                        <label for="">Year</label>
                        <select class="form-control" name="year">
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                            <option>2024</option>
                            <option>2025</option>
                            <option>2026</option>
                            <option>2027</option>
                            <option>2028</option>
                            <option>2029</option>
                            <option>2030</option>
                        </select>
                      </div>
                      <div class="col-lg-5 form-group">
                        <label for="">Month</label>
                        <select class="form-control" name="month">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <label for="" style="visibility:hidden;">Button</label>
                        <br>
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      Feedback
                    </div>
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills">
                            <li class="active"><a href="#dayV" data-toggle="tab">Daily Comment</a>
                            </li>
                            <li><a href="#weekV" data-toggle="tab">Weekly Comment</a>
                            </li>
                            <li><a href="#mouthV" data-toggle="tab">Monthly Comment</a>
                            </li>
                            <li><a href="#testV" data-toggle="tab">Audition Comment</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="dayV">
                                <h4>Daily Comment</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="display:none">OrderClassID</th>
                                            <th style="display:none">ClassID</th>
                                            <th style="display:none">ComemntID</th>
                                            <th>Students name</th>
                                            <th>Class time</th>
                                            <th>Add notes</th>
                                            <th>level</th>
                                            <th>Teacher Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(empty($dayCommentResult)): else: ?>
                                          <?php $i=1 ?>
                                          <?php if(is_array($dayCommentResult)): foreach($dayCommentResult as $key=>$vo): ?><tr>
                                              <td><?php echo ($i); ?></td>
                                              <?php $i++ ?>
                                              <td style="display:none"><?php echo ($vo["oneorderclassID"]); ?></td>
                                              <td style="display:none"><?php echo ($vo["classID"]); ?></td>
                                              <td style="display:none"><?php echo ($vo["oneteachercomID"]); ?></td>
                                              <td><?php echo ($vo["englishname"]); ?></td>
                                              <td><?php echo (date("Y-m-d",$vo["comStartTime"])); ?></td>
                                              <td><a href="#" data-toggle="modal" data-target=".bs-example-modal-sm1" class="getcolinfo">Click Upload</a></td>
                                              <td><?php echo ($vo["commentlevel"]); ?></td>
                                              <td><?php echo ($vo["commentcontent"]); ?></td>
                                            </tr><?php endforeach; endif; endif; ?>
                                    </tbody>
                                </table>
                              </div>
                              <div class="tab-pane fade" id="weekV">
                                    <h4>Weekly Comment</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="display:none">Comment number</th>
                                                <th style="display:none">Student number</th>
                                                <th>Student name</th>
                                                <th>Comment time</th>
                                                <!-- <th>Add notes</th> -->
                                                <th>level</th>
                                                <th>Teacher Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php if(empty($weekCommentResult)): else: ?>
                                            <?php if(is_array($weekCommentResult)): foreach($weekCommentResult as $key=>$vo): ?><tr>
                                                <td style="display:none"><?php echo ($vo["oneteachercomID"]); ?></td>
                                                <td style="display:none"><?php echo ($vo["studentID"]); ?></td>
                                                <td><?php echo ($vo["englishname"]); ?></td>
                                                <td><?php echo (date("Y-m-d",$vo["comEndTime"])); ?></td>
                                                <td><?php echo ($vo["commentlevel"]); ?></td>
                                                <td><?php echo ($vo["commentcontent"]); ?></td>
                                              </tr><?php endforeach; endif; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                              <div class="tab-pane fade" id="mouthV">
                                    <h4>Monthly Comment</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="display:none">Comment number</th>
                                                <th style="display:none">Student number</th>
                                                <th>Student name</th>
                                                <th>Comment time</th>
                                                <!-- <th>Add notes</th> -->
                                                <th>level</th>
                                                <th>Teacher Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php if(empty($monthCommentResult)): else: ?>
                                            <?php if(is_array($monthCommentResult)): foreach($monthCommentResult as $key=>$vo): ?><tr>
                                                <td style="display:none"><?php echo ($vo["oneteachercomID"]); ?></td>
                                                <td style="display:none"><?php echo ($vo["studentID"]); ?></td>
                                                <td><?php echo ($vo["englishname"]); ?></td>
                                                <td><?php echo (date("Y-m-d",$vo["comEndTime"])); ?></td>
                                                <td><?php echo ($vo["commentlevel"]); ?></td>
                                                <td><?php echo ($vo["commentcontent"]); ?></td>
                                              </tr><?php endforeach; endif; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                              <div class="tab-pane fade" id="testV">
                                    <h4>Audition Comment</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="display:none">comment_id number</th>
                                                <th style="display:none">Student number</th>
                                                <th>Student name</th>
                                                <th>Comment time</th>
                                                <th>level</th>
                                                <th>Teacher Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php if(empty($auditionCommentResult)): else: ?>
                                              <?php $i=0 ?>
                                            <?php if(is_array($auditionCommentResult)): foreach($auditionCommentResult as $key=>$vo): $i++ ?>
                                              <tr>
                                                <td>$i</td>
                                                <td style="display:none"><?php echo ($vo["comment_id"]); ?></td>
                                                <td style="display:none"><?php echo ($vo["ID"]); ?></td>
                                                <td><?php echo ($vo["englishname"]); ?></td>
                                                <td><?php echo (date("Y-m-d",$vo["comment_time"])); ?></td>
                                                <td><?php echo ($vo["comment_level"]); ?></td>
                                                <td><?php echo ($vo["comment_content"]); ?></td>
                                              </tr><?php endforeach; endif; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                  </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        <div class="modal fade bs-example-modal-sm1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                  Upload Class Note
              </div>
              <div class="modal-body">
                   <form enctype="multipart/form-data" class="form-horizontal" action="<?php echo U('Teacher/UploadTeacherNote');?>" method="post">
                      <div class="form-group">
                        <label  class="col-sm-4 control-label">Booking Number:</label>
                        <div class="col-sm-8">
                            <input type="text" class="fromtable13 form-control" name="orderclass_id" readonly="true">
                        </div>

                      </div>
                      <div class="form-group">
                        <label  class="col-sm-4 control-label">Course Number:</label>
                        <div class="col-sm-8">
                            <input type="text" class="fromtable2 form-control" readonly="true" name="class_id">
                        </div>
                      </div>
                      <div class="form-group">
                        <label  class="col-sm-4 control-label">Student Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="fromtable3 form-control" readonly="true">
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label  class="col-sm-4 control-label formtable5"></label>
                        <div class="col-sm-8">
                            <button class="uploadbutton btn btn-default" style="width:100%;">
                                <input name="file" type="file" nv-file-select="" uploader="uploader" multiple  />
                                Add File
                            </button>
                        </div>
                      </div> -->
                      <div class="form-group">
                        <label  class="col-sm-4 control-label">Content:</label>
                        <div class="col-sm-8">
                            <!-- <button class="uploadbutton btn btn-default" style="width:100%;">
                                <input name="file" type="file" nv-file-select="" uploader="uploader" multiple  />
                                Add File
                            </button> -->
                            <textarea name="file"></textarea>
                        </div>
                      </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
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

    <!-- Custom Theme JavaScript -->
    <script src="__PUBLIC__/dist/js/sb-admin-2.js"></script>

    <script src="__PUBLIC__/js/time.js"></script>

    <script type="text/javascript">
        upDateTime();
    </script>

    <script type="text/javascript">
        $('#getCommentID').click(function(){
            var comment_id = $("#getCommentID").parent().parent().children().eq(1).html();
            // alert(comment_id);
            $("#UploadCommentID").val(comment_id);
        })
    </script>

</body>

</html>