<?php
	class MoneyBasicService extends Action{
		/*
		*俞鹏泽
		*用来处理教师的工资设定的服务
		*/
		//参数一:教师ID
		//参数二:教师工资修改的数据
		public function dealTeacherSalarySetSer($teacherID = null,$Data = null){
			$message = array();
			if(is_null($teacherID) || is_null($Data)){
				$message['status'] = false;
				$message['message'] = "要处理的重要数据为空";
				return $message;
			}

			import("Home.Action.Money.MoneyBasicOperate");
			$moneyOp = new MoneyBasicOperate();
			$inquiry = new Model();
			$inquiry->startTrans();   //开启事务

			$updateData = array();
			$addData = array();

			if(count($Data['update']) != 0){   //更新教师一对一工资的信息,在数据库中是先将原来的数据设置不是最新,再新增一条信息新的数据
				foreach ($Data['update'] as $key => $value) {
					$updateData = array();
					$addData = array();
					$updateData = $this->createUpdateData();
					$updateResult = $moneyOp->updateOneClassSalary($value[0],$updateData);
					$addData = $this->createAddData($teacherID,$value,1);
					$addResult = $moneyOp->addTeOneClassSalary($addData);
					if(!$updateResult['status'] || !$addResult['status']){
						$inquiry->rollback();
						$message['status'] = false;
						$message['message'] = "修改失败";
						return $message;
					}
				}
			}
			if(count($Data['add']) != 0){
				foreach ($Data['add'] as $key => $value) {
					$addData = array();
					$addData = $this->createAddData($teacherID,$value,0);
					$addResult = $moneyOp->addTeOneClassSalary($addData);
					if(!$addResult['status']){
						$inquiry->rollback();
						$message['status'] = false;
						$message['message'] = "修改失败";
						return $message;
					}
				}
			}
			if(count($Data['delete']) != 0){
				foreach ($Data['delete'] as $key => $value) {
					$updateData = array();
					$updateData = $this->createUpdateData();
					$updateResult = $moneyOp->updateOneClassSalary($value[0],$updateData);
					if(!$updateResult['status']){
						$inquiry->rollback();
						$message['status'] = false;
						$message['message'] = "修改失败";
						return $message;
					}
				}
			}
			//如果上面的操作都完成了就表示都操作完成了
			$inquiry->commit();
			$message['status'] = true;
			$message['message'] = "修改成功";
			return $message;
		}
		/*
		*俞鹏泽
		*创建更新教师课程价格的数据
		*/
		private function createUpdateData(){
			$data = array();
			$data['vEndTime'] = getTime();
			$data['isLastest'] = 0;
			return $data;
		}
		/*
		*俞鹏泽
		*创建新增的数据
		*/
		//参数一:教师的ID
		//参数二:要新増的数据
		//参数三:类型,0表示是直接新增的数据,1表示是在更改的数据上进行新增的
		private function createAddData($teacherID = null,$data = null,$type = null){
			if(is_null($teacherID) || is_null($data)){
				return null;
			}

			$addData = array();
			import("Home.Action.GlobalValue.GlobalValue");
			//现在最新的数据的结束时间都是通过GlobalValue中的数据进行获取
			//方便后期计算时的方便
			if($type == 0){
				$addData['teacherID'] = $teacherID;
				$addData['teacherType'] = $data[1];
				$addData['scategory'] = $data[0];
				$addData['price'] = $data[2];
				$addData['vStartTime'] = getTime();
				$addData['vEndTime'] = GlobalValue::initOrderPackageTime;
				return $addData;
			}elseif($type == 1){
				$addData['teacherID'] = $teacherID;
				$addData['teacherType'] = $data[2];
				$addData['scategory'] = $data[1];
				$addData['price'] = $data[3];
				$addData['vStartTime'] = getTime();
				$addData['vEndTime'] = GlobalValue::initOrderPackageTime;
				return $addData;
			}else{
				return null;
			}
		}

		/*
		*蒋周杰
		*获取学生的消费历史
		*参数一：学生ID
		*/
		public function getStudentopaccount($studentID = null){
			if($studentID == null){
				return ;
			}
			$inquiry = new Model('studentopaccount');
			$result = $inquiry->where("student_id = {$studentID}")->select();
			return $result;
		}

		/*
		*俞鹏泽
		*获取教师对应时间的课程情况以及工资情况
		*/
		//参数一:表示教师
		//参数二:表示要查询的查询的课程的状态有那些  多种状态使用   ***:***:***
		//参数三:表示开始时间(时间戳)
		//参数四:表示结束时间
		public function getTeaOneClassSalaryInfo($teacherID = null,$classStatus = null,
		$startTime = null,$endTime = null){
			if(is_null($teacherID) || is_null($classStatus)){
				return null;
			}
			//先获取教师在指定时间内的工资,以及有效时间的的分布情况
			import("Home.Action.Money.TeaSalaryService");
			import("Home.Action.OrderClass.OrderClassCountService");
			import("Home.Action.GlobalValue.GlobalValue");
			$teaSalarySetOp = new TeaSalaryService();
			$orderClassCountOp = new OrderClassCountService();

			//获取查询对应时间的课程,价格分布
			$teaSalarySetResult = $teaSalarySetOp->getTeacherOneClassSalarySet($teacherID,null,
			"teacherType,scategory,packageName,price,vStartTime,vEndTime,isLastest",$startTime,$endTime);

			$classStatus = explode(":",$classStatus);

			foreach ($teaSalarySetResult as $key => $value) {
				//表示要查询几次相应状态的数据结果
				foreach ($classStatus as $c_key => $c_value) {
					$temResult = "";
					$temResult = $orderClassCountOp->countTeaHaveClass($teacherID,$value['scategory'],
					$c_value,$startTime,$endTime);
					$teaSalarySetResult[$key][$c_value] = $temResult;
				}
			}

			return $teaSalarySetResult;
		}

		/*
		*俞鹏泽
		*获取教师对应时间的小班的课程情况以及工资情况
		*/
		//参数一:表示教师
		//参数二:表示要查询的查询的课程的状态有那些  多种状态使用   ***:***:***
		//参数三:表示开始时间(时间戳)
		//参数四:表示结束时间
		public function getTeaGroupClassSalaryInfo($teacherID = null,$classStatus = null,
		$startTime = null,$endTime = null){
			if(is_null($teacherID) || is_null($classStatus)){
				return null;
			}

			import("Home.Action.Money.TeaBasicService");
			import("Home.Action.GlobalValue.GlobalValue");
			import("Home.Action.GroupClassSch.GroupClassSchCountService");
			$teaSalarySetOp = new TeaSalaryService();
			$groupClassCountOp = new GroupClassSchCountService();

			//获取查询对应时间的课程,价格分布
			$teaSalarySetResult = $teaSalarySetOp->getTeacherGroupClassSalarySet($teacherID,
			null,$startTime,$endTime);

			$classStatus = explode(":",$classStatus);

		}

		/*
		*俞鹏泽
		*查询与教师评论工资相关的信息
		*/
		//参数一:表示教师的ID
		//参数二:表示评论的状态,其中的值使用GlobalValue中的值,使用***:***的方式  第一个表示评论的状态,
		//第二表示教师是否需要进行评论,多种添加时使用***:***&***:***
		//参数三:表示查询到开始时间(时间戳)
		//参数四:表示查询的结束时间
		public function getTeaCommentSalaryInfo($teacherID = null,$commentStatus = null,
		$startTime = null,$endTime = null){
			if(is_null($teacherID) || is_null($commentStatus)){
				return null;
			}

			//查询对应时间的评论的分布时间
			import("Home.Action.Comment.TeaCommentRateSetService");
			$teaComRateSetOp = new TeaCommentRateSetService();
			$selectResult = $teaComRateSetOp->getTeacherCommentRateSer($teacherID,null,null,null,
			$startTime,$endTime);

			import("Home.Action.Comment.TeaCommentCountService");
			$teaComCountOp = new TeaCommentCountService();
			//获取对应时间段的评论数据(暂时去除小班的评论数据)
			foreach ($selectResult as $key => $value) {
				$temClassType = "";
				$temCommentType = "";
				$temClassType = explode(":",$value['commenttype'])[0];
				$temCommentType = explode(":",$value['commenttype'])[1];
				if(0 == $temClassType || '0' == $temClassType){  //表示是一对一的评论类型
					$commentStatusResult = $this->createNewCommentStatus($temCommentType,$commentStatus);
					//统计教师完成的评论的数量
					$doneResult = $teaComCountOp->countTeaComment($teacherID,$commentStatusResult,$value['cstarttime'],
					$value['cendtime']);
					//统计教师应该完成的评论的数量
					//获取全部的可能的情况
					$allStatus = $this->createAllCommentStatus($temCommentType);
					$allResult = $teaComCountOp->countTeaComment($teacherID,$allStatus,$value['cstarttime'],
					$value['cendtime']);
					$selectResult[$key]['all'] = $allResult;
					$selectResult[$key]['done'] = $doneResult;
				}elseif(1 == $temClassType || '1' == $temClassType){

				}
			}

			return $selectResult;
		}
		/*
		*俞鹏泽
		*将原来的只有两个条件的字符串转成含有三个条件的字符串
		*/
		//参数一:表示要添加的数据,用来表示评论的类型
		//参数二://参数二:表示评论的状态,其中的值使用GlobalValue中的值,使用***:***的方式  第一个表示评论的状态,
		//第二表示教师是否需要进行评论,多种添加时使用***:***&***:***
		private function createNewCommentStatus($commentType = null,$commentStatus = null){
			if(is_null($commentType) || is_null($commentStatus)){
				return "";
			}

			$tem = explode("&",$commentStatus);
			$returnData = "";
			for ($i = 0; $i < count($tem); $i++) {
				if($i == count($tem)-1){
					$returnData .= $commentType.":".$tem[$i];
				}else{
					$returnData .= $commentType.":".$tem[$i]."&";
				}
			}
			return $returnData;
		}

		/*
		*俞鹏泽
		*获取所有出现的状态
		*/
		//参数一:评论的类型
		private function createAllCommentStatus($commentType = null){
			if(is_null($commentType)){
				return "";
			}

			$returnData = $commentType.":0:0&".$commentType.":1:0&".$commentType.":2:0&".
			$commentType.":0:1&".$commentType.":1:1&".$commentType.":2:1";

			return $returnData;
		}

		/*
		*俞鹏泽
		*用来获取教师某段时间的工资情况
		*/
		//参数一:表示教师的ID
		//参数二:表示限制时间段的开始时间
		//参数三:表示限制时间段的结束时间
		public function getTeaSalaryMainService($teacherID = null,$startTime = null,$endTime = null){
			if(is_null($teacherID)){
				return null;
			}

			import("Home.Action.GlobalValue.GlobalValue");
			//统计一对一的课程情况
			$saResult = $this->getTeaOneClassSalaryInfo($teacherID,
			GlobalValue::haveClass.":".GlobalValue::teaMissClass.":".GlobalValue::teaCancelClass
			,$startTime,$endTime);
			//统计小班的课程情况
			$commentResult = $this->getTeaCommentSalaryInfo($teacherID,
			GlobalValue::teaComment.":".GlobalValue::teaNeedComment."&".GlobalValue::autoComment.":".GlobalValue::teaNotNeedComment,
			$startTime,$endTime);

			$returnData = array();
			array_push($returnData,$saResult,null,$commentResult);  //压入的顺序是一对一的课程情况,小班的课程情况,评论的情况

			return $returnData;
		}
	}
 ?>
