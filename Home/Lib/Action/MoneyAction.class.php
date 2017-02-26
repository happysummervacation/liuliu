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
		*用来设置教师的课程价格以及教师的类型
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
				$finallyOneClassResult = $this->dealOneClassInfo($moneyOneClassResult);
				
				$this->assign("config",json_encode($packageConOpResult));

				//这个渲染到页面后 ，在页面上要做循环？
				$this->assign("teacherpayinfo",json_encode($finallyOneClassResult));
				$this->display("Root:SetTeacherPay");
			}else{
				$this->error("你没有权限查看该页面");
			}
		}

		/*陈泽奇
		*处理老师一对一价格表的信息;
		*返回一个友好的array数组;
		*/

		////////////////////////需要做修改////////////////////////////////
		public function dealOneClassInfo($data = null)
		{
			$message = array();
			if(is_null($data)){
				return $message;
			}else{
	// dump($data);
				$result = array();
				for($i=0;$i<count($data);$i++){
					$result[$i]['classtype'] = $data[$i]['packageconID']."|".$data['0']['packageName'];
					if($data[$i]['teacherType'] == 0){
						$result[$i]['teachertype'] = $data[$i]['teacherType']."|普教";
					}elseif($data[$i]['teacherType'] == 1)
					{
						$result[$i]['teachertype'] = $data[$i]['teacherType']."|名师";
					}
//
					$result[$i]['money'] = $data[$i]['price'];
					$result[$i]['infomationid'] = $data[$i]['teOneClassSalaryID'];
// dump($result);
				}
				return $result;


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
		*对教师的工资以及教师可上课程类别的管理
		*/
		public function manageTeacherSalary(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(4 == $identity || "4" == $identity){

			}else{
				$this->error('你没有权限进行操作');
			}
		}
	}
 ?>
