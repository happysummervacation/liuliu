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
			if($type == 0){
				$addData['teacherID'] = $teacherID;
				$addData['teacherType'] = $data[1];
				$addData['scategory'] = $data[0];
				$addData['price'] = $data[2];
				$addData['vStartTime'] = getTime();
				return $addData;
			}elseif($type == 1){
				$addData['teacherID'] = $teacherID;
				$addData['teacherType'] = $data[2];
				$addData['scategory'] = $data[1];
				$addData['price'] = $data[3];
				$addData['vStartTime'] = getTime();
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
	}
 ?>
