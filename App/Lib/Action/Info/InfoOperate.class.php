<?php
	class InfoOperate extends Action{
		//参数一是用户的ID，参数二是要获取的数据
		//默认identity的身份是教师
		public static function GetInfoWithID($ID = null,$email = null,$field = null,$identity=1){
			$fieldString = "";

			$inquiry = new Model('register');

			if($field != null){
				for ($i=0; $i < count($field); $i++) {
					if($i == count($field)-1){
						$fieldString = $fieldString.$field[$i];
					}else{
						$fieldString = $fieldString.$field[$i].",";
					}
				}
			}

			if($field != null){
				if(!is_null($ID)){
					$result = $inquiry->field("$fieldString")->where("ID={$ID}")->find();
				}else if(!is_null($email)){
					$result = $inquiry->field("$fieldString")->where("email={$ID}")->find();
				}else{
					$result = $inquiry->field("$fieldString")->where("identity=1")->select();
				}
			}else{
				if(!is_null($ID)){
					$result = $inquiry->where("ID={$ID}")->find();
				}else if(!is_null($email)){
					$result = $inquiry->where("email={$email}")->find();
				}else{
					$result = $inquiry->field("$fieldString")->where("identity=0")->select();
				}
			}

			return $result;
		}
	}