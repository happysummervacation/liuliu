<?php
	class ContractAction extends Action{
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
		*学生签署合同的操作
		*/
		public function agreeContract(){
			$this->CheckSession();
			$identity = $_SESSION['identity'];
			if("0" == $identity || 0 == $identity){
				$ordercontractID = $_GET['order'];
				$token = $_GET['token'];
				$orderclassID = $_GET['ordercls'];
				$orderclasstoken = $_GET['ordclstoken'];
				$classtype = $_GET['classtype'];
				if((md5($ordercontractID) != $token) || (md5($orderclassID) != $orderclasstoken)){
					$this->error("发生意外,签署失败",U('UserCenter/index'));
					return;
				}
				import("Home.Action.Contract.ContractBasicOperate");
				$conBasOp = new ContractBasicOperate();
				$data['isSign'] = 1;
				$data['signTime'] = getTime();
				$result = $conBasOp->updateStudentContract($ordercontractID,$data);
				if($result['status']){    //表示签署成功
					$this->success("合同签署成功",U('OrderClass/studentAttendClass',
					array('ID'=>$orderclassID,'classtype'=>$classtype)));
					return;
				}else{
					$this->error("合同签署失败",U('UserCenter/index'));
					return;
				}
			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}
	}
 ?>
