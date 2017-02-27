<?php
	class OrderPackageAction Extends Action{
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

		public function ajaxGetStuOrderPackageInfo(){
			$judgeResult = judgeAjaxRequest();
			if(!$judgeResult){
				echo "访问失败";
				return;
			}

			import("Home.Action.OrderPackage.OrderPackageBasicService");
			$orderPackageOp = new OrderPackageBasicService();
			$studentID = "";

			$identity = $_SESSION['identity'];
			if(0 == $identity || "0" == $identity){
				$studentID = $_SESSION['ID'];
				$orderPackageOp->getStudentOneToOneOrderPackageInfo($studentID);
			}elseif(2 == $identity || "2" == $identity){

			}elseif(4 == $identity || "4" == $identity){

			}else{
				echo "你没有权限进行访问";
				return;
			}
		}
	}
 ?>
