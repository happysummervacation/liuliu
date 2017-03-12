<?php
	/*
	*俞鹏泽
	*该类主要是用来处理与班级课程相关的数据
	*/
	class GroupClassSchBasicService extends Action{
		/*
		*俞鹏泽
		*该函数用来为某个小班课添加某个小班课程课程
		*/
		//参数一:表示小班的ID     只能是单个数据操作
		//参数二:表示要添加的小班的某个教师的时间段ID     只能是单个数据操作
		public function addOneGroupClassInfo($groupID = null,$classID = null){
			$message = array();
			if(is_null($groupID) || is_null($classID)){
				$message['status'] = false;
				$message['message'] = "缺乏生成小班班级课表的必要数据,添加小班班级课表失败";
				return $message;
			}

			$data = array();
			$data['groupID'] = $groupID;
			$data['classID'] = $classID;
			$data['createTime'] = getTime();

			$inquiry = new Model("groupclasssch");
			$result = $inquiry->add($data);

			if($result){
				$message['status'] = true;
				$message['message'] = "添加小班课程表数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "添加小班课程表数据失败";
				return $message;
			}
		}


	}
