<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<title>66Speak|教学体系</title>
<link rel="icon" href="/liuliu/AppPublic/assets/images/icon.png" sizes="512x512">
<meta name="description" content="">
<meta name="author" content="">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/animate.css">
<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/font-awesome.min.css">

<link href="/liuliu/AppPublic/assets/css/least.min.css" rel="stylesheet" />

<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/mixElement.css">

<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/skilBar.css">

<link rel="stylesheet" href="/liuliu/AppPublic/assets/js/dataTables/dataTables.bootstrap.css">

<!-- Main css -->
<link rel="stylesheet" href="/liuliu/AppPublic/assets/css/style.css">

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
				<li><a href="teachingSystem.html" class="smoothScroll"><span class="navActive">教学体系</span></a></li>
				<li><a href="teachers.html" class="smoothScroll">师资团队</a></li>
				<li><a href="childEng.html" class="smoothScroll">少儿英语</a></li>
				<li><a href="price.html" class="smoothScroll">收费标准</a></li>
				<li><a href="publicClass.html" class="smoothScroll">公开课</a></li>
				<li><a href="#" class="smoothScroll">登入/注册</a></li>
				<li><a href="#phone"><span class="fa fa-phone">0574-87170280</span></a></li> -->
				<li><a href="<?php echo U('Index/index');?>" class="smoothScroll">主页</a></li>
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
<!-- <section id="intro" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12">
				<h3 class="wow bounceIn" data-wow-delay="0.9s"></h3>
			</div>


		</div>
	</div>
</section> -->

<div class="flicker-example">
    <ul>
        <li data-background="/liuliu/AppPublic/assets/images/rbg4.jpg">
            <div class="flick-title">
                <!-- A friend in need is a friend indeed. -->
            </div>
            <!-- <div class="flick-sub-text">

            </div> -->
        </li>
		<li data-background="/liuliu/AppPublic/assets/images/rbg7.jpg">
			<div class="flick-title">
				<!-- A friend in need is a friend indeed. -->
			</div>
			<!-- <div class="flick-sub-text">

			</div> -->
		</li>
		<li data-background="/liuliu/AppPublic/assets/images/rbg2.jpg">
			<div class="flick-title">
				<!-- A friend in need is a friend indeed. -->
			</div>
			<!-- <div class="flick-sub-text">

			</div> -->
		</li>
    </ul>
</div>

<!-- =========================
    ClsClass
============================== -->

<section id="clsClass" class="parallax-section">
	<div class="container wow fadeInRight">
		<div class="classTitle">课程类别</div>
		<!-- <ul id="filters" class="clearfix">
			<li><span class="filter active" data-filter="child bis test job life other">全部系列</span></li>
			<li><span class="filter" data-filter="child">少儿英语</span></li>
			<li><span class="filter" data-filter="bis">商务英语</span></li>
			<li><span class="filter" data-filter="test">考试升学</span></li>
			<li><span class="filter" data-filter="job">职场面试</span></li>
			<li><span class="filter" data-filter="life">实用英语</span></li>
			<li><span class="filter" data-filter="other">其他</span></li>
		</ul> -->

		<div id="portfoliolist">
			<div class="portfolio child" data-cat="child">
				<div class="portfolio-wrapper">
					<img src="/liuliu/AppPublic/assets/images/clsClass/child/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<span class="text-title"></span>
							<span class="text-category">针对不同的少儿我们有不同的方案</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
				<div class="clsTitle">少儿英语</div>
			</div>

			<div class="portfolio test job" data-cat="test job">
				<div class="portfolio-wrapper">
					<img src="/liuliu/AppPublic/assets/images/clsClass/test/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<span class="text-title"></span>
							<span class="text-category">针对不同的群体我们有不同的方案</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
				<div class="clsTitle">托福口语</div>
			</div>

			<div class="portfolio test job" data-cat="test job">
				<div class="portfolio-wrapper">
					<img src="/liuliu/AppPublic/assets/images/clsClass/test/2.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<span class="text-title"></span>
							<span class="text-category">针对不同的群体我们有不同的方案</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
				<div class="clsTitle">雅思口语</div>
			</div>

			<div class="portfolio bis" data-cat="bis">
				<div class="portfolio-wrapper">
					<img src="/liuliu/AppPublic/assets/images/clsClass/bis/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<span class="text-title"></span>
							<span class="text-category">针对不同的群体我们有不同的方案</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
				<div class="clsTitle">商务英语</div>
			</div>

			<!-- <div class="portfolio life" data-cat="life">
				<div class="portfolio-wrapper">
					<img src="/liuliu/AppPublic/assets/images/clsClass/life/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<span class="text-title"></span>
							<span class="text-category">针对不同的群体我们有不同的方案</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
				<div class="clsTitle">实用口语</div>
			</div> -->

			<div class="portfolio job" data-cat="job">
				<div class="portfolio-wrapper">
					<img src="/liuliu/AppPublic/assets/images/clsClass/job/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<span class="text-title"></span>
							<span class="text-category">针对不同的群体我们有不同的方案</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
				<div class="clsTitle">面试英语</div>
			</div>

			<div class="portfolio job" data-cat="job">
				<div class="portfolio-wrapper">
					<img src="/liuliu/AppPublic/assets/images/clsClass/job/2.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<span class="text-title"></span>
							<span class="text-category">针对不同的群体我们有不同的方案</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
				<div class="clsTitle">行业英语</div>
			</div>

			<div class="portfolio life" data-cat="life">
				<div class="portfolio-wrapper">
					<img src="/liuliu/AppPublic/assets/images/clsClass/life/2.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<span class="text-title"></span>
							<span class="text-category">针对不同的群体我们有不同的方案</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
				<div class="clsTitle">旅游英语</div>
			</div>

			<div class="portfolio other" data-cat="other">
				<div class="portfolio-wrapper">
					<img src="/liuliu/AppPublic/assets/images/clsClass/other/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<span class="text-title"></span>
							<span class="text-category">针对不同的群体我们有不同的方案</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
				<div class="clsTitle">成人英语</div>
			</div>

		</div>

	</div>
</section>
<!-- =========================
    teaching
============================== -->

<section id="teachingSetup" class="parallax-section">
	<div class="container wow fadeInLeft" >
		<div class="classTitle">教学体系</div>
		<div class="skillbar clearfix " data-percent="15%">
			<div class="skillbar-title" style="background: #d35400;"><span>Lv0</span></div>
			<div class="skillbar-bar" style="background: #e67e22;"></div>
			<div class="skill-bar-percent">Primer</div>
		</div>
		<p>溜溜英语可为中国学生定制零基础级别教学。</p>

		<div class="skillbar clearfix " data-percent="25%">
			<div class="skillbar-title" style="background: #2980b9;"><span>Lv1 -> Lv3</span></div>
			<div class="skillbar-bar" style="background: #3498db;"></div>
			<div class="skill-bar-percent">Beginner</div>
		</div>
		<p>针对零基础学员，讲解基础语法结构及词汇，提高其语言能力。</p>

		<div class="skillbar clearfix " data-percent="50%">
			<div class="skillbar-title" style="background: #10151b;"><span>Lv4 -> Lv5</span></div>
			<div class="skillbar-bar" style="background: #2c3e50;"></div>
			<div class="skill-bar-percent">Elementary</div>
		</div>
		<p>针对初级英语水平学员，旨在进一步配演古法、词汇，提高其语言技能，使其达到初学偏高水平。</p>

		<div class="skillbar clearfix " data-percent="70%">
			<div class="skillbar-title" style="background: #124e8c;"><span>Lv7 -> Lv9</span></div>
			<div class="skillbar-bar" style="background: #4288d0;"></div>
			<div class="skill-bar-percent">Intermediate</div>
		</div>
		<p>针对初级偏高水平学员，旨在进一步培养语法、词汇，提高其语言技能，使学员达到中级水平。</p>

		<div class="skillbar clearfix " data-percent="80%">
			<div class="skillbar-title" style="background: #faff00;"><span>Lv10 -> Lv12</span></div>
			<div class="skillbar-bar" style="background: #ebfc5b;"></div>
			<div class="skill-bar-percent">Upper Intermediate</div>
		</div>
		<p>针对中级水平学员，培养其英语表达流利度及准确性，提高其交际能力，促使其达到中级偏高水平。</p>

		<div class="skillbar clearfix " data-percent="95%">
			<div class="skillbar-title" style="background: #27ae60;"><span>Lv13 -> Lv15</span></div>
			<div class="skillbar-bar" style="background: #2ecc71;"></div>
			<div class="skill-bar-percent">Advanced</div>
		</div>
		<p>针对中级偏高水平学员，巩固其英语表达的流利度及准确性，促进语言、交际两方面共同发展。</p>
		<div class="clsTitle">分级对照表</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Lv0</th>
							<th>Lv1 -> Lv3</th>
							<th>Lv4 -> Lv6</th>
							<th>Lv7 -> Lv9</th>
							<th>Lv10 -> Lv12</th>
							<th>Lv13 -> Lv15</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>CEFR欧洲共同语言参考标准</td>
							<td>#</td>
							<td>A1</td>
							<td>A2</td>
							<td>B1</td>
							<td>B2</td>
							<td>C1</td>
						</tr>
						<tr>
							<td>TOEFL</td>
							<td>#</td>
							<td>#</td>
							<td>0-56</td>
							<td>57-86</td>
							<td>87-109</td>
							<td>110-120</td>
						</tr>
						<tr>
							<td>LELTS</td>
							<td>#</td>
							<td>#</td>
							<td>3-4</td>
							<td>4-5</td>
							<td>5-6</td>
							<td>7-8</td>
						</tr>
						<tr>
							<td>TOELC</td>
							<td>#</td>
							<td>#</td>
							<td>350-550</td>
							<td>550-750</td>
							<td>750-880</td>
							<td>880-950</td>
						</tr>
					</tbody>
				</table>
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

<script type="text/javascript" src="/liuliu/AppPublic/assets/js/skilBar.js"></script>


</body>
</html>