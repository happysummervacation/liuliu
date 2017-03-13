<?php
	class UserCenterAction extends Action{
		public function __construct(){
            //获取系统设置
            // $field = array();
            // array_push($field, "studentcancelrate");
            // import("Home.Action.System.SystemOperate");
            // $result = SystemOperate::GetSystemSet($field);
            // $this->CancelClassRate = $result['studentcancelrate'];
        }

		//空操作访问
        public function _empty(){
            echo "访问路径出错";
        }

		//不仅要查看登录的用户名，还要查看登录者的身份
	    public function CheckSession(){
			if(isset($_SESSION['account']) && $_SESSION['account']!='' && !is_null($_SESSION['identity'])){
				;
			}else{
				$this->error('请先登录',U('Login/Login'));
				return;
			}
		}

		// public function index(){
		// 	$this->CheckSession();
		//
		// 	$identity = $_SESSION['identity'];
		// 	if($identity == 0 || $identity == "0"){
		// 		$this->display("Student:index");
		// 	}elseif($identity == 1 || $identity == "1"){
		// 		$this->display("Teacher:index");
		// 	}elseif($identity == 2 || $identity == "2"){
		// 		$this->display("Admin:index");
		// 	}elseif($identity == 4 || $identity == "4"){
		// 		$this->display("Root:index");
		// 	}else{
		// 		$this->error("不存在该用户的页面");
		// 		return;
		// 	}
		// }

		public function index(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			import("Home.Action.User.UserBasicOperate");
			$userOp = new UserBasicOperate();
			if($identity == 0 || $identity == "0"){
				$studentID = $_SESSION['ID'];
				//查询学生的信息
				$info = $userOp->getUserInfo('student',$studentID,null,null,null,array('chinesename','account','image_path'));
				$this->assign("studentinfo",$info);
				//查询中外教剩余课时/总课时
				import("Home.Action.OrderClass.OrderClassCountService");
				$ocCS = new OrderClassCountService();
				//中教
				$CorderClassNum = $ocCS->countStudentOrderClassNum($studentID,0);
				$ChaveClassNum = $ocCS->countStudentHaveClassNum($studentID,0);
				//外教
				$EorderClassNum = $ocCS->countStudentOrderClassNum($studentID,1);
				$EhaveClassNum = $ocCS->countStudentHaveClassNum($studentID,1);

				$classNum['o_c_h_ClassNumber']=$ChaveClassNum[0]['num'];
				$classNum['o_c_a_ClassNumber']=$CorderClassNum[0]['num'];
				$classNum['o_f_h_ClassNumber']=$EhaveClassNum[0]['num'];
				$classNum['o_f_a_ClassNumber']=$EorderClassNum[0]['num'];
				$this->assign('classnumber',$classNum);
				$this->display("Student:index");
			}elseif($identity == 1 || $identity == "1"){


				$teacherID = $_SESSION['ID'];
				$info = $userOp->getUserInfo('teacher',$teacherID,null,null,null,array('englishname'));
				$this->assign('teacher_info_result',$info[0]);
				//Achieved Class
				// import("Home.Action.OrderClass.OrderClassCountService");
				// $ocCS = new OrderClassCountService();
				// $classNum = $ocCS->($teacherID);
				// $this->assign('classed_info_result',$classNum);

				//获取评论
				import("Home.Action.Comment.CommentBasicOperate");
				$comBO = new CommentBasicOperate();
				$studentcomment = $comBO->getStudentComment($teacherID);
				$this->assign('to_teacher_comment_result',$studentcomment);

				//获取教师上传的video数目
				import("Home.Action.Video.VideoBasicCountService");
				$videoCS = new VideoBasicCountService();
				$videoNum = $videoCS->getVideoNum($teacherID);
				$this->assign('video_result',$videoNum);
				$this->display("Teacher:index");
			}elseif($identity == 2 || $identity == "2"){
				$this->display("Admin:index");
			}elseif($identity == 4 || $identity == "4"){
				import("Home.Action.Money.TeaSalaryService");
				import("Home.Action.Money.MoneyBasicService");
				import("Home.Action.GlobalValue.GlobalValue");
				$op = new TeaSalaryService();
				$salaryOp = new MoneyBasicService();
				// $result = $op->getTeacherOneClassSalarySet(18,null,null,1488297600,1490976000);
				$saResult = $salaryOp->getTeaOneClassSalaryInfo(19,GlobalValue::haveClass.":".GlobalValue::notClass,1488297600,1490976000);
				exit;






				import("Home.Action.User.UserFeatrueOperate");
				$userFO = new UserFeatrueOperate();
				$admin1Num = $userFO->getpeopleNum('tp_admin',1);
				$admin0Num = $userFO->getpeopleNum('tp_admin',0);
				$student1Num = $userFO->getpeopleNum('tp_student',1);
				$student0Num = $userFO->getpeopleNum('tp_student',0);
				$teacher1Num = $userFO->getpeopleNum('tp_teacher',1);
				$teacher0Num = $userFO->getpeopleNum('tp_teacher',0);
				addWebsiteTime($this);

				$this->assign("admin1Num",$admin1Num);
				$this->assign("admin0Num",$admin0Num);
				$this->assign("student1Num",$student1Num);
				$this->assign("student0Num",$student0Num);
				$this->assign("teacher1Num",$teacher1Num);
				$this->assign("teacher0Num",$teacher0Num);
				$this->display("Root:index");
			}else{
				$this->error("不存在该用户的页面");
				return;
			}
		}

		/*
		*俞鹏泽
		*显示Rule页面
		*/
		public function showRule(){
			$this->CheckSession();
			$identity=$_SESSION['identity'];
			if(0==$identity||'0'==$identity){

			}elseif(1==$identity||'1'==$identity){
				$this->display("Teacher:TeacherInstruction");
			}elseif(2==$identity||'2'==$identity){
				$this->display("Admin:Notice");
			}else{
				$this->error("你没有权限查看该页面");
			}
		}

		/*
		*俞鹏泽
		*显示接入学生页面,只对课程顾问开放
		*/
		public function accessStudent(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];

			if(2 == $identity||'2' == $identity){
				$result=null;
				import("Home.Action.User.UserFeatrueOperate");
				$userFOp=new UserFeatrueOperate();
				$result=$userFOp->getStudentInfoWithoutStudentManage();
				$this->assign('student_list',$result);
				$this->display("Admin:FeedBack");
			}else{
				$this->error("你没有权限查看该页面");
			}
		}
		/*
		*俞鹏泽
		*显示课程顾问的考验页面
		*/
		public function showAdminExam(){
			$this->CheckSession();
			$identity = $_SESSION['identity'];
			if("2" == $identity || 2 == $identity){
				$this->display("Admin:MyExamination");
			}else{
				$this->error("你没有权限进行查看");
			}
		}

		/*
		*俞鹏泽
		*接入学生的操作
		*/
		public function accessStudentManage(){
			$this->CheckSession();
			$identity = $_SESSION['identity'];
			if(2 == $identity||'2' == $identity){
				import("Home.Action.User.UserBasicOperate");
				$userOp=new UserBasicOperate();
				$id=$_GET['id'];
				$data=array();
				$data['student_manage_id']=$_SESSION['ID'];
				$result = $userOp->updateUserInfo($id,null,$data);
				$this->success("接入成功！",U('UserCenter/accessStudent'));

			}else{
				$this->error("你没有权限查看该页面");
			}
		}

		/*
		*俞鹏泽
		*显示套餐管理的各种信息信息,专用于学生角色
		*/
		 public function getManageInfo(){
			 $this->CheckSession();
  			$identity = $_SESSION['identity'];
 			if(0 == $identity||'0' == $identity){
 			// 	import("Home.Action.OrderPackage.OrderPackageBasicOperate");
 			// 	$ordpOp = new OrderPackageBasicOperate();
 			// 	$packageInfo = $ordpOp->getStuActiveOrderPackageInfo($_SESSION['ID'],null);
 			// 	$this->assign('package_list',$packageInfo);
				//
 			// 	import("Home.Action.User.UserBasicOperate");
 			// 	$userOp = new UserBasicOperate();
 			// 	$field = array('student_sum_money');
 			// 	$moneyInfo = $userOp->getUserInfo('student',$_SESSION['ID'],null,null,null,'student_sum_money');
 			// 	$this->assign('money',$moneyInfo[0]['student_sum_money']);
				//
				// //获取课时消费历史  消费历史  送课历史
 			// 	$studentID = $_SESSION['ID'];
 			// 	//上课历史
 			// 	import("Home.Action.OrderClass.OrderClassBasicService");
 			// 	$ocBS = new OrderClassBasicService();
 			// 	$myclass = $ocBS->getMyFinishedClass($studentID);
 			// 	//消费历史
 			// 	import("Home.Action.Money.MoneyBasicService");
 			// 	$moneyBS = new MoneyBasicService();
 			// 	$trade = $moneyBS->getStudentopaccount($studentID);
				// //送课历史
 			// 	import("Home.Action.SendClass.SendClassBasicService");
 			// 	$scBS = new SendClassBasicService();
 			// 	$sendinfo = $scBS->getsendClassInfo($studentID);
				//
 			// 	$this->assign('sendclass_result',$sendinfo);
 			// 	$this->assign('trade_list',$trade);
 			// 	$this->assign('student_consume_result',$myclass);
				//
 			// 	$this->display("Student:MyPackage");
			// import("Home.Action.OrderPackage.OrderPackageBasicOperate");
 		// 		$ordpOp = new OrderPackageBasicOperate();
 		// 		$packageInfo = $ordpOp->getStuActiveOrderPackageInfo($_SESSION['ID'],null);
 		// 		$this->assign('package_list',$packageInfo);
			//
 		// 		import("Home.Action.User.UserBasicOperate");
 		// 		$userOp = new UserBasicOperate();
 		// 		$field = array('student_sum_money');
 		// 		$moneyInfo = $userOp->getUserInfo('student',$_SESSION['ID'],null,null,null,'student_sum_money');
			//
 		// 		//蒋周杰
 		// 		//获取课时消费历史  消费历史  送课历史
 		// 		$studentID = $_SESSION['ID'];
 		// 		//上课历史
 		// 		import("Home.Action.OrderClass.OrderClassBasicService");
 		// 		$ocBS = new OrderClassBasicService();
 		// 		$myclass = $ocBS->getMyFinishedClass($studentID);
 		// 		//消费历史
 		// 		import("Home.Action.Money.MoneyBasicService");
 		// 		$moneyBS = new MoneyBasicService();
 		// 		$trade = $moneyBS->getStudentopaccount($studentID);
			// 	//送课历史
 		// 		import("Home.Action.SendClass.SendClassBasicService");
 		// 		$scBS = new SendClassBasicService();
 		// 		$sendinfo = $scBS->getsendClassInfo($studentID);
			//
			// 	//得到剩余课时数
 		// 		import("Home.Action.OrderPackage.OrderPackageCountService");
 		// 		$opCS = new OrderPackageCountService();
 		// 		$classNum = $opCS->getPackageClassNum($studentID);
 		// 		$this->assign('classCount',$classNum);
			//
 		// 		//得到剩余套餐数
 		// 		$packageNum = $opCS->getPackageNum($studentID);
 		// 		$this->assign('packageCount',$packageNum);
			//
 		// 		$this->assign('sendclass_result',$sendinfo);
 		// 		$this->assign('trade_list',$trade);
 		// 		$this->assign('student_consume_result',$myclass);
 		// 		$this->assign('money',$moneyInfo[0]['student_sum_money']);
 		// 		$this->display("Student:MyPackage");
				import("Home.Action.OrderPackage.OrderPackageBasicOperate");
 				$ordpOp = new OrderPackageBasicOperate();
 				$packageInfo = $ordpOp->getStuActiveOrderPackageInfo($_SESSION['ID'],null);

 				import("Home.Action.User.UserBasicOperate");
 				$userOp = new UserBasicOperate();
 				$field = array('student_sum_money');
 				$moneyInfo = $userOp->getUserInfo('student',$_SESSION['ID'],null,null,null,'student_sum_money');

 				//蒋周杰
 				//获取课时消费历史  消费历史  送课历史
 				$studentID = $_SESSION['ID'];
 				//上课历史
 				import("Home.Action.OrderClass.OrderClassBasicService");
 				$ocBS = new OrderClassBasicService();
 				$myclass = $ocBS->getMyFinishedClass($studentID);
 				//消费历史
 				import("Home.Action.Money.MoneyBasicService");
 				$moneyBS = new MoneyBasicService();
 				$trade = $moneyBS->getStudentopaccount($studentID);
				//送课历史
 				import("Home.Action.SendClass.SendClassBasicService");
 				$scBS = new SendClassBasicService();
 				$sendinfo = $scBS->getsendClassInfo($studentID);

				//得到剩余课时数
 				import("Home.Action.OrderPackage.OrderPackageCountService");
 				$opCS = new OrderPackageCountService();
 				$classNum = $opCS->getPackageClassNum($studentID);


 				import("Home.Action.OrderClass.OrderClassCountService");
 				$ocCS = new OrderClassCountService();
 				//得到套餐已用课时
 				foreach ($packageInfo as $key => $value) {
 					$packageInfo[$key]['haveClass'] = $ocCS->getPackageHaveClass($studentID,$value['orderpackageID']);
 				}
 				//得到剩余套餐数
 				$packageNum = $opCS->getPackageNum($studentID);

 				$this->assign('classCount',$classNum);
 				$this->assign('package_list',$packageInfo);
 				$this->assign('packageCount',$packageNum);
 				$this->assign('sendclass_result',$sendinfo);
 				$this->assign('trade_list',$trade);
 				$this->assign('student_consume_result',$myclass);
 				$this->assign('money',$moneyInfo[0]['student_sum_money']);
 				$this->display("Student:MyPackage");
 			}else{
 				$this->error("你没有权限查看该页面");
 			}
		 }
	}
 ?>
