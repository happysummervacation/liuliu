<?php
	/*
	*俞鹏泽
	*该类主要用来处理小班相关的操作
	相关的操作主要包括:(暂定)
	1.添加小班的服务
	2.关于小班的各种查询
	3.小班的各种管理
	*/
	class GroupBasicService extends Action{
		/*
		*俞鹏泽
		*添加小班的服务
		*该函数是根据传入的套餐ID获取课程的各种状态,根据教材ID来获取教材的信息,最后加小班的名称
		*/
		public function AddGroupService($packageID = null,$bookID = null,$groupName = null){
			$message = array();
			if(is_null($packageID) || is_null($bookID)){
				$message['status'] = false;
				$message['message'] = "缺乏开课的必要数据,开课失败";
				return $message;
			}
			import("Home.Action.Package.PackageBasicOperate");
			import("Home.Action.Book.BookBasicOperate");
			$pacBasicOp = new PackageBasicOperate();
			$bookBasicOp = new BookBasicOperate();

			//先获取套餐的数据
			$pacInfoResult = $pacBasicOp->getPackageInfo($packageID);
			//获取对应的教材的信息
			$bookInfo = $bookBasicOp->getoneBookInfo($bookID);

			$inquiry = new Model("group");
			$data = array();
			$data['groupName'] = is_null($groupName) ? "":$groupName;
			$data['material'] = $bookInfo[0]['bookid'].":".$bookInfo[0]['bookname'].":".
				$bookInfo[0]['book_type'];
			$data['gcategory'] = $pacInfoResult[0]['category'];
			$data['gclassNumber'] = $pacInfoResult[0]['class_number'];
			$data['gstudentNumber'] = $pacInfoResult[0]['student_number'];
			$data['gteacherType'] = $pacInfoResult[0]['teacher_nation'];
			$data['gteacherLevel'] = $pacInfoResult[0]['teacher_type'];
			$data['createTime'] = getTime();

			$result = $inquiry->add($data);
			if($result){
				$message['status'] = true;
				$message['message'] = "添加小班数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "添加小班数据失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*更换小班教材的服务
		*/
		//参数一:小班的班级ID
		//参数二:教材的教材ID
		public function ChangeGroupMaterial($groupID = null,$bookID = null){
			$message = array();
			if(is_null($groupID) || is_null($bookID)){
				$message['status'] = false;
				$message['message'] = "缺乏更换小班教材的必要数据,更换小班教材失败";
				return $message;
			}
			//获取教材的数据
			import("Home.Action.Book.BookBasicOperate");
			$bookBasicOp = new BookBasicOperate();

			//获取对应的教材的信息
			$bookInfo = $bookBasicOp->getoneBookInfo($bookID);

			$data = array();
			$data['material'] = $bookInfo[0]['bookid'].":".$bookInfo[0]['bookname'].":".
				$bookInfo[0]['book_type'];

			$inquiry = new Model("group");
			$result = $inquiry->where("groupID={$groupID}")->save($data);
			if($result){
				$message['status'] = true;
				$message['message'] = "更换小班教材数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "更换小班教材数据失败";
				return $message;
			}
		}

	}
