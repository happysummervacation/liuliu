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

		public function index(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if($identity == 0 || $identity == "0"){
				$this->display("Student:index");
			}elseif($identity == 1 || $identity == "1"){
				$this->display("Teacher:index");
			}elseif($identity == 2 || $identity == "2"){
				$this->display("Admin:index");
			}elseif($identity == 4 || $identity == "4"){
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
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
 				$ordpOp = new OrderPackageBasicOperate();
 				$packageInfo = $ordpOp->getStuActiveOrderPackageInfo($_SESSION['ID'],null);
 				$this->assign('package_list',$packageInfo);

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
