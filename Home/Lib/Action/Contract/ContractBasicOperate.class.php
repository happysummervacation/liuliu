<?php
	/*
	*该类主要用来处理关于合同的增删该查
	*/
	class ContractBasicOperate extends Action{
		/*
		*俞鹏泽
		*新增一个合同数据
		*/
		//参数一:要添加的合同的数据
		public function addContract($Data = null){
			$message = array();

			if(is_null($Data)){
				$message['status'] = false;
				$message['message'] = '没有要添加所需要的数据';
				return $message;
			}else{

				$inquiry = new Model('studentcontract');
				$result = $inquiry->add($Data);

				if($result){
					$message['status'] = true;
					$message['message'] = '添加成功';
					return $message;
				}else{
					$message['status'] = false;
					$message['message'] = '添加失败';
					return $message;
				}
			}
		}

		/*
		*俞鹏泽
		*根据相应的套餐信息获取对应的合同的信息
		*/
		public function getStudentContractWithCondition($orderPackageID = null,$studentID = null,
		$field = null){
			if(is_null($orderPackageID) || is_null($studentID)){
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
			$inquiry = new Model('studentcontract');
			if(is_null($field)){
				$result = $inquiry->where("orderpackageID={$orderPackageID} and order_party={$studentID}")
				->select();
			}else{
				$result = $inquiry->where("orderpackageID={$orderPackageID} and order_party={$studentID}")
				->field("{$fieldString}")->select();
			}

			return $result;
		}

		/*
		*俞鹏泽
		*进行合同的更新操作
		*/
		public function updateStudentContract($studentContractID = null,$Data = null){
			$message = array();
			if(is_null($studentContractID) || is_null($Data)){
				$message['status'] = false;
				$message['message'] = "要更新的必要数据不全";
				return $message;
			}

			$inquiry = new Model("studentcontract");
			$result = $inquiry->where("ordercontractID={$studentContractID}")->save($Data);
			if($result || $result == 0){
				$message['status'] = true;
				$message['message'] = "签署合同的数据更新成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "更新签署合同的数据失败";
				return $message;
			}
		}

		/*蒋周杰
		*根据学生ID获取该学生合同的全部信息
		*/
		public function getStudentContract($studentID = null,$Field = null){
			if(is_null($studentID)){
				return null;
			}
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
				;
			}
			$inquiry = new Model('studentcontract');
			if(is_null($Field)){
				$result = $inquiry->where("order_party = {$studentID}")->select();
			}else{
				$result = $inquiry->where("order_party = {$studentID}")->field($fieldString)->select();
			}

			return $result;
		}
	}
 ?>
