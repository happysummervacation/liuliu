<?php
	/*
	*俞鹏泽
	*该类主要是用来处理关于小班相关的评论操作
	*/
	class GroupCommentBasicService extends Action{
		/*
		*俞鹏泽
		*添加评论数据到数据库中
		*/
		public function AddGroupCommentToDB($Data = null){
			$message = array();
			if(is_null($postData)){
				$message['status'] = false;
				$message['message'] = "传入的数据为空,不能进行数据添加";
				return $message;
			}
			$inquiry = new Model("groupteachercom");
			$result = $inquiry->add($Data);
			if($result){
				$message['status'] = true;
				$message['message'] = "添加评论数据成功";
				$message['other'] = $result;   //该数据表示增加的数据的主键
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "传入的数据为空,不能进行数据添加";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*查询的小班的评论数据
		*/
		public function getGroupCommentInfo($groupTeacherComID = null,$field = null){
			if(is_null($groupClassSchID)){
				return null;
			}
			$fieldString = "";
			$fieldString = transformFieldToFieldString($field);

			$inquiry = new Model("groupteachercom");
			$result = $inquiry->where("groupTeacherComID={$groupTeacherComID}")
			->field("{$fieldString}")
			->select();

			return $result;
		}
	}
