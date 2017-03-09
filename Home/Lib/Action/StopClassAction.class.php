<?php
	class StopClassAction extends Action{
		public function __construct(){
            //获取系统设置
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
		*对学生的停课管理的操作
		*/
		//该管理分为申请停课管理以及取消课程管理   (测试暂时成功)
		public function StopClassManage(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			$type = $_GET['type'];
			import("Home.Action.StopClass.StopClassBasicService");
			$stopClassOp = new StopClassBasicService();

			if("2" == $identity || 2 == $identity){
				if("apply" == $type){
					$startTime = strtotime($_POST['startTime']);
					$endTime = strtotime($_POST['endTime']);
					$result = $stopClassOp->
					addStudentStopClassInfoService($_POST['studentID'],$_SESSION['ID'],$startTime,$endTime);
					if($result['status']){
						$this->success("添加停课成功");
					}else{
						$this->error("添加停课失败");
					}
					return;
				}elseif("cancel" == $type){
					$result = $stopClassOp->cancelStudentStopClass($_POST['stopID']);
					if($result['status']){
						$this->success("取消停课成功");
					}else{
						$this->error("取消停课失败");
					}
					return;
				}else{
					$this->error("没有对应的操作");
				}
			}elseif("4" == $identity || 4 == $identity){
				if("apply" == $type){
					$startTime = strtotime($_POST['startTime']);
					$endTime = strtotime($_POST['endTime']);
					$result = $stopClassOp->
					addStudentStopClassInfoService($_POST['studentID'],$_SESSION['ID'],$startTime,$endTime);
					if($result['status']){
						$this->success("添加停课成功");
					}else{
						$this->error("添加停课失败");
					}
					return;
				}elseif("cancel" == $type){
					$result = $stopClassOp->cancelStudentStopClass($_POST['stopID']);
					if($result['status']){
						$this->success("取消停课成功");
					}else{
						$this->error("取消停课失败");
					}
					return;
				}else{
					$this->error("没有对应的操作");
				}
			}else{
				$this->error("你没有权限进行管理");
			}
		}

		/*
		*俞鹏泽
		*通过ajax的方式获取某个学生的停课信息
		*/
		public function ajaxGetStudentStopClass(){
			$this->CheckSession();
			$ajaxResult = judgeAjaxRequest();
			if(!$ajaxResult){
				echo "非指定的访问方式";
				return;
			}

			import("Home.Action.StopClass.StopClassBasicService");
			$stopClassOp = new StopClassBasicService();

			$studentID = $_POST['student_id'];
			$result = $stopClassOp->getStudentStopClass($studentID);
			if($result){
				//这里只取第一条数据
				echo json_encode($result[0]);
			}else{
				echo json_encode("{}");
			}
		}
	}
