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

		//这个金额小于0还没有测试过         --------------------->>>估计是有问题的
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
	}
 ?>
