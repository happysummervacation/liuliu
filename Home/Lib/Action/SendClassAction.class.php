<?php
	class SendClassAction extends Action{
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

		public function sendClassNum(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			import("Home.Action.SendClass.SendClassBasicService");
			$sendClassOp = new SendClassBasicService();

			if("4" == $identity || 4 == $identity){
				$studentID = $_GET['user_id'];
				$orderPackageID = $_POST['orderpackage_id'];
				$type = $_POST['type'];
				$sendnum = (int)$_POST['number']>0 ? (int)$_POST['number']:(int)$_POST['number']*-1;
				$reason = $_POST['reason'];
				if((int)$type == 0){  //表示删除
					$sendnum = (int)$sendnum*-1;
				}else{    //表示增加
					$sendnum = (int)$sendnum;
				}

				$result = $sendClassOp->sendClassToOrderPackage($orderPackageID,$sendnum,$reason,$studentID);
				if($result['status']){
					$this->success("赠送课时成功");
				}else{
					$this->error("赠送课时失败");
				}
			}elseif("2" == $identity || 2 == $identity){

			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}
	}
