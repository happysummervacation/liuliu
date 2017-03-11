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
		//学生签署合时同时设置对应的订购的套餐的有效时间
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
				import("Home.Action.Contract.ContractBasicService");
				$conBasOp = new ContractBasicService();
				$result = $conBasOp->signContract($ordercontractID);
				// $data['isSign'] = 1;
				// $data['signTime'] = getTime();
				// $result = $conBasOp->updateStudentContract($ordercontractID,$data);
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

		/*
		*蒋周杰
		获取学生合同信息
		*/
		public function showContract(){
			$this->CheckSession();
			$identity = $_SESSION['identity'];
			import("Home.Action.Contract.ContractBasicOperate");
			$conBo = new ContractBasicOperate();
			if("0" == $identity || 0 == $identity){
				$studentID= $_SESSION['ID'];
				$result = array();
				$result = $conBo->getStudentContract($studentID);
				$this->assign('contractresult',$result);
				$this->display("Student:MyContract");
			}elseif(1 == $identity || "1" == $identity){
				$teacherID= $_SESSION['ID'];
				$result = array();
				$result = $conBo->getTeacherContract($teacherID);
				$this->assign('TeacherContract',$result);
				$this->display("Teacher:MyContract");
			}elseif(4 == $identity || "4" == $identity){
				dump($_GET);
				$this->display("Root:TeacherContract");
			}else{
				$this->error("你没有权限进行查看");
			}
		}

		/*
		*蒋周杰
		*获得学生合同的具体信息
		*/
		public function getContractInfo(){
			$this->CheckSession();
			import("Home.Action.User.UserBasicOperate");
			import("Home.Action.OrderPackage.OrderPackageBasicService");
			import("Home.Action.Contract.ContractBasicOperate");
			$conBo = new ContractBasicOperate();
			$identity = $_SESSION['identity'];
			$studentID = $_SESSION['ID'];
			$orderpackageID = $_GET['orderpackageID'];
			$userOp = new UserBasicOperate();
			$packageOp = new OrderPackageBasicService();
			if("0" == $identity || 0 == $identity){
				//获得学生的个人信息
				$studentInfo = $userOp->getUserInfo('student',$studentID);

				//获取套餐的信息
				$packageInfo = $packageOp->getOrderPackageInfo($orderpackageID);
				//获得合同信息
				$contractInfo = $conBo->getStudentContractWithCondition($orderpackageID,$studentID);
				$result = array();
				$result['chinesename'] = $studentInfo[0]['chinesename'];
				$result['sex'] = $studentInfo[0]['sex'];
				$result['country'] = $studentInfo[0]['country'];
				$result['phone'] = $studentInfo[0]['phone'];
				$result['classType'] = $packageInfo[0]['classType'];
				$result['teacherNation'] = $packageInfo[0]['teacherNation'];
				$result['teacherType'] = $packageInfo[0]['teacherType'];
				$result['classNumber'] = $packageInfo[0]['classNumber'];
				$result['packageType'] = $packageInfo[0]['packageType'];
				$result['time'] = $packageInfo[0]['time'];
				$result['startTime'] = $packageInfo[0]['startTime'];
				$result['nowTime'] = getTime();
				$result['signTime'] = $contractInfo[0]['signTime'];
				$result['ordercontractID'] = $contractInfo[0]['ordercontractID'];
			}
			//判断是否只读
			if($_GET['isSign']){
				$onlyreadflag = 1;
			}else{
				$onlyreadflag = 0;
			}
			$this->assign("onlyreadflag",$onlyreadflag);
			$this->assign('contract_data',$result);
			$this->display('Student:Contract');
		}

	}
 ?>
