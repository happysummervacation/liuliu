<?php
	class ClassBasicOperate extends Action{
		/*
		*俞鹏泽
		*获取某个教师的课程时间
		*/
		//参数一:教师的ID,只能是单值
		//参数二:要查询的字段
		//参数三:表示是额外的查询条件   只能是字符串的形式
		public function getoneTeacherClassInfo($TeacherID = null,$field = null,$cond = null){
			if(is_null($TeacherID)){
				return null;
			}
			$condition = "";
			$fieldString = "";

			if(is_null($cond)){
				$condition = "teacherID={$TeacherID}";
			}else{
				$condition = "teacherID={$TeacherID} and ".$cond;
			}
			$inquiry = new Model("class");

			if(is_array($field)){
				for ($i = 0; $i < count($field); $i++) {
					if($i == count($field)-1){
						$fieldString = $fieldString."{$field[$i]}";
					}else{
						$fieldString = $fieldString."{$field[$i]},";
					}
				}
				$result = $inquiry->where($condition)->field($fieldString)->select();
				return $result;
			}elseif(is_string($field)){
				$fieldString = $field;
				$result = $inquiry->where($condition)->field($fieldString)->select();
				return $result;
			}else{
				$result = $inquiry->where($condition)->select();
				return $result;
			}
		}

		/*
		*俞鹏泽
		*根据课程ID来获取数据
		*/
		//参数一:要查询的课程ID号
		//参数二:要查询的字段
		public function getClassInfo($classID = null,$field = null){
			if(is_null($classID)){
				return null;
			}
			$fieldString = "";
			$inquiry = new Model("class");

			if(is_array($field)){
				for ($i = 0; $i < count($field); $i++) {
					if($i == count($field)-1){
						$fieldString = $fieldString."{$field[$i]}";
					}else{
						$fieldString = $fieldString."{$field[$i]},";
					}
				}
				$result = $inquiry->where("classID='{$classID}' and isdelete=0")->field($fieldString)->select();
				return $result;
			}elseif(is_string($field)){
				$fieldString = $field;
				$result = $inquiry->where("classID='{$classID}' and isdelete=0")->field($fieldString)->select();
				return $result;
			}else{
				$result = $inquiry->where("classID='{$classID}' and isdelete=0")->select();
				return $result;
			}
		}

		/*
		*俞鹏泽
		*更新课程的数据
		*/
		//参数一:要更新的课程的ID
		//参数二:要更新的数据
		public function updateClassInfo($classID = null,$Data = null){
			$message = array();
			if(is_null($classID) || is_null($Data)){
				$message['status'] = false;
				$message['message'] = "必要的课程数据没有传入";
				return $message;
			}

			$inquiry = new Model("class");
			$result = $inquiry->where("classID='{$classID}' and isdelete=0")->save($Data);

			if($result || 0 == $result){
				$message['status'] = true;
				$message['message'] = "课程数据修改成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "课程数据修改失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*添加新的课程数据
		*/
		//要跟新的数据
		public function addClassInfo($Data = null){

		}

		/*
		*俞鹏泽
		*批量导入教师的课程数据
		*/
		//参数一:要插入的课程数据的字段
		//参数二:要插入的数据类型
		public function batchAddClassInfo($fieldData = null,$Data = null){
			$message = array();
			if(is_null($fieldData) || is_null($Data)){
				$message['status'] = false;
				$message['message'] = "传入的参数有问题";
				return $message;
			}
			/*********    构造批量插入的数据的sql    ******/
			$sql = "insert into tp_class(";
			for ($i = 0; $i < count($fieldData); $i++) {
				if($i == count($fieldData)-1){
					$sql = $sql."`{$fieldData[$i]}`)";
				}else{
					$sql = $sql."`{$fieldData[$i]}`,";
				}
			}

			$sql = $sql." values";
			for($j = 0;$j < count($Data);$j++) {
				$valueString = "(";
				for ($i = 0; $i < count($Data[$j]); $i++) {
					if($i == count($Data[$j])-1){
						$valueString = $valueString."'{$Data[$j][$i]}')";
					}else{
						$valueString = $valueString."'{$Data[$j][$i]}',";
					}
				}

				if($j == count($Data)-1){
					$sql = $sql.$valueString;
				}else{
					$sql = $sql.$valueString.",";
				}
			}
			/*******       ********/
			$inquiry = new Model('class');
			$result = $inquiry->execute($sql);

			if($result){
				$message['status'] = true;
				$message['message'] = "开放课程成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "开放课程失败";
				return $message;
			}
		}
	}
 ?>
