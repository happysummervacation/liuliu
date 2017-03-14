<?php
class AlipayAction extends Action{
	private $systemSet = null;
	public function __construct(){
		//在初始化的时候就蒋系统的参数设置到私有变量的systemSet中
		$field = array();
		array_push($field, "studentcancelrate");
		import("Home.Action.System.SystemBasicOperate");
		$systemOp = new SystemBasicOperate();
		$result = $systemOp->getSystemSet();
		$this->systemSet = $result;
	}

	public function _empty($name){
		echo "路径错误";
	}

	/*
	*俞鹏泽
	*显示支付宝支付页面
	*/
	//2017-1-29用于测试
	//以后需要将需要支付的数据带过来
	public function index(){
	//	$this->display();
	}

	public function alipayapi(){
		//导入必要的文件
		import("Home.Action.lib.alipay_submit");

		echo '<!DOCTYPE html>
				<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title>支付宝即时到账交易接口接口</title>
				</head>';

		/*支付的主要代码*/

		/**************************请求参数**************************/
		//商户订单号，商户网站订单系统中唯一订单号，必填
		$out_trade_no = $_POST['WIDout_trade_no'];

		//订单名称，必填
		$subject = $_POST['WIDsubject'];

		//付款金额，必填
		$total_fee = $_POST['WIDtotal_fee'];

		//商品描述，可空
		$body = $_POST['WIDbody'];

		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service"       => C('service'),//     $alipay_config['service'],
			"partner"       => C('partner'),//     $alipay_config['partner'],
			"seller_id"  => C('seller_id'),//     $alipay_config['seller_id'],
			"payment_type"	=> C('payment_type'),//     $alipay_config['payment_type'],
			"notify_url"	=> C('notify_url'),//     $alipay_config['notify_url'],
			"return_url"	=> C('return_url'),//     $alipay_config['return_url'],

			"anti_phishing_key"=>C('anti_phishing_key'),//     $alipay_config['anti_phishing_key'],
			"exter_invoke_ip"=>C('exter_invoke_ip'),//     $alipay_config['exter_invoke_ip'],
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"total_fee"	=> $total_fee,
			"body"	=> $body,
			"_input_charset"	=> trim(strtolower(C('input_charset')))//trim(strtolower($alipay_config['input_charset']))
		);

		$alipay_config['partner']		= C('partner');
		$alipay_config['seller_id']	= C('seller_id');
		$alipay_config['key']			= C('key');
		$alipay_config['notify_url'] = C('notify_url');
		$alipay_config['return_url'] = C('return_url');
		$alipay_config['sign_type']    = C('sign_type');
		$alipay_config['input_charset']= C('input_charset');
		$alipay_config['cacert']    = C('cacert');
		$alipay_config['transport']    = C('transport');
		$alipay_config['payment_type'] = C('payment_type');
		$alipay_config['service'] = C('service');
		$alipay_config['anti_phishing_key'] = C('anti_phishing_key');
		$alipay_config['exter_invoke_ip'] = C('exter_invoke_ip');

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;

		/****************/
		echo '</body>
			  </html>';
	}

	public function notify_url(){
		echo "notify_url";
	}

	public function return_url(){
		import("Home.Action.lib.alipay_notify");

		echo '<!DOCTYPE HTML>
				<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';

		/*支付宝的处理结果*/

		//计算得出通知验证结果
		$alipay_config['partner']		= C('partner');
		$alipay_config['seller_id']	= C('seller_id');
		$alipay_config['key']			= C('key');
		$alipay_config['notify_url'] = C('notify_url');
		$alipay_config['return_url'] = C('return_url');
		$alipay_config['sign_type']    = C('sign_type');
		$alipay_config['input_charset']= C('input_charset');
		$alipay_config['cacert']    = C('cacert');
		$alipay_config['transport']    = C('transport');
		$alipay_config['payment_type'] = C('payment_type');
		$alipay_config['service'] = C('service');
		$alipay_config['anti_phishing_key'] = C('anti_phishing_key');
		$alipay_config['exter_invoke_ip'] = C('exter_invoke_ip');

		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result[3]) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码

			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			//获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

			//商户订单号

			$out_trade_no = $_GET['out_trade_no'];

			//支付宝交易号

			$trade_no = $_GET['trade_no'];

			//交易状态
			$trade_status = $_GET['trade_status'];


			if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序

				/*业务逻辑代码*/
				//这里只要套餐添加成功就可以进行事务提交
				/*这里的逻辑代码还需要不断的改进，还有很多需要添加，日志，添加数据的确保，session的保证*/

				/***************    之上的都是课程寒假中的数据     *******/
				/***************    之下的都是2017-2-25之后的逻辑   *****/
				/*过程:
				1.启动事务处理
				2.根据session中的ID获取套餐的数据
				3.添加一份订购套餐数据到数据  //
				4.更新学生的可取消次数       //
				5.获取学生的信息进行日志记录  //
				6.返回最终的消息给用户
				*/
				$Mysql = new Model();
				$Mysql->startTrans();
				//根据session中套餐的ID来获取套餐的数据
				import("Home.Action.Package.PackageBasicOperate");
				import("Home.Action.OrderPackage.OrderPackageBasicService");
				import("Home.Action.OrderPackage.OrderPackageBasicOperate");
				import("Home.Action.User.UserBasicOperate");
				import("Home.Action.Contract.ContractBasicOperate");
				$contractOp = new ContractBasicOperate();
				$packageOp = new PackageBasicOperate();
				$packageServiceOp = new OrderPackageBasicService();
				$orderPackageOp = new OrderPackageBasicOperate();
				$userOp = new UserBasicOperate();

				$StudentID = $_SESSION["ID"];

				$packageInfo = $packageOp->getPackageInfo($_SESSION['packageID']);
				$orderPackageData = $packageServiceOp->createOrderPackageInfo($packageInfo[0],$StudentID);
				//添加订购套餐信息
				$orderPackageResult = $orderPackageOp->addOrderPakcageInfo($orderPackageData);

				//创建合同的数据
				$contractData = $packageServiceOp->createOrderPackageContract(
					$orderPackageResult['data'],$StudentID);
				//添加合同的信息
				$studentContractResult = $contractOp->addContract($contractData);

				$cancelNumResult = true;     //可取消的课程次数默认为true
				//判断是否是课时类套餐,如果是就进行可取消次数修改
				if((int)$packageInfo[0]['package_type'] == 0){
					$cancelNumResult = $userOp->updateStudentCancelNum
					($_SESSION['ID'],null,(int)$packageInfo[0]['class_number']/(int)$this->systemSet['cancelClassRate']);
				}

				//添加日志记录
				//对日志写入操作不保证
				$userData = $userOp->getUserInfo('register',$_SESSION['ID'])[0];
				if($orderPackageResult['status']){
					$Mysql->commit();
					$txt = "账号为{$userData['account']}的用户,
					在".date("Y-m-d H:i:s",getTime())."购买套餐编号是{$packageInfo['packageID']},
					套餐名是{$packageInfo['package_name']}的套餐,最终的购买结果是成功的";
					AlipayLog($txt);
					// $this->success("套餐购买成功",U('Package/packageShow'));
				}else{
					$Mysql->rollback();
					$txt = "账号为{$userData['account']}的用户,
					在".date("Y-m-d H:i:s",getTime())."购买套餐编号是{$packageInfo['packageID']},
					套餐名是{$packageInfo['package_name']}的套餐,最终的购买结果是失败的";
					// $this->error("套餐购买失败",U('Package/packageShow'));
				}

				// //添加套餐的数据
				// import("Home.Action.Package.PackageOperate");
				// $AddResult = PackageOperate::AddOrderPackage($_SESSION['ID'],$_SESSION['packageInfo']['package_id']);
				//
				// //添加取消课程次数
				// import("Home.Action.Global.GlobalVariable");
				// $addCount = (int)($packageInformation["class_number"] / GlobalVariable::$CancelClassRate);
				//
				// import("Home.Action.Info.InfoOperate");
				// $resultAddCancelCount = InfoOperate::AddCancelCount($_SESSION['ID'],$addCount);
				//
				// //改进
				// /*这里需要进行优化，不管成功还是失败都需要进行记录*/
				// //获取用户信息
				// $field = array();
				// array_push($field,"account","chinesename","englishname");
				// $registerInfo = InfoOperate::GetInfoWithID($_SESSION['ID'],null,$field);
				// import("Home.Action.Record.Record");

				// if($AddResult){
				// 	$Mysql->commit();
				// 	$txt = "账号为{$registerInfo['account']},中文名为{$registerInfo['chinesename']},英文名为{$registerInfo['englishname']}的用户购买了编号ID为{$_SESSION['packageInfo']['package_id']},类别为{$_SESSION['packageInfo']['c_category']}|{$_SESSION['packageInfo']['c_package_type']},价格为{$_SESSION['packageInfo']['package_money']}元的套餐，用户已经支付成功，同时套餐也添加成功";
				// 	Record::AlipayLog($txt);
				// 	$this->success("添加套餐成功",U("Student/NewPackage"));
				// }else{
				// 	$txt = "账号为{$registerInfo['account']},中文名为{$registerInfo['chinesename']},英文名为{$registerInfo['englishname']}的用户购买了编号ID为{$_SESSION['packageInfo']['package_id']},类别为{$_SESSION['packageInfo']['c_category']}|{$_SESSION['packageInfo']['c_package_type']},价格为{$_SESSION['packageInfo']['package_money']}元的套餐,用户已经支付成功,套餐也添加失败";
				// 	Record::AlipayLog($txt);
				// 	$Mysql->rollback();
				// 	$this->error("添加套餐失败,请联系管理员进行确认",U("Student/NewPackage"));
				// }
			}
			else {
			  echo "trade_status=".$_GET['trade_status'];
			}

			// echo "验证成功<br />";

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
			//验证失败
			//如要调试，请看alipay_notify.php页面的verifyReturn函数
			echo "验证失败";
		}

		/**/
		echo '<title>支付宝即时到账交易接口</title>
					</head>
					<body>
					</body>
			  </html>';
	}

}
