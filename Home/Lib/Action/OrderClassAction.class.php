<?php
	class OrderClassAction extends Action{
		private $systemSet = null;
		public function __construct(){
            //获取系统设置
            $field = array();
            import("Home.Action.System.SystemBasicOperate");
			$sysOp = new SystemBasicOperate();
            $result = $sysOp->getSystemSet();
			$this->systemSet = $result;
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
		*显示订购课程的页面
		*/
		public function showOrderClassInfo(){
			$this->CheckSession();
			//////////////////////////////////
			/*流程:
			1.获取所有老师的信息(tp_teacher,tp_)
			2.显示到页面上
			*/
			/////////////////////////////////
			$identity = $_SESSION['identity'];

			import("Home.Action.User.UserBasicOperate");
			$userOp = new UserBasicOperate();
			$result = array();
			$result = $userOp->getUserInfo('teacher');

			if(0 == $identity || "0" == $identity){       //获取教师的必要数据进行展示
				/*要判断条件:
				1.学生是否有一对一的套餐
				2.学生是否停过课
				3.学生的一对一套餐是否已经指定了教材
				*/
				import("Home.Action.");
				$this->assign('teacher_result',$result);
				$this->display("Student:BookCourse");
			}elseif(2 == $identity || "2" == $identity){

			}elseif(4 == $identity || "4" == $identity){

			}else{
				$this->error("你没有权限查看该页面的内容");
				return;
			}
		}

		/*
		*俞鹏泽
		*获取学生的订购的还没有上的课程
		*/
		public function getStudentOrderClassTimeTable(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(0 == $identity || "0" == $identity){
				$type = $_GET['type'];
				if("one" == $type){
					//获取一对一的课程
					$this->display("Student:MySchedule");
				}elseif("group" == $type){
					//获取小班课的课程
					$this->display("Student:GroupClassSchedule");
				}else{
					$this->error("没有指定操作");
				}
			}elseif(2 == $identity || "2" == $identity){

			}elseif(4 == $identity || "4" == $identity){

			}else{
				$this->error("你没有权限查看学生的课表");
				return;
			}
		}

		/*
		*俞鹏泽
		*订购一对一课程(包括课程顾问,学生,root)
		*/
		public function studentOneOrderClass(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if("0" == $identity || 0 == $identity){
				//进行学生订课数据的处理
				// exit;
				$data = $_POST['id_data'];
				$studentID = $_SESSION['ID'];
				import("Home.Action.OrderClass.OrderClassBasicService");
				$orderclassOp = new OrderClassBasicService();
				$result = $orderclassOp->OrderOneToOneClass($studentID,$data);
				if($result['status']){
					echo "课程订购成功";
					return;
				}else{
					echo "课程订购失败";
					return;
				}
			}elseif("2" == $identity || 2 == $identity){

			}elseif("4" == $identity || 4 == $identity){

			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}
	}
 ?>
