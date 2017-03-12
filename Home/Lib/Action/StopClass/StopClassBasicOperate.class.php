<?php
	class StopClassBasicOperate extends Action{
		/*
		*俞鹏泽
		*获取某个学生的停课信息
		*/
		//参数一:学生的ID,只能是单值
		//参数二:表示要查询的字段,可以是array,string,null
		//参数三:表示额外的查询条件
		public function getStudentStopTime($studentID = null,$field = null,$condition = null){
			if(is_null($studentID)){
				return null;
			}

			$fieldString = "";
			if(is_array($field)){
				for ($i = 0; $i < count($field); $i++) {
					if($i == count($field)-1){
						$fieldString = $fieldString.$field[$i];
					}else{
						$fieldString = $fieldString.$field[$i].",";
					}
				}
			}elseif(is_string($field)){
				$fieldString = $field;
			}else{
				;
			}

			$inquiry = new Model("stopclass");
			if(is_null($field)){
				if(is_null($condition)){
					$result = $inquiry->where("isdelete=0 and studentID={$studentID} ")->select();
				}else{
					$result = $inquiry->where("isdelete=0 and studentID={$studentID} ".$condition)->select();
				}
			}else{
				if(is_null($condition)){
					$result = $inquiry->where("isdelete=0 and studentID={$studentID} ")
					->field("{$fieldString}")->select();
				}else{
					$result = $inquiry->where("isdelete=0 and studentID={$studentID} ".$condition)
					->field("{$fieldString}")->select();
				}
			}
			return $result;
		}
	}
