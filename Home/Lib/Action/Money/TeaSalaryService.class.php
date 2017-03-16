<?php
	/*
	*俞鹏泽
	*该类主要是用来处理教师相关的操作,主要用于控制器,Action的操作
	*/
	class TeaSalaryService extends Action{
		/*
		*俞鹏泽
		*查找某教师在指定时间内的薪水设定分布
		*/
		//参数一:表示是哪个教师
		//参数二:表示所上的课程类型  [暂时不支持课程类该数据]
		//参数三:表示要查询哪些字段
		//参数四:表示指定时间的开始时间(时间戳)
		//参数五:表示指定时间的结束时间
		public function getTeacherOneClassSalarySet($teacherID = null,$classType = null,$field = null,
		$startTime = null,$endTime = null){
			if(is_null($teacherID)){
				return null;
			}
			// $classTypeString = " and 1=1";
			$fieldString = "";
			$fieldString = transformFieldToFieldString($field);

			$inquiry = new Model("teoneclasssalary");
			if(is_null($startTime) || is_null($endTime)){
				$result = $inquiry
				->join("inner join tp_packageconfig on tp_packageconfig.packageconID=
				tp_teoneclasssalary.scategory")
				->where("teacherID={$teacherID}")
				->field("{$fieldString}")
				->select();
			}else{
				$result = $inquiry
				->join("inner join tp_packageconfig on tp_packageconfig.packageconID=
				tp_teoneclasssalary.scategory")
				->where("teacherID={$teacherID} and
				((vStartTime>={$startTime} and vEndTime<={$endTime}) ||
				(vStartTime<={$startTime} and vEndTime>={$startTime}) ||
				(vStartTime<={$endTime} and vEndTime>={$endTime}))")
				->field("{$fieldString}")
				->select();
			}
			return $result;
		}

		/*
		*俞鹏泽
		*查找某教师在指定时间内的小班课的薪水设定分布
		*/
		//参数一:表示是哪个教师
		//参数二:表示要查询哪些字段
		//参数三:表示指定时间的开始时间(时间戳)
		//参数四:表示指定时间的结束时间
		public function getTeacherGroupClassSalarySet($teacherID = null,$field = null,
		$startTime = null,$endTime = null){
			if(is_null($teacherID)){
				return null;
			}
			// $classTypeString = " and 1=1";
			$fieldString = "";
			$fieldString = transformFieldToFieldString($field);

			$inquiry = new Model("tegroupclasssalary");
			if(is_null($startTime) || is_null($endTime)){
				$result = $inquiry
				->join("inner join tp_group on tp_group.groupID=tp_tegroupclasssalary.groupID")
				->where("teacherID={$teacherID}")->field("{$fieldString}")->select();
			}else{
				$result = $inquiry
				->join("inner join tp_group on tp_group.groupID=tp_tegroupclasssalary.groupID")
				->where("teacherID={$teacherID} and
				((gStartTime>={$startTime} and gEndTime<={$endTime}) ||
				(gStartTime<={$startTime} and gEndTime>={$startTime}) ||
				(gStartTime<={$endTime} and gEndTime>={$endTime}))")
				->field("{$fieldString}")->select();
			}

			return $result;
		}

		/*
		蒋周杰
		为一个教师新增一条小班课薪资数据（可用于更新教师小班课薪资）
		参数一：教师ID
		参数二：小班ID
		参数三：金额
		*/
		public function addGroupClassSalary($teacherID = null,$groupID = null,$price = null){
			$message = array();
			if(is_null($teacherID) || is_null($groupID) || is_null($price)){
				$message['status'] = fales;
				$message['message'] = "缺少必要数据！";
			}
			//查询是否有薪资记录，有则更新原数据的信息
			$data['gEndTime'] = getTime();
			$data['gIsLastest'] = 0;
			$inquiry = new Model("tegroupclasssalary");
			$updateresult = $inquiry->where("teacherID = {$teacherID} and groupID = {$groupID}")
			->save($data);
			//添加现在的信息
			import("Home.Action.GlobalValue.GlobalValue");
			$data['gEndTime'] = GlobalValue::initOrderPackageTime;
			$data['gStartTime'] = getTime();
			$data['teacherID'] = $teacherID;
			$data['groupID'] = $groupID;
			$data['price'] = $price;
			$data['gIsLastest'] = 1;
			$result = $inquiry->add($data);

			if($result){
                $message['status'] = true;
                $message['message'] = "用户数据增添成功";
                $message['classID'] = $result;
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "用户数据增添失败";
                return $message;
            }
		}
	}
