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
                                <a href="<?php echo U('Teacher/Feedback');?>"><i class="fa fa-calendar fa-fw"></i> Course Feedback</a>
                            </li>
                            <li>
                               <a href="<?php echo U('Teacher/HistoryFeedback');?>"><i class="fa fa-calendar fa-fw"></i> Feedback History</a>
                           </li>
                        <li>
                            <a href="#"><i class="fa fa-film fa-fw"></i> Video Upload<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Teacher/UploadedVideos');?>"> Video History</a>
                                </li>
                                <li>
                                    <!-- <a href="__PUBLIC__/plug-in/examples/simple/index.html">现在上传</a> -->
                                    <a href="<?php echo U('Teacher/UploadNow');?>"> Upload Video</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Teacher/UploadIntroductionVideo');?>"> Upload Introduction Video</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> Teacher Information<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <!-- <a href="Information.html">个人信息修改</a> -->
                                    <a href="<?php echo U('Teacher/Information');?>"> Teacher Information</a>
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
                        <h1 class="page-header">Teacher need to Know</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-red">
                            <div class="panel-heading">66speak's+rules</div>
                            <div class="panel-body" style="font-size: 18px;font-family: 微软雅黑">
                                <ul>
                                    <li>
                                        <strong>Why should I follow these rules and instructions?  </strong>
                                        The instructions listed here are the lessons learned from events that we have previously faced and the experiences we have gathered. Letting you know these rules is our responsibility and deciding whether you should follow or not is your responsibility. Understanding these rules and why they exist is important to you in understanding and fulfilling your role in our company. Ignoring these rules may result in negative consequence for you and our company and may result in your replacement. We hope you will be willing to accept this responsibility.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>1.About the salary</strong> ,Normally our payment for the class is $5 (basic pay)per class (25 miniutes) + 10% bonus for one to one class. We enhance the basic pay ever year 10%.$10+10% bonus per class(45miniutes) for group class( four to six students) $15+10% bonus (Large group class ,more than 10 students). And our pay day is 5th every month.（Your payment is counted from 1st to 30th or 31st）.All the teachers need to provide  first class for free for their new students which can also draw them more students. Once the students book the class, they at least will follow the same teacher for about 24 classes. Just pay attention that if you want to get your bonus, you must appear at all the classes on time and receive no complain from the parents.
Besides, teachers’ feedback is very important which help 66speak to know the students well, check students’ learning process, communicate with the parents and facilitate 66speak consultant to maintain the students for the teachers. Hence, please submit your feedback on time which also involved in your bonus.
Anyway ,every month we allow you to have two times for emergency absence and it will not affect your bonus, and you need to inform us at least one day ahead of time.
Our management has decided to give bonus features for the tutors who are working for a long time with us and with very good relationship.
10%-20% rise in their payments for the tutors who perform well with our students annually , which will be monitored by our management team. 
                                        <b>Pay attention that </b>
                                        Normally , the maximum of absence and emergency is two times per month. If your absence are more than two times ,we will take 10% off from your total salary.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>2.About Emergency</strong> ,If you have an emergency and you can't give lessons, for the foreign teachers, please contact us at least one day (24 hours) ahead of time. Or you will be considered as absent. And you need to make up the class for the student and give a free class. If the student is absent without informing ahead of time (students can cancel the class 12 hours before class time in our system), he or she still need to pay for the class and you can still get your pay for this class.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>3.About network fault</strong> ,Students’ network problem:
If there are some students’ network problem, teachers can call students by wechat through phone. Besides we also provide teachers a skype account, teachers can use it to call Chinese phone numbers.
Teachers’ network problem
If there is some network or connection problem appearing during the class and with the help of both of us, the problems remain and the class can't continue, the will suspend the class and rearrange the time for the class. If the network fault just start before the class and causes the connection problem, it will be considered as absence as well. So , please check your internet and computer, if you find any problems ,please inform us immediately. If there is any problem with your laptop or computer ,use wechat as a substitute plan. You can teach the students via your phone or call the students via skype.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>4.About being late</strong>, If the teacher doesn't show up within 15 minutes after the class commence, he or she will be counted as absent. That teacher should make up the absent lesson and offer one free lesson for this student for compensation. The specific time will be arranged by the students’ adviser. (if the student complains about the teacher and ask for another one to give lessons, we have to deduct the free of 2 lessons from your salary.)If the teacher late for less than 15 minutes , the teacher need to make up the lost minute for the students.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>5.About teaching process</strong> ,Nowadays, we will fix one student to one teacher. So this is the teacher’s responsibility to remember all the students’ teaching materials and learning process. 
But please be notice that, students have freedom to choose other teachers’ class. They have right to require to transfer to another teacher.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>6. About the schedule</strong> ,Once our system is done, you can open your schedule every month ahead of time (4 to five weeks) , you can choose your available time by your own and our students will book your class based on their free time. However our system is still testing .
So nowadays, We will provide you your schedule a week a head of time. The normal day for us to send your schedule is every Sunday .Normally we will email you the schedule.Please check your email and skype /wechat account every Sunday evening. If you do not get your schedule for next week please contact us.
Please keep your wechat on .We will set up a wechat group for all the teachers including the teacher and all his or her students, doing some interaction with the students on wechat group is necessary and it is also important to keep the students. And we may need to get in touch with the teachers for some emergency issue through wechat.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>6. About the schedule</strong> ,Once our system is done, you can open your schedule every month ahead of time (4 to five weeks) , you can choose your available time by your own and our students will book your class based on their free time. However our system is still testing .
So nowadays, We will provide you your schedule a week a head of time. The normal day for us to send your schedule is every Sunday .Normally we will email you the schedule.Please check your email and skype /wechat account every Sunday evening. If you do not get your schedule for next week please contact us.
Please keep your wechat on .We will set up a wechat group for all the teachers including the teacher and all his or her students, doing some interaction with the students on wechat group is necessary and it is also important to keep the students. And we may need to get in touch with the teachers for some emergency issue through wechat.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>7.About resignation time</strong> ,If you want to resign from 66speak, please inform us at least 1 month in advanced. Please continue to have a class with students in one month after you inform us about your resignation. The student’s adviser can have enough time to adjust student’s curriculum and arrange other teachers for your students. Please keep your regular class time with students in one month after you tell us about your resignation from 66speak.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>8.Be polite and patient</strong> ,You must always be polite while talking to your students. If a student is misbehaving or performing poorly you may correct them firmly but you must be polite at all times. If you have a student that continues to be disruptive or problematic you should report this to us.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>9.Class materials</strong> ,Bring the required class materials for each class, unless otherwise directed. Generally, we provide all the material to you, We also give you the freedom to use your own materials in you class. However, if you have any confusion regarding that, you can ask our for help. If there is anything special that the student needs or there is a request from the customer, the will let you know.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>10.About teaching process</strong> ,Nowadays , we will fix one student to one teacher. So this is the teacher’s responsibility to remember all the students’ teaching materials and learning process. 
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>11.About the recorded video</strong> ,Please upload at least one recorded video class into your Baidu Yun account one month . It will help us to check your teaching quality and decide your salary and bonus. Normally , we will enhance the teachers’ pay every year.
                                    </li>
                                    <br><br>
                                    <li>
                                        <strong>12.About the teaching deposit</strong> ,About the teaching deposit.
                                    </li>
                                </ul>
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