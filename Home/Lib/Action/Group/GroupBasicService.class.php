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
		public function AddGroupService($packageID = null,$groupName = null){
			$message = array();
			if(is_null($packageID)){
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
			// $data['material'] = $bookInfo[0]['bookid'].":".$bookInfo[0]['bookname'].":".
			// 	$bookInfo[0]['book_type'];
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
				$message['other'] = $result;
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

		/*
		蒋周杰
		获取小班的信息
		参数一：小班ID：    根据ID获得具体的单个小班信息
		参数二：小班状态：	可取值为"active" 或者 "ever"
		*/
		public function getGroupClassInfo($groupID = null,$status = null){

			import("Home.Action.GlobalValue.GlobalValue");
			import("Home.Action.GroupClassSch.GroupClassSchCountService");
			$gcsCS = new GroupClassSchCountService();
			$inquiry = new Model("group");

			if(is_null($groupID)){
				//获取多个小班的信息
				$classlist = $inquiry->join("inner join tp_tegroupclasssalary on
					tp_tegroupclasssalary.groupID = tp_group.groupID
					and tp_tegroupclasssalary.gIsLastest = 1
					inner join tp_teacher on
					tp_teacher.ID = tp_tegroupclasssalary.teacherID")->field("tp_group.*,tp_teacher.account")->where("tp_group.isdelete = 0 ")->select();
				$classresult = array();
				foreach ($classlist as $key => $value) {
					//获取每个小班的已上课数，存在haveclass中
					$classlist[$key]['haveclass'] = $gcsCS->countGroupClassWithStatus($value['groupID'],GlobalValue::haveClass);

					if($status == GlobalValue::active){
						//提取还在上课的小班
						if($classlist[$key]['haveclass'] < $value['gclassNumber']+$value['gotherClassNum']){
							array_push($classresult,$classlist[$key]);
						}
					}elseif($status == GlobalValue::ever){
						//提取历史小班
						if($classlist[$key]['haveclass'] >= $value['gclassNumber']+$value['gotherClassNum']){
							array_push($classresult,$classlist[$key]);
						}
					}else{
						array_push($classresult,$classlist[$key]);
					}
				}
			}else{
				//根据ID查询具体某个小班的信息
				$classresult = $inquiry->join("inner join tp_tegroupclasssalary on
					tp_tegroupclasssalary.groupID = tp_group.groupID
					and tp_tegroupclasssalary.gIsLastest = 1
					inner join tp_teacher on
					tp_teacher.ID = tp_tegroupclasssalary.teacherID")->where("isdelete = 0 and groupID = {$groupID}")->field("tp_group.*,tp_teacher.account")->select();
				//获取已上课时
				$classresult = $classresult[0];
				$classresult['haveclass'] = $gcsCS->countGroupClassWithStatus($classresult['groupID'],GlobalValue::haveClass);
			}

			return $classresult;
		}


		/*
		蒋周杰
		获取小班中学生的信息
		参数一：小班的ID
		参数二：学生的状态
				"active" 获取在该小班有未上课程的学生
				"null"获取在该下小班的所有上过课或预约课的学生
		*/
		public function getGroupStudentInfo($groupID = null,$status = null){
			if(is_null($groupID)){
				return null;
			}
			import("Home.Action.GlobalValue.GlobalValue");
			import("Home.Action.GroupStudentClassSch.GroupStuClassCountService");
			$gscCS = new GroupStuClassCountService();
			$inquiry = new Model("groupstuclasssch");

			//获取与这个班有关的全部学生
			$studentlist = $inquiry->distinct(true)
			->field(array('tp_groupstuclasssch.studentID','tp_student.account'))
			->join("inner join tp_student on
				tp_student.ID = tp_groupstuclasssch.studentID")
			->where("tp_groupstuclasssch.groupID = {$groupID} and isdelete = 0")
			->select();

			$studentresult = array();
			foreach ($studentlist as $key => $value) {
				//获取该学生在小班中的已上课程数和课程总数
				$studentlist[$key]['haveclass'] = $gscCS
				->countStuGroupClassWithStatus($groupID,$value['studentID'],null,GlobalValue::haveClass);
				$studentlist[$key]['classNumber'] = $gscCS
				->countStuGroupClassWithStatus($groupID,$value['studentID'],null,GlobalValue::notClass) + $studentlist[$key]['haveclass'];

				if($status == GlobalValue::avtive){
					if($studentlist[$key]['haveclass'] < $studentlist[$key]['classNumber']){
						array_push($studentresult,$studentlist[$key]);
					}
				}else{
					array_push($studentresult,$studentlist[$key]);
				}
			}
			return $studentresult;
		}


		/*
		蒋周杰
		根据套餐ID获取符合该套餐要求的教师列表
		参数一：packageID
		*/

		public function getGroupTeacherList($packageID = null){
			if(is_null($packageID)){
				return null;
			}

			import("Home.Action.Package.PackageBasicOperate");
			$packageBo = new PackageBasicOperate();
			$packageInfo = $packageBo->getPackageInfo($packageID);
			$teacherType = $packageInfo[0]['teacher_type'];
			$classType = $packageInfo[0]['category'];
			$teacherNation = $packageInfo[0]['teacher_nation'];
			$inquiry = new Model("teacher");
			// $result = $inquiry->distinct(true)
			// ->field("englishname,ID")
			// ->join("inner join tp_teoneclasssalary on tp_teoneclasssalary.teacherID = tp_teacher.ID")
			// ->where("tp_teoneclasssalary.scategory = {$classType}
			// 	and tp_teoneclasssalary.teacherType = {$teacherType}
			// 	and tp_teacher.teacher_type = {$teacherNation}")
			// ->select();
			$result = $inquiry
			->where("teacher_type = {$teacherNation} and status = 1")
			->select();
			return $result;
		}

	}
