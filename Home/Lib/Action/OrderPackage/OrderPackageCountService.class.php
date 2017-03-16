<?php
	/*
	*俞鹏泽
	*该类专门用来统计各种条件的订购的套餐
	*/
	class OrderPackageCountService extends Action{
		/*
		蒋周杰
		统计学生可用套餐的剩余课时
		参数一：学生ID
		*/
		public function getPackageClassNum($studentID){
			if(is_null($studentID)){
				return null;
			}
			//查询出所有该学生的有效未删除的课时套餐
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			$opBO = new OrderPackageBasicOperate();
			$result = $opBO->getStuActiveOrderPackageInfo($studentID);

			$classSum = 0;
			//累计其课时总数
			foreach ($result as $key => $value) {
				$classSum +=  ((int)$value['classNumber']+(int)$value['otherClass']);
			}

			//统计学生预定的课时数
			import("Home.Action.OrderClass.OrderClassCountService");
			$ocCS = new OrderClassCountService();
			$haveclass = $ocCS->countStudentHaveClassNum($studentID);

			return $classSum - $haveclass[0]['num'];
		}

		/*
		蒋周杰
		得到可用套餐的数量
		参数一：学生ID
		*/
		public function getPackageNum($studentID){
			if(is_null($studentID)){
				return null;
			}

			$inquiry = new Model();
			$sql = "select count(status=1 or null) as num
			from tp_orderpackage
			where isdelete=0 and studentID = {$studentID}";
			$num = $inquiry->query($sql);
			return $num[0]['num'];
		}

		/*
		蒋周杰
		获取小班套餐已用课时（0 1）
		参数一：套餐ID
		*/
		public function getGroupPackagehaveclass($orderPackageID = null){
			if(is_null($orderPackageID)){
				return null;
			}

			$inquiry = new Model();
			$sql = "select count(stuClassStatus = 0 or stuClassStatus = 1 or null) as num
			from tp_groupstuclasssch
			where orderPackageID = {$orderPackageID}";

			$result = $inquiry->query($sql);
			return $result[0]['num'];
		}


	}
