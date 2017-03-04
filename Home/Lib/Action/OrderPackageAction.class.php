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

		/*
		*俞鹏泽
		*通过ajax的方式获取学生的订购的套餐的信息
		*/
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
				$teacherID = $_POST['teacher_id'];
				$result = $orderPackageOp->getStudentOneToOneOrderPackageInfo($studentID,$teacherID);
				if($result){
					echo json_encode($result);   //将获取到的数据以json的数据进行返回
				}else{
					echo json_encode(array());   //表示没有获取到数据时使用空数组返回
				}

			}elseif(2 == $identity || "2" == $identity){
				$studentID = $_GET['user_id'];
				$teacherID = $_POST['teacher_id'];
				$result = $orderPackageOp->getStudentOneToOneOrderPackageInfo($studentID,$teacherID);
				if($result){
					echo json_encode($result);   //将获取到的数据以json的数据进行返回
				}else{
					echo json_encode(array());   //表示没有获取到数据时使用空数组返回
				}
			}elseif(4 == $identity || "4" == $identity){
				$studentID = $_GET['user_id'];
				$teacherID = $_POST['teacher_id'];
				$result = $orderPackageOp->getStudentOneToOneOrderPackageInfo($studentID,$teacherID);
				if($result){
					echo json_encode($result);   //将获取到的数据以json的数据进行返回
				}else{
					echo json_encode(array());   //表示没有获取到数据时使用空数组返回
				}
			}else{
				echo "你没有权限进行访问";
				return;
			}
		}

		/*
		*俞鹏泽
		*对学生订购的套餐进行管理
		*/
		public function OrderPackageManage(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			$type = $_GET['type'];

			import("Home.Action.OrderPackage.OrderPackageBasicService");
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			$orderPackageOp = new OrderPackageBasicService();
			$orderPackagopOp = new OrderPackageBasicOperate();

			if(2 == $identity || "2" == $identity){
				//这里根据不同的操作类型进行不同的操作
				// if("delay" == $type){
				// 	$orderPacResult = $orderPackageOp->dealyOrderPackage($_POST['orderpackage'],$_POST['stoptime']);
				// }
			}elseif(4 == $identity || "4" == $identity){
				//这里根据不同的操作类型进行不同的操作
				if("delay" == $type){   //这里是套餐的延期
					$orderPacResult = $orderPackageOp->dealyOrderPackage($_POST['orderpackage'],$_POST['stoptime']);
					if($orderPacResult['status']){
						$this->success($orderPacResult['message']);
					}else{
						$this->error($orderPacResult['message']);
					}
					return;
				}elseif("loseff" == $type){  //这里表示的是套餐的失效
					$orderPackageID = (int)$_GET['orderpackageID'];
					$data['status'] = 0;
					$result = $orderPackagopOp->updateOrderPackageInfo($orderPackageID,$data);

					if($result){
						$this->success("套餐失效成功");
					}else{
						$this->error("套餐失效失败,请重试");
					}
					return;
				}elseif("effect" == $type){    //这里表示套餐生效
					$orderPackageID = (int)$_GET['orderpackageID'];
					$data['status'] = 1;
					$result = $orderPackagopOp->updateOrderPackageInfo($orderPackageID,$data);
					if($result){
						$this->success("套餐有效成功");
					}else{
						$this->error("套餐有效失败,请重试");
					}
					return;
				}else{
					$this->error("没有该类型的操作");
					return;
				}
			}elseif(0 == $identity || "0" == $identity){   //表示对象是学生时,对订购的套餐的管理
				if("delayMon" == $type){   //   表示使用账户余额进行套餐的延期
					import("Home.Action.OrderPackage.OrderPackageBasicService");
					$orderPacSerOp = new OrderPackageBasicService();
					$result = $orderPacSerOp->studentDelayOrderPacWithMoney($_POST['orderpackage_id'],$_SESSION['ID'],$_POST['delay_month']);
					if($result['status']){
						$this->success("套餐延期成功");
					}else{
						$this->error($result['message']);
					}
					return;
				}else{
					$this->error("没有对应的操作");
					return;
				}
			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}
	}
 ?>
