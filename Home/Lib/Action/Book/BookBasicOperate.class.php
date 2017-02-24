<?php
	class BookBasicOperate extends Action{
		/*
		*俞鹏泽
		*查询教材的信息
		*/
		//参数一:教材ID
		//参数二:要查询的字段,当Field为null时,表示查询所有的字段,如果是string类型的值就查询string中制定的字段,
		//如果是数组就需要提取所有的value值,并组成字符串进行查询
		/*要求:
			1.当$bookID为null返回错误信息
			2.当Field参数是不同的类型值时,进行不同字段的查询
			3.查询的教材必须是存在的
			4.返回查询到的数据
		*/
		public function getoneBookInfo($bookID = null,$Field = null){
			$message = array();
			if(is_null($bookID)){
				$message['status'] = false;
				$message['message'] = "教材ID为空";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*查询所有教材
		*参数一:教材ID,如果bookIDs是null,表示查询所有存在的教材,如果传入的数组,表示查询对应的ID的教材,需要提取教材的value值,并组成条件查询
		*参数二:要查询的字段,当Field为null时,表示查询所有的字段,如果是string类型的值就查询string中制定的字段,
		*如果是数组就需要提取所有的value值,并组成字符串进行查询
		*/
		/*要求:
			1.根据bookIDs的不同值进行不同的查询
			2.根据Field值类型的不同进行查询
			3.查询的教材必须是存在的
			4.返回查询到的数据
		*/
		public function getBookSInfo($bookIDs = null,$Field = null){

		}
		/*
		*俞鹏泽
		*更新套餐的数据
		*参数一:教材的ID号,如果教材的ID为null,就要做错误反馈
		*参数二:要更新的信息,为数组(可以直接save函数调用),如果是null也要做错误信息的反馈
		*/
		/*要求:
			1.根据bookIDs的不同值进行不同的查询
			2.根据Field值类型的不同进行查询
			3.查询的教材必须是存在的
			4.根据更新是否成功,进行不同的反应,使用$message数组,一个值是status,true表示成功,false表示是失败.还有一个message,填写文字提示
		*/
		public function updateBookInfo($bookID = null,$Data = null){

		}
	}
 ?>
