<?php
	class ClassAction extends Action{
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
		*获取教师的课程计划
		*/
		public function getTeacherClassPlan(){
			$this->CheckSession();

			import("Home.Action.User.UserBasicOperate");
			import("Home.Action.Class.ClassBasicService");
			import("Home.Action.GlobalValue.GlobalValue");
			$teacherID = null;

			$year = (int)$_POST['year'];
			$month = (int)$_POST['month'];
			//提供公用的数据
			if(empty($year) || empty($month)){
				if(empty($_GET['year']) || empty($_GET['month'])){
					$year = date('Y',getTime());
					$month = date('m',getTime());
				}else{
					$year = (int)$_GET['year'];
					$month = (int)$_GET['month'];
				}
			}
			$this->assign('this_month',$month);
            $this->assign('this_year',$year);
			$this->assign("nowtimePlan",strtotime("{$year}-{$month}"));

			$userBasOp = new UserBasicOperate();
			$claBasOp = new ClassBasicService();
			$field = array();
			array_push($field,"teacher_type");

			$identity = $_SESSION['identity'];
			if(1 == $identity || "1" == $identity || 2 == $identity || "2" == $identity ||
			4 == $identity || "4" == $identity){
				if(1 == $identity || "1" == $identity){
					$teacherID = $_SESSION['ID'];
				}else{
					$teacherID = (int)$_GET['user_id'];
				}

				$teacherResult = $userBasOp->getUserInfo("register",$teacherID,null,null,null,$field);
				$beforeTime = GlobalValue::beforeTime;
				$afterTime = GlobalValue::afterTime;

				$searchStartTime = strtotime("{$year}-{$month} -{$beforeTime} days");
				$searchEndTime = strtotime("{$year}-{$month} +1 month +{$afterTime} days");

				$classStatusResult = $claBasOp->getTeacherClassStatus($teacherID,$searchStartTime,$searchEndTime);

				$this->assign("teacherClassResult",json_encode($classStatusResult));
				$this->assign("teacherType",$teacherResult[0]);
				if(1 == $identity || "1" == $identity){
					$this->display("Teacher:MyMonthPlan");
				}elseif(2 == $identity || "2" == $identity){
					$this->assign('teacherID',$teacherID);
					$this->display("Admin:TeaMonthPlan");
				}elseif(4 == $identity || "4" == $identity){
					$this->assign('teacherID',$teacherID);
					$this->display("Root:TeaMonthPlan");
				}else{

				}
				return;
			}else{
				$this->error("你没有权限查看教师信息");
			}
		}

		/*
		*俞鹏泽
		*开放课程课程时间的操作
		*/
		public function ClassManage(){
			$this->CheckSession();

			import("Home.Action.Class.ClassBasicService");
			$identity = $_SESSION['identity'];

			$opType = $_GET['type'];    //获取操作类型
			$year = $_POST['year'];
			$month = $_POST['month'];
			//如果用户不是教师,不是admin,不是root
			if($identity != 1 || $identity != "1" || $identity != 2 || $identity != "2" || $identity != 4 || $identity != "4" ){
				if($opType == "add"){
					if(1 == $identity || "1" == $identity){
						$teacherID = $_SESSION['ID'];
					}else{
						$teacherID = (int)$_GET['user_id'];
					}

					$classTimeData = json_decode($_POST['data'],true);    //将获取到的json类型的课程数据转成数组
					$classBasOp = new ClassBasicService();
					$result = $classBasOp->Opencourse($teacherID,$classTimeData);
					if($result['status']){
						//不论成功与否都带上教师的ID即,array('user_id'=>$teacherID)
						$this->success("开课成功",U('Class/getTeacherClassPlan',array('user_id'=>$teacherID,'year'=>$year,'month'=>$month)));
					}else{
						$this->error("开课失败",U('Class/getTeacherClassPlan',array('user_id'=>$teacherID,'year'=>$year,'month'=>$month)));
					}
					return;
				}elseif($opType == "delete"){
					if(1 == $identity || "1" == $identity){
						$teacherID = $_SESSION['ID'];
					}else{
						$teacherID = (int)$_GET['user_id'];
					}
					$classTimeData = json_decode($_POST['data'],true);    //将获取到的json类型的课程数据转成数组
					$classBasOp = new ClassBasicService();
					$result = $classBasOp->DeleteCourse($teacherID,$classTimeData);
					if($result['status']){
						//不论成功与否都带上教师的ID即,array('user_id'=>$teacherID)
						$this->success("取消课程成功",U('Class/getTeacherClassPlan',array('user_id'=>$teacherID,'year'=>$year,'month'=>$month)));
					}else{
						$this->error("取消课程失败",U('Class/getTeacherClassPlan',array('user_id'=>$teacherID,'year'=>$year,'month'=>$month)));
					}
					return;
				}elseif($opType == "find"){

				}else{
					$this->error("没有该操作类型");
				}
			}else{
				$this->error("你没有权限进行管理");
			}
		}

		/*
		*俞鹏泽
		*通过ajax访问教师课程开放时间
		*/
		//要返回的数据:1.教师空余课程时间以及    教师信息??
		//           2.学生的订购的套餐的信息(课时类+剩余可以订购数量  卡类+提醒(每天一节课))
		//           3.
		public function ajaxGetTeacherClassInfo(){
			$judResult = judgeAjaxRequest();
			if(!$judResult){
				echo "非指定数据请求";
				return;
			}
			$teacherID = null;
			import("Home.Action.Class.ClassBasicService");
			$classOp = new ClassBasicService();

			$identity = $_SESSION['identity'];
			if(0 == $identity || "0" == $identity){
				$teacherID = $_POST['teacher_id'];
				$result = $classOp->getTeacherFreeClassTime($teacherID);
				if(is_null($result)){
					echo json_encode(array());
				}else{
					echo json_encode($result);
				}
			}elseif(1 == $identity || "1" == $identity){

			}elseif(2 == $identity || "2" == $identity){

			}elseif(4 == $identity || "4" == $identity){

			}else{
				echo "用户权限不够";
			}
		}
	}
 ?>
