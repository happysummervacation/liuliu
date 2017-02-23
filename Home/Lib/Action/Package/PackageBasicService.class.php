<?php
	class PackageBasicService extends Action{
		public function addPackageInfo($postData = null){
			$message = array();
			if(is_null($postData)){
				$message['status'] = false;
				$message['message'] = "没有要添加的数据";
				return $message;
			}

			$data['category'] = $postData['classType'];
			$data['class_type'] = $postData['studentType'];
			$data['package_type'] = $postData['packageType'];
			$data['student_number'] = $postData['studentNumber'];
			$data['class_number'] = $postData['classNumber'];
			$data['teacher_nation'] = $postData['teacherNation'];
			$data['teacher_type'] = $postData['teacherType'];
			$data['time'] = $postData['dayNumber'];
			$data['package_content'] = $postData['description'];
			$data['package_money'] = $postData['packagPrice'];
			$data['create_time'] = getTime();
			$data['last_modify'] = getTime();
			$data['isdelete'] = 0;

			import("Home.Action.Package.PackageBasicOperate");
			$packageOp = new PackageBasicOperate();
			$result = $packageOp->addPackage($data);
			if($result){
				$message['status'] = true;
				$message['message'] = "套餐数据创建成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "套餐数据创建失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*修改套餐的数据
		*/
		public function updatePackageInfo($packageID = null,$postData = null){
			$message = array();
			if(is_null($postData)){
				$message['status'] = false;
				$message['message'] = "没有要添加的数据";
				return $message;
			}
dump($postData);
exit;
			$data['category'] = $postData['classType'];
			$data['class_type'] = $postData['studentType'];
			$data['package_type'] = $postData['packageType'];
			$data['student_number'] = $postData['studentNumber'];
			$data['class_number'] = $postData['classNumber'];
			$data['teacher_nation'] = $postData['teacherNation'];
			$data['teacher_type'] = $postData['teacherType'];
			$data['time'] = $postData['dayNumber'];
			$data['package_content'] = $postData['description'];
			$data['package_money'] = $postData['packagPrice'];
			$data['create_time'] = getTime();
			$data['last_modify'] = getTime();
			$data['isdelete'] = 0;

			import("Home.Action.Package.PackageBasicOperate");
			$packageOp = new PackageBasicOperate();
			$result = $packageOp->addPackage($data);
			if($result){
				$message['status'] = true;
				$message['message'] = "套餐数据创建成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "套餐数据创建失败";
				return $message;
			}
		}
	}
 ?>
