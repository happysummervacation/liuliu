<?php
	class MoneyAction extends Action{
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

		/*
		*俞鹏泽
		*用来root设置教师的课程价格以及教师的类型
		*这里查看教师的工资只是显示教师一对一课程的工资以及教师类别
		*/
		public function showTeacherMoneySet(){
			$this->CheckSession();
			import("Home.Action.Package.PackageConfigBasicOperate");
			import("Home.Action.Money.MoneyBasicOperate");
			$moneyBasOp = new MoneyBasicOperate();
			$packageConOp = new PackageConfigBasicOperate();
			$identity = $_SESSION['identity'];
			if(4 == $identity || "4" == $identity){
				/*流程:
				1.获取课程的配置表中的信息(tp_packageconfig中的信息)
				2.获取教师的一对一课程的价格表中的信息
				3.将两者的信息进行处理
				*/
				//1.获取课程的配置表中的信息(tp_packageconfig中的信息)
				$packageConOpResult = $packageConOp->getPackageConfigInfo();
				//2.获取教师的一对一课程的价格表中的信息
				//传入老师id
				$moneyOneClassResult = $moneyBasOp->getTeOneClassSalary($_GET['ID']);
				//3.将两者的信息进行处理
				import("Home.Action.Money.MoneyFeatrueService");

				$finallyOneClassResult = MoneyFeatrueService::dealOneClassInfo($moneyOneClassResult);

				$this->assign("config",json_encode($packageConOpResult));
				//这个渲染到页面后 ，在页面上要做循环？
				$this->assign("teacherID",$_GET['ID']);
				$this->assign("teacherpayinfo",json_encode($finallyOneClassResult));
				$this->display("Root:SetTeacherPay");
			}else{
				$this->error("你没有权限查看该页面");
			}
		}

		/*
		*俞鹏泽
		*对教师的工资以及教师可上课程类别进行增加,删除,修改
		*/
		public function manageTeacherSalary(){
			$this->CheckSession();

			import("Home.Action.Money.MoneyFeatrueService");
			import("Home.Action.Money.MoneyBasicService");
			$monSerOp = new MoneyBasicService();

			$identity = $_SESSION['identity'];
			if(4 == $identity || "4" == $identity){
				/*流程;
				1.获取前台发过来的修改信息
				2.将获取到的信息转成数组,并将其分成2类
				3.数据数组长度等于5的是就的数据,数据数组长度等于4的是新增的数据
				*/
				$teacherID = $_POST['teacherid'];
				$salaryData = $_POST['data'];
				$dealData = MoneyFeatrueService::dealTeacherSalaryInfo($salaryData);
				$result = $monSerOp->dealTeacherSalarySetSer($teacherID,$dealData);
				if($result['status']){
					echo "修改成功";
				}else{
					echo "修改失败";
				}
			}else{
				$this->error('你没有权限进行操作');
			}
		}

		/*
		*俞鹏泽
		*用于处理root对学生充值的管理操作
		*/
		public function studentRecharge(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(4 == $identity || "4" == $identity){
				$id = $_POST['user_id'];
				$account = $_POST['account'];
				$money = $_POST['money'];

				import("Home.Action.Money.MoneyBasicOperate");
				$moneyOp = new MoneyBasicOperate();
				$message = array();
				$message = $moneyOp->updateStudentMoney($id,$account,$money);

				if(false == $message['status']){
					$this->error($message['message']);
				}else{
					$this->success($message['message']);
				}
			}else{
				$this->error("你没有权限查看该页面");
			}
		}
		/*
		*俞鹏泽
		*教师的工资管理
		*/
		public function teacherSalaryManage(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			$type = $_GET['type'];

			if(1 == $identity || "1" == $identity){
				if("howcacu" == $type){

					$this->display("Teacher:HowCaculate");
					return;
				}elseif("mymoney" == $type){
					$startTime = "";
					$endTime = "";
					$teacherID = $_SESSION['ID'];
					if(empty($_POST['year']) || empty($_POST['month'])){
						$year = date("Y",getTime());
						$month = date("m",getTime());
						$startTime = strtotime("{$year}-{$month}");
						$endTime = strtotime("{$year}-{$month} +1month");
					}else{
						$year = $_POST['year'];
						$month = $_POST['month'];
						$startTime = strtotime("{$year}-{$month}");
						$endTime = strtotime("{$year}-{$month} +1month");
					}
					import("Home.Action.Money.MoneyBasicService");
					$moneyBasOp = new MoneyBasicService();
					$result = $moneyBasOp->getTeaSalaryMainService($teacherID,$startTime,$endTime);
					$this->assign("classResult",$result[0]);
					$this->assign("commentResult",$result[2]);
					$this->display("Teacher:MyMoney");
					return;
				}else{
					$this->error("没有对应的操作类型");
					return;
				}
			}elseif(4 == $identity || "4" == $identity){
				$startTime = "";
				$endTime = "";
				$teacherID = $_GET['user_id'];
				if(empty($_POST['year']) || empty($_POST['month'])){
					$year = date("Y",getTime());
					$month = date("m",getTime());
					$startTime = strtotime("{$year}-{$month}");
					$endTime = strtotime("{$year}-{$month} +1month");
				}else{
					$year = $_POST['year'];
					$month = $_POST['month'];
					$startTime = strtotime("{$year}-{$month}");
					$endTime = strtotime("{$year}-{$month} +1month");
				}
				import("Home.Action.Money.MoneyBasicService");
				$moneyBasOp = new MoneyBasicService();
				$result = $moneyBasOp->getTeaSalaryMainService($teacherID,$startTime,$endTime);
				$this->assign("classResult",$result[0]);
				$this->assign("commentResult",$result[2]);
				$this->assign("teacherID",$teacherID);
				$this->display("Root:TeaMoney");
				return;
			}else{
				$this->error("你没有权限进行查看");
				return;
			}
		}
	}
 ?>
