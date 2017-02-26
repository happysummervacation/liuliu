<?php
	class OrderPackageBasicOperate extends Action{
		/*
		*俞鹏泽
		*获取订购套餐的中的信息
		*/
		//参数一:要获取信息的订购的套餐的ID号,如果是null表示查询所有的订购的套餐
		//参数二:要获取套餐的字段,类型是数组,string,和null
		//参数三:表示是否获取删除的套餐数据,0表示没有删除的,1表示删除的,2.表示全部
		public function getOneOrderPackageInfo($orderPackageID = null,$field = null,$isdelete = 0){
			$fieldString = "";
			$condition = "";
			if(!is_null($field)){
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
					return false;
				}
			}

			if($isdelete == 0){
				$condition = " isdelete=0 ";
			}elseif($isdelete == 1){
				$condition = " isdelete=1 ";
			}else{
				$condition = " 1=1 ";
			}

			$inquiry = new Model('orderpackage');
			if(is_null($orderPackageID)){
				if(is_null($field)){
					$result = $inquiry->where("{$condition}")->select();
				}else{
					$result = $inquiry->where("{$condition}")->field($fieldString)->select();
				}
			}else{
				if(is_null($field)){
					$result = $inquiry->where("orderpackageID={$orderPackageID} and {$condition}")->select();
				}else{
					$result = $inquiry->where("orderpackageID={$orderPackageID} and {$condition}")->field($fieldString)->select();
				}
			}

			return $result;
		}


		/*
		*俞鹏泽
		*获取多种订购的套餐
		*/
		//参数一:订购的套餐的ID,可以是数组,也可以是单值,也可以是null
		//参数二:要查询的字段
		//参数三:是否是删除的套餐  0表示没有删除的,1表示删除的,2.表示全部
		//参数四:表示是否是有效的
		public function getOrderPackagesInfo($orderPackageID = null,$field = null,$isdelete = 0){
			$fieldString = "";
			$condition = "";

			if(!is_null($field)){
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
					return false;
				}
			}

			if(!is_null($orderPackageID)){
				if(is_array($orderPackageID)){
					$condition = "(";
					for ($i = 0; $i < count($orderPackageID); $i++) {
						if($i == count($orderPackageID)-1){
							$condition = $condition." orderpackageID={$orderPackageID[$i]}".") and ";
						}else{
							$condition = $condition." orderpackageID={$orderPackageID[$i]}"." or ";
						}
					}
				}else{
					$condition = "orderpackageID=".$orderPackageID." and ";
				}
			}

			if($isdelete == 0){
				$condition = $condition." isdelete=0";
			}elseif($isdelete == 1){
				$condition = $condition." isdelete=1";
			}else{
				$condition = $condition." 1=1";
			}

			$inquiry = new Model("orderpackage");

			if(is_null($field)){
				$result = $inquiry->where($condition)->select();
			}else{
				$result = $inquiry->where($condition)->field($fieldString)->select();
			}

			return $result;
		}

		/*
		*俞鹏泽
		*添加套餐的数据
		*/
		public function addOrderPakcageInfo($Data = null){
			$message = array();

			if(is_null($Data)){
				$message['status'] = false;
				$message['message'] = "没有要添加的数据";
				return $message;
			}

			$inquiry = new Model("orderpackage");

			$result = $inquiry->add($Data);

			if($result){
				$message['status'] = true;
				$message['message'] = "添加订购套餐数据成功";
				$message['data'] = $result;    //表示的是新增的主键
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "添加订购套餐数据失败";
				return $message;
			}
		}

		public function updateOrderPackageInfo($orderPackageID = null,$Data = null){
			$message = array();
			if(is_null($orderPackageID)){
				$message['status'] = false;
				$message['message'] = "没有指定要更新的套餐的位置";
				return $message;
			}
			if(is_null($Data)){
				$message['status'] = false;
				$message['message'] = "没有指定要更新的套餐的数据";
				return $message;
			}

			$inquiry = new Model("orderpackage");

			$result = $inquiry->where("orderpackageID={$orderPackageID}")->save($Data);

			if($result || $result == 0){
				$message['status'] = true;
				$message['message'] = "添加订购套餐数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "添加订购套餐数据失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*获取学生还是有效状态的套餐数据
		*/
		//参数一:学生的ID
		//参数二:学生的账号
		//参数三:要查询的字段,   null,string,也可以是数组
		public function getStuActiveOrderPackageInfo($StudentID = null,$Field = null){
			$fieldString = "";
			if(is_array($Field)){
				for ($i = 0; $i < count($Field); $i++) {
					if($i == count($Field)-1){
						$fieldString = $fieldString.$Field[$i];
					}else{
						$fieldString = $fieldString.$Field[$i].",";
					}
				}
			}elseif(is_string($Field)){
				$fieldString = $Field;
			}else{
				$fieldString = null;
			}

			$inquiry = new Model("orderpackage");
			if(!is_null($StudentID)){
				if(!is_null($fieldString)){
					$result = $inquiry->table('tp_orderpackage,tp_packageconfig')
					->where("tp_orderpackage.category = tp_packageconfig.packageconID
					and tp_orderpackage.studentID = {$StudentID} and status=1")->field($fieldString)->select();
				}else{
					$result = $inquiry->table('tp_orderpackage,tp_packageconfig')
					->where("tp_orderpackage.category = tp_packageconfig.packageconID
					and tp_orderpackage.studentID = {$StudentID} and status=1")->select();
				}
				return $result;
			}else{
				return null;
			}
		}
	}
 ?>
