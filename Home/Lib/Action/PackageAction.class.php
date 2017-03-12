<?php
	class PackageAction extends Action{
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
		*显示套餐的信息(这里仅仅是套餐管理而非学生订购的套餐的管理)
		*/
		public function packageShow(){
			$this->CheckSession();
			import("Home.Action.Package.PackageConfigBasicOperate");
			import("Home.Action.Package.PackageBasicOperate");
			$configOp = new PackageConfigBasicOperate();
			$packageOp = new PackageBasicOperate();

			$identity = $_SESSION['identity'];
			if($identity == 4 || $identity == "4"){
				$result = $configOp->getPackageConfigInfo();
				$packageResult = $packageOp->getPackageInfo();

				$this->assign("packageList",$packageResult);
				$this->assign('packageConfig',$result);
				$this->display("Root:PackageManage");
				return;
			}elseif($identity == 0 || $identity = "0"){
				$result = $configOp->getPackageConfigInfo();
				$packageResult = $packageOp->getPackageInfo();

				$this->assign('packageConfig',$result);
				$this->assign('packageList',$packageResult);
				$this->display("Student:NewPackage");
				return;
			}else{
				$this->error("你没有权限查看该页面内容");
				return;
			}
			// $this->CheckSession();
			// $identity = $_SESSION['identity'];
			// import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			// import("Home.Action.OrderPackage.OrderPackageFeatureService");
			// import("Home.Action.Package.PackageBasicOperate");
			// import("Home.Action.User.UserBasicOperate");
			// $orderpacOp = new OrderPackageBasicOperate();
			// $orderPacFeaSerOp = new OrderPackageFeatureService();
			// $packageOp = new PackageBasicOperate();
			// $userOp = new UserBasicOperate();
			// $studentID = $_GET['user_id'];
			//
			// import("Home.Action.Package.PackageConfigBasicOperate");
			// $configOp = new PackageConfigBasicOperate();
			// /*
			// *获取该学生订购的套餐的数据
			// */
			// $sql = "studentID={$_GET['user_id']} and isdelete=0";
			// $result = $orderpacOp->getOrderPackageInfoWithCondition($sql);
			// //获取学生的套餐数据
			// $result = $orderPacFeaSerOp->dealOrderPackageOrderClassData($studentID,$result);
			//
			// /* 获取所有的package的id*/
			// $packageid = $packageOp->getPackageInfo(null,array('package_id'));
			// $this->assign("packageid",$packageid);
			//
			// if(2 == $identity || "2" == $identity){
			// 	/*这里在进行学生数据展示时需要进行判断,判断该学生时候是归该admin管理*/
			// 	$manageID = $userOp->getUserInfo('student',$studentID,null,null,null,array('student_manage_id'));
			// 	if($manageID[0]['student_manage_id'] != $_SESSION['ID']){
			// 		$this->error("你没有权限查看该学生的数据");
			// 	}
			// 	$this->assign("orderPackageList",$result);
			// 	$this->assign("studentID",$studentID);
			// 	$this->display("Root:StuPackageInfo");
			// }elseif(4 == $identity || "4" == $identity){
			// 	$result = $configOp->getPackageConfigInfo();
			// 	$packageResult = $packageOp->getPackageInfo();
			//
			// 	$this->assign("orderPackageList",$result);
			// 	$this->assign("studentID",$studentID);
			// 	$this->display("Root:StuPackageInfo");
			// }elseif($identity == 0 || $identity = "0"){
			// 	$result = $configOp->getPackageConfigInfo();
			// 	$packageResult = $packageOp->getPackageInfo();
			//
			// 	$this->assign('packageConfig',$result);
			// 	$this->assign('packageList',$packageResult);
			// 	$this->display("Student:NewPackage");
			// 	return;
			// }else{
			// 	$this->error("你没有权限查看数据");
			// }
		}

		/*
		*俞鹏泽
		*获取学生订购的套餐的信息
		*/
		public function studentPackageShow(){
			// $this->CheckSession();
			//
			// $identity = $_SESSION['identity'];
			//
			// import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			// import("Home.Action.OrderPackage.OrderPackageFeatureService");
			// $orderpacOp = new OrderPackageBasicOperate();
			// $orderPacFeaSerOp = new OrderPackageFeatureService();
			//
			// if(2 == $identity || "2" == $identity){
			// 	/*这里在进行学生数据展示时需要进行判断,判断该学生时候是归该admin管理*/
			// 	$manageID = $userOp->getUserInfo('student',$studentID,null,null,null,array('student_manage_id'));
			// 	if($manageID[0]['student_manage_id'] != $_SESSION['ID']){
			// 		$this->error("你没有权限查看该学生的数据");
			// 	}
			// 	$this->assign("orderPackageList",$result);
			// 	$this->assign("studentID",$studentID);
			// 	$this->display("Admin:StuPackageInfo");
			// }elseif(4 == $identity || "4" == $identity){
			// 	/*
			// 	*获取该学生订购的套餐的数据
			// 	*/
			// 	$studentID = $_GET['user_id'];
			// 	$sql = "studentID={$_GET['user_id']} and isdelete=0";
			// 	$result = $orderpacOp->getOrderPackageInfoWithCondition($sql); //获取学生的套餐数据
			// 	$result = $orderPacFeaSerOp->dealOrderPackageOrderClassData($studentID,$result);
			//
			// 	$this->assign("orderPackageList",$result);
			// 	$this->assign("studentID",$studentID);
			// 	$this->display("Root:StuPackageInfo");
			// }else{
			// 	$this->error("你没有权限查看数据");
			// }
			$this->CheckSession();
			$identity = $_SESSION['identity'];
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			import("Home.Action.OrderPackage.OrderPackageFeatureService");
			import("Home.Action.Package.PackageBasicOperate");
			import("Home.Action.User.UserBasicOperate");
			$orderpacOp = new OrderPackageBasicOperate();
			$orderPacFeaSerOp = new OrderPackageFeatureService();
			$packageOp = new PackageBasicOperate();
			$userOp = new UserBasicOperate();
			$studentID = $_GET['user_id'];
			/*
			*获取该学生订购的套餐的数据
			*/
			$sql = "studentID={$_GET['user_id']} and isdelete=0";
			$result = $orderpacOp->getOrderPackageInfoWithCondition($sql);
			//获取学生的套餐数据
			$result = $orderPacFeaSerOp->dealOrderPackageOrderClassData($studentID,$result);

			/* 获取所有的package的id*/
			$packageid = $packageOp->getPackageInfo(null,array('package_id'));
			$this->assign("packageid",$packageid);

			if(2 == $identity || "2" == $identity){
				/*这里在进行学生数据展示时需要进行判断,判断该学生时候是归该admin管理*/
				$manageID = $userOp->getUserInfo('student',$studentID,null,null,null,array('student_manage_id'));
				if($manageID[0]['student_manage_id'] != $_SESSION['ID']){
					$this->error("你没有权限查看该学生的数据");
				}
				$this->assign("orderPackageList",$result);
				$this->assign("studentID",$studentID);
				$this->display("Admin:StuPackageInfo");
			}elseif(4 == $identity || "4" == $identity){
				$this->assign("orderPackageList",$result);
				$this->assign("studentID",$studentID);
				$this->display("Root:StuPackageInfo");
			}else{
				$this->error("你没有权限查看数据");
			}
		}
		/*
		*俞鹏泽
		*课程顾问以及管理员对学生套餐信息管理
		*/
		public function studentPackageManage(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];

			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			$orderpacOp = new OrderPackageBasicOperate();

			if(2 == $identity || "2" == $identity){
				/*这里在进行学生数据展示时需要进行判断,判断该学生时候是归该admin管理*/
			}elseif(4 == $identity || "4" == $identity){
				/*
				*获取该学生订购的套餐的数据
				*/
				$result = $orderpacOp->getStuActiveOrderPackageInfo($_GET['user_id']);
				$this->assign("orderPackageList",$result);
				$this->display("Root:StuPackageInfo");
			}else{
				$this->error("你没有权限进行操作");
			}
		}

		/*
		*俞鹏泽
		*root关于套餐基本信息增删改管理,学生关于套餐基本信息的条件查询
		*/
		public function packageManage(){
			$this->CheckSession();
			import("Home.Action.Package.PackageBasicOperate");
			import("Home.Action.Package.PackageBasicService");
			import("Home.Action.Package.PackageConfigBasicOperate");
			$configOp = new PackageConfigBasicOperate();
			$packageBasOp = new PackageBasicOperate();
			$packageOp = new PackageBasicService();

			$type = $_GET['type'];

			$identity = $_SESSION['identity'];

			if($identity == 4 || $identity == "4"){
				if($type == "add" || $type == "0"){
					$result = $packageOp->addPackageInfo($_POST);
					if($result['status']){
						$this->success("添加成功");
					}else{
						$this->error("添加失败");
					}
				}elseif($type == "update" || $type == "1"){
					$result = $packageOp->updatePackageInfo($_POST['packageId'],$_POST);
					if($result['status']){
						$this->success("修改成功",U('Package/packageShow'));
					}else{
						$this->error("修改失败",U('Package/packageShow'));
					}
				}elseif($type == "delete" || $type == "2"){
					$packageID = $_GET['packageID'];
					$result = $packageOp->deletePackageInfo($packageID);
					if($result['status']){
						$this->success("删除成功",U('Package/packageShow'));
					}else{
						$this->error("删除失败",U('Package/packageShow'));
					}
				}else{
					$this->error("没有对应的操作");
					return;
				}
			}elseif($identity == 0 || $identity == '0'){
				if($type == 'select'){
					$selectResult = $packageBasOp->selectPackage($_POST);
					$result = $configOp->getPackageConfigInfo();
					if($selectResult){
						$this->assign('packageConfig',$result);
						$this->assign("packageList",$selectResult);
						$this->display("Student:NewPackage");
						return $selectResult;
					}else{
						$this->error('没有符合条件的结果',U('Package/packageShow'));
					}
				}else{
					$this->error("没有对应的操作");
				}
			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}

		/*
		*俞鹏泽
		*关于学生套餐的订购的操作  (用来处理套餐的订购)
		*/
		public function pakcageOrderDeal(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];

			import("Home.Action.OrderPackage.OrderPackageBasicService");
			$orderService = new OrderPackageBasicService();

			if(0 == $identity || "0" == $identity){    //如果是学生就要查看是什么支付方式,还要查看session中的套餐ID是否与产过来的ID相同,无论成功与否,session中的值都设置为null
				if(($_POST['package_id'] != $_SESSION['packageID']) || is_null($_SESSION['packageID'])){
					$this->error("要订购的信息出现异常,请重试",U('Package/packageShow'));
					$_SESSION['packageID'] = null;
					return;
				}

				if($_POST['pay_method'] == "balance"){    //站内支付
					$result = $orderService->orderPakcageWithStatPay($_SESSION['packageID'],$_SESSION['ID']);
					if($result['status']){
						$this->success("套餐购买成功",U('Package/packageShow'));
					}else{
						$this->error("套餐购买失败",U('Package/packageShow'));
					}
				}elseif($_POST['pay_method'] == "alipay"){   //支付宝支付
					//这里要做的是获取套餐的新并跳转到相应的alipay页面
					$orderService->orderPakcageWithAlipayPay($_SESSION['packageID']);
				}else{
					$this->error("不明订购方式,请重试",U('Package/packageShow'));
					$_SESSION['packageID'] = null;
					return;
				}
			}elseif(2 == $identity || "2" == $identity){  //站内支付
				$result = $orderService->orderPakcageWithStatPay($_POST['package_id'],$_POST['student_id']);
				if($result['status']){
					$this->success("套餐购买成功");
				}else{
					$this->error("套餐购买失败");
				}
			}elseif(4 == $identity || "4" == $identity){  //站内支付
				$result = $orderService->orderPakcageWithStatPay($_POST['package_id'],$_POST['student_id']);
				if($result['status']){
					$this->success("套餐购买成功");
				}else{
					$this->error("套餐购买失败");
				}
			}else{
				$this->error("你没有权限进行操作");
			}
			// elseif(2 == $identity || "2" == $identity){
			//
			// }elseif(4 == $identity || "4" == $identity){
			//
			// }else{
			// 	$this->error("你没有权限进行操作");
			// }
		}

		/*
		*俞鹏泽
		*中间的操作.将学生订购的套餐ID存储到session中的packageIDh中,并跳转到支付方式的选择页面
		*/
		public function orderPackage(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(0 == $identity || "0" == $identity){
				if(md5($_GET['ID']) != $_GET['check']){
					$this->error("套餐类型错误,请重试",U('Package/packageShow'));
					return;
				}
				$_SESSION['packageID'] = $_GET['ID'];
				$this->assign("package_id",$_GET['ID']);
				$this->display("Student:Pay");
			}else{
				$this->error("你没有权限进行操作");
			}
		}

		/*
		*蒋周杰
		*ajax获取套餐的信息
		*/
		public function AjaxgetPackageInfor(){
			$ajaxResult = judgeAjaxRequest();
			if(!$ajaxResult){
				echo "非指定访问方式";
				return;
			}
			import("Home.Action.Package.PackageBasicOperate");
			$packageOp = new PackageBasicOperate();
			$result = $packageOp->getPackageInfo($_POST['package_id']);
			if(0 == $result[0]['class_type']){
				$result[0]['class_type']='一对一';
			}else{
				$result[0]['class_type']='小班课';
			}
			if(0 == $result[0]['package_type']){
				$result[0]['package_type']='课时类';
			}else{
				$result[0]['package_type']='卡类';
			}
			if(0 == $result[0]['teacher_nation']){
				$result[0]['teacher_nation']='中教';
			}else{
				$result[0]['teacher_nation']='外教';
			}
			if(0 == $result[0]['teacher_type']){
				$result[0]['teacher_type']='普通';
			}else{
				$result[0]['teacher_type']='名师';
			}
			echo json_encode($result);
		}

		/*
		*蒋周杰
		*学生套餐延期页面的显示
		*/
		public function delayPackage(){
			$this->CheckSession();
			$identity = $_SESSION['identity'];
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			$opBO = new OrderPackageBasicOperate();
			if(0 == $identity || "0" == $identity){
				// $result = $opBO->getOrderPackageInfoWithCondition();
				$result = $opBO->getOrderPackageInfoWithCondition(
					"studentID = {$studentID} and isdelete=0 and status=1");
			}
			$this->assign("package_list",$result);
			$this->display("Student:DelayPackage");

		}
	}
 ?>
