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
			$teacherID = null;
			//提供公用的数据
			$this->assign('this_month',date('m',getTime()));
            $this->assign('this_year',date('Y',getTime()));
			$this->assign("nowtimePlan",getTime());

			$userBasOp = new UserBasicOperate();
			$field = array();
			array_push($field,"teacher_type");

			$identity = $_SESSION['identity'];
			if(1 == $identity || "1" == $identity){
				$teacherID = $_SESSION['ID'];
				$teacherResult = $userBasOp->getUserInfo("register",$teacherID,null,null,null,$field);

				$this->assign("teacherClassResult","{}");
				$this->assign("teacherType",$teacherResult[0]);
				$this->display("Teacher:MyMonthPlan");
			}elseif(2 == $identity || "2" == $identity){

			}elseif(4 == $identity || "4" == $identity){

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

			//如果用户不是教师,不是admin,不是root
			if($identity != 1 || $identity != "1" || $identity != 2 || $identity != "2" || $identity != 4 || $identity != "4" ){
				if($opType == "add"){
					$teacherID = $_SESSION['ID'];
					$classTimeData = json_decode($_POST['data'],true);    //将获取到的json类型的课程数据转成数组
					$classBasOp = new ClassBasicService();
					$result = $classBasOp->Opencourse($teacherID,$classTimeData);
					if($result['status']){
						$this->success("开课成功",U('Class/getTeacherClassPlan'));
					}else{
						$this->error("开课失败",U('Class/getTeacherClassPlan'));
					}
				}elseif($opType == "delete"){

				}elseif($opType == "find"){

				}else{
					$this->error("没有该操作类型");
				}
			}else{
				$this->error("你没有权限进行管理");
			}
		}
	}
 ?>
