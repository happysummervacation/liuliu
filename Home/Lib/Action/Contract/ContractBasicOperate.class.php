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

	}
 ?>
