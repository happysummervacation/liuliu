<?php
	class StudentAccountOp extends Action{
		/*
		*俞鹏泽
		*添加一条学生的金额操作的记录到指定的数据库表中去
		*/
		//参数一:表示要记录的信息
		public function addStudentAccountOpRecord($Data = null){
			$message =array();

			if(is_null($Data)){
				$message['status'] = false;
				$message['message'] = '没有所需要的数据';
				return $message;
			}else{
				$inquiry = new Model('studentopaccount');

				$result = $inquiry->add($Data);

				if($result){
					$message['status'] = true;
					$message['message'] = '添加金额操作的记录成功';
					return $message;
				}else{
					$message['status'] = false;
					$message['message'] = '添加金额操作的记录失败';
					return $message;
				}
			}
		}
	}
 ?>
