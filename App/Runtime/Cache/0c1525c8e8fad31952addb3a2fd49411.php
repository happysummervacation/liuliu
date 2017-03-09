<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<title>66Speak</title>
<link rel="icon" href="/liuliu/AppPublic/assets/images/icon.png" sizes="512x512">
<meta name="description" content="">
<meta name="author" content="">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/animate.css">
<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/font-awesome.min.css">
<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/owl.theme.css">
<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/owl.carousel.css">

<link rel="stylesheet" href="/liuliu/AppPublic/assets/js/dataTables/dataTables.bootstrap.css">

<link href="/liuliu/AppPublic/assets/css/least.min.css" rel="stylesheet" />

<link rel="stylesheet" href="/liuliu/AppPublic/assets/js/dataTables/dataTables.bootstrap.css">

<!-- Main css -->
<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/style.css">

<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/styleSec.css">

</head>
<body data-spy="scroll" data-offset="50" data-target=".navbar-collapse">

<!-- =========================
     PRE LOADER
============================== -->
<div class="preloader">
	<div class="sk-rotating-plane"></div>
</div>
<!-- =========================
     NAVIGATION LINKS
============================== -->
<div class="navbar navbar-fixed-top custom-navbar" role="navigation">
	<div class="container">

		<!-- navbar header -->
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand"><img src="/liuliu/AppPublic/assets/images/66logo.png" width="40" height="40" alt="" style="display:inline;">66Speak</a>
		</div>

		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<!-- <li><a href="index.html" class="smoothScroll">主页</a></li>
				<li><a href="aboutUs.html" class="smoothScroll">关于我们</a></li>
				<li><a href="teachingSystem.html" class="smoothScroll">教学体系</a></li>
				<li><a href="teachers.html" class="smoothScroll">师资团队</a></li>
				<li><a href="childEng.html" class="smoothScroll">少儿英语</a></li>
				<li><a href="price.html" class="smoothScroll">收费标准</a></li>
				<li><a href="publicClass.html" class="smoothScroll"><span class="">公开课</span></a></li>
				<li><a href="#" class="smoothScroll">登入/注册</a></li>
				<li><a href="#phone"><span class="fa fa-phone">0574-87170280</span></a></li> -->
				<li><a href="<?php echo U('Index/index');?>" class="smoothScroll">主页</a></li>
				<!-- <li><a href="<?php echo U('Index/aboutUs');?>" class="smoothScroll">关于我们</a></li> -->
				<li><a href="<?php echo U('Index/teachingSystem');?>" class="smoothScroll">教学体系</a></li>
				<li><a href="<?php echo U('Index/teachers');?>" class="smoothScroll">师资团队</a></li>
				<!-- <li><a href="<?php echo U('Index/childEng');?>" class="smoothScroll">少儿英语</a></li> -->
				<li><a href="<?php echo U('Index/price');?>" class="smoothScroll">收费标准</a></li>
				<!-- <li><a href="<?php echo U('Index/publicClass');?>" class="smoothScroll"><span class="">公开课</span></a></li> -->
				<li><a href="<?php echo U('Index/aboutUs');?>" class="smoothScroll">关于我们</a></li>
				<li><a href="/liuliu/app.php/Login/Login" class="smoothScroll">登入/注册</a></li>
				<li><a href="#phone"><span class="fa fa-phone">0574-87170280</span></a></li>
			</ul>
		</div>
	</div>
</div>

<!-- =========================
    INTRO SECTION
============================== -->
<div class="" id="topEmpty">

</div>
<section class="parallax-section">
	<div class="container wow fadeInLeft">

		<div class="col-md-4" id="teacherPic">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo ($teacherInfo['englishname']); ?></h3>
				</div>
				<!-- <img src="/liuliu/AppPublic/assets/images/teacherInfo/Julie/1.png" alt=""> -->
				<img src="<?php echo ($teacherInfo['image_path']); ?>" alt="">
			</div>
			<a href="teachers.html"></a>
		</div>

		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Information</h3>
				</div>
				<div class="panel panel-default" style="margin-bottom: 0px;">
					<!-- <div class="panel-heading">

					</div> -->
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<!-- <thead>
								<tr>

								</tr>
							</thead> -->
							<tbody>
								<tr>
									<td>Name:</td>
									<td><?php echo ($teacherInfo['englishname']); ?></td>
									<td>Age:</td>
									<td><?php echo ($teacherInfo['age']); ?></td>
								</tr>

								<!-- <tr>
									<td>college:</td>
									<td>Unknow</td> -->
									<!-- <td>Local phone number:</td> -->
									<!-- <td>+66 97 175 6448</td> -->
								<!-- </tr> -->

								<!-- <tr> -->
									<!-- <td>Permanent zoom number:</td> -->
									<!-- <td>306 989 5950</td> -->
									<!-- <td>Paypal account:</td> -->
									<!-- <td>Unknow</td> -->
								<!-- </tr> -->

								<!-- <tr> -->
									<!-- <td>Email:</td> -->
									<!-- <td>julieannevosloo@gmail.com</td> -->
									<!-- <td></td> -->
									<!-- <td></td> -->
								<!-- </tr> -->

								<tr>
									<td colspan="4">个人简介:</td>
								</tr>
								<tr>
									<td colspan="4">
									   <!-- Julie是来自英国的教师，拥有25年教龄，持TEFL教师资格证书，曾经在英国、南非、泰国等多所顶尖小学和幼儿园任教，
									      并曾担任幼儿园院长。Julie老师教学经验丰富，亲切自然，非常有耐心，且擅长教授少儿英语、成人实用英语。 -->
									      <?php echo ($teacherInfo['introduction']); ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="">
				<div class="panel panel-primary" style="margin-bottom: 0px;">
					<div class="panel-heading">
						<h3 class="panel-title">Sample Class</h3>
					</div>
				</div>
				<!-- <video src="/liuliu/AppPublic/assets/images/teacherInfo/Julie/sc.mp4" controls="controls" width="100%"></video> -->
				<video src="<?php echo ($teacherInfo['simplevideo']); ?>" controls="controls" width="100%"></video>
			</div>

			<div class="">
				<div class="panel panel-primary" style="margin-top: 20px; margin-bottom: 0px;">
					<div class="panel-heading">
						<h3 class="panel-title">Introduction【Coming Soon!Waiting for me~】</h3>
					</div>
				</div>
					<!-- <video src="/liuliu/AppPublic/assets/images/teacherInfo/Craig/.mp4" controls="controls" width="100%"></video> -->
					<video src="<?php echo ($teacherInfo['video_path']); ?>" controls="controls" width="100%"></video>
				</div>
			</div>

		</div>

	</div>
</section>

<!-- =========================
    FOOTER SECTION
============================== -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<p class="wow fadeInUp" data-wow-delay="0.6s">Copyright 66speak &copy; All rights reserved. Powered By NBUTIS.
				</p>
				<ul class="social-icon">
					<li><a href="#" class="fa fa-qq wow fadeInUp" data-wow-delay="1s"></a></li>
					<li><a href="#" class="fa fa-weixin wow fadeInUp" data-wow-delay="1.3s"></a></li>
					<li><a href="#" class="fa fa-weibo wow fadeInUp" data-wow-delay="1.6s"></a></li>
					<li><a href="#" class="fa fa-facebook wow fadeInUp" data-wow-delay="1.9s"></a></li>
					<li><a href="#" class="fa fa-twitter wow fadeInUp" data-wow-delay="2s"></a></li>
				</ul>

			</div>
		</div>
	</div>
</footer>


<!-- Back top -->
<a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>
<div href="" class="coder"><img src="/liuliu/AppPublic/assets/images/code.png"  width="50" height="50" onclick="imgShow($(this))"/></div>
<div id="outerdiv" style="position:fixed;top:0;left:0;background:rgba(0,0,0,0.7);z-index:999;width:100%;height:100%;display:none;">
	<div id="innerdiv" style="position:absolute;">
		<h5 style="text-algin:center;color:#fff;margin-right: 50px;">扫一扫 实时关注课程动态</h5>
		<img id="bigimg" style="border:5px solid #fff;" src="" />
	</div>
</div>


<!-- =========================
     SCRIPTS
============================== -->
<script src="/liuliu/AppPublic/assets/js/jquery.js"></script>
<script src="/liuliu/AppPublic/assets/js/bootstrap.min.js"></script>
<script src="/liuliu/AppPublic/assets/js/jquery.parallax.js"></script>
<script src="/liuliu/AppPublic/assets/js/owl.carousel.min.js"></script>
<script src="/liuliu/AppPublic/assets/js/smoothscroll.js"></script>
<script src="/liuliu/AppPublic/assets/js/wow.min.js"></script>
<script src="/liuliu/AppPublic/assets/js/custom.js"></script>

<!--Required libraries-->
<script src="/liuliu/AppPublic/assets/js/min/modernizr-custom-v2.7.1.min.js" type="text/javascript"></script>
<script src="/liuliu/AppPublic/assets/js/min/hammer-v2.0.3.min.js" type="text/javascript"></script>

<!--Include flickerplate-->
<link href="/liuliu/AppPublic/assets/css/flickerplate.css"  type="text/css" rel="stylesheet">
<script src="/liuliu/AppPublic/assets/js/min/flickerplate.min.js" type="text/javascript"></script>

<!--Execute flickerplate-->
<script src="/liuliu/AppPublic/assets/js/imgScrollInit.js"></script>

<script src="/liuliu/AppPublic/assets/js/imgCinCout.js"></script>

<!-- least.js library -->
<script src="/liuliu/AppPublic/assets/js/least.min.js"></script>

<!-- filterList -->
<script type="text/javascript" src="/liuliu/AppPublic/assets/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="/liuliu/AppPublic/assets/js/jquery.mixitup.min.js"></script>

<script type="text/javascript" src="/liuliu/AppPublic/assets/js/leastInit.js"></script>

<script type="text/javascript" src="/liuliu/AppPublic/assets/js/filterListInit.js"></script>

</body>
</html>