<?php
	class MoneyBasicOperate extends Action{
		/*
		*俞鹏泽
		*更新学生的账户余额信息      学生的充值,学生的站内扣款都可以使用该函数
		*/
		//参数一:学生ID
		//参数二:学生的账户信息
		//参数三:操作的金额大小
		//这里使用源生的sql语句来进行处理
		public function updateStudentMoney($StudentID = null,$account = null,$money = 0){
			$message = array();
			if(0 == $money){
				$message['status'] = false;
                $message['message'] = "要更新的金额为0";
                return $message;
            }


			$inquiry =new Model();
			$result=false;
			if(!is_null($StudentID)){
				//根据StudentID来更新数据
				$sql="update tp_student set student_sum_money = student_sum_money+{$money} where ID = {$StudentID};";
				$result=$inquiry->execute($sql);
			}elseif(!is_null($account)){
				//根据account更新数据
				$sql="update tp_student set student_sum_money = student_sum_money+{$money} where account = '{$account}';";
				$result=$inquiry->execute($sql);
			}else{
					$message['status'] = false;
               	 	$message['message'] = "不存在的用户！";
                	return $message;
			}

			if($result){
				$message['status'] = true;
				if(0 < $money){
	           	 	$message['message'] = "充值成功！";
				}else{
	       	 		$message['message'] = "购买成功！";
				}
	            return $message;
         	}else{
              	$message['status'] = false;
              	$message['message'] = "操作失败！";
              	return $message;
	        }
		}

		/*陈泽奇
		*第一个参数传入老师的id
		*return查到老师一对一课程表未过期的数据;
		*/
		public function getTeOneClassSalary($teacherID = null)
		{
			$message = array();
			if($teacherID == null){
				return null;
			}else{
				$inquiry = new Model('teoneclasssalary');
				$result = $inquiry
				->join("inner join tp_packageconfig on
				tp_teoneclasssalary.scategory=tp_packageconfig.packageconID")
				->where("teacherID=$teacherID and isLastest=1")
				->select();
				if($result){
					return $result;
				}else{
					return null;
				}
			}
		}

		/*陈泽奇
		*
		**/
		public function addTeOneClassSalary($data = null){
			$message = array();

			if(is_null($data)){
				$message['status'] = false;
				$message['message'] = '缺少所需的数据';
				return $message;
			}else{
				$inquiry = new Model('teoneclasssalary');
				$result = $inquiry->add($data);
				if($result){
					$message['status'] = true;
					$message['message'] = '添加老师一对一价格表成功';
					return $message;
				}else{
					$message['status'] = false;
					$message['message'] = '添加老师一对一价格表失败';
					return $message;
				}
			}
		}

		/*
		*俞鹏泽
		*更新教师的课程以及相应的价格数据
		*/
		public function updateOneClassSalary($oneClassSalaryID = null,$data = null){
			$message = array();
			if(is_null($data) || is_null($oneClassSalaryID)){
				$message['status'] = false;
				$message['message'] = "要更新的数据为空";
				return $message;
			}

			$inquiry = new Model("teoneclasssalary");
			$result = $inquiry->where("teOneClassSalaryID={$oneClassSalaryID}")->save($data);

			if($result || $result == 0){
				$message['status'] = true;
				$message['message'] = "更新教师工资数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "更新教师工资数据失败";
				return $message;
			}
		}
	}
 ?>
