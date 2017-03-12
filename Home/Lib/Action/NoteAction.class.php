<?php
	class NoteAction extends Action{
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

		public function UploadTeacherNote(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(1 == $identity || "1" == $identity){
				import("Home.Action.OrderClass.OrderClassBasicOperate");
				$orderClaOp = new OrderClassBasicOperate();
				$note = $_POST['file'];
				$oneOrderClassID = $_POST['orderclass_id'];
				$data['note'] = $note;
				$result = $orderClaOp->updateOneOrderClassInfo($oneOrderClassID,$data);
				if($result['status']){
					$this->success("笔记上传成功");
				}else{
					$this->error("笔记上传是失败");
				}
			}else{
				$this->error("你没有权限进行操作");
			}
		}
	}
