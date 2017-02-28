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
			$fieldString = "(";

			if(!is_null($Field)){
				for ($i=0; $i < count($Field); $i++) {
					if($i == count($Field)-1){
						$fieldString = $fieldString.$Field[$i].")";
					}else{
						$fieldString = $fieldString.$Field[$i]." or ";
					}
				}
			}

			if(is_null($bookID)){
				$message['status'] = false;
				$message['message'] = "教材ID为空";
				return $message;
			}else{
				$book = new Model('book');
				if(is_null($Field)){
					$result = $book->join("inner join tp_packageconfig on tp_book.book_type=tp_packageconfig.packageconID and isdelete=0")
					->where("bookid = $bookID")->select();
				}else{
					$result = $book->join("inner join tp_packageconfig on tp_book.book_type=tp_packageconfig.packageconID and isdelete=0")
					->where("bookid = $bookID")->filed($fieldString)->select();
				}
			}
			return $result;
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
			$condition = "(";
			$fieldString = "(";

			if(is_array($bookIDs)){
				for ($i = 0; $i < count($bookIDs); $i++) {
					if($i == count($bookIDs)-1){
						$condition = $condition."package_id=".$bookIDs[$i].")";
					}else{
						$condition = $condition."package_id=".$bookIDs[$i]." or ";
					}
				}
			}elseif(is_numeric($bookIDs) || is_string($bookIDs)){
				$condition = "bookid=".$bookIDs;
			}else{
				$condition = null;
			}

			if(!is_null($Field)){
				for ($i=0; $i < count($Field); $i++) {
					if($i == count($Field)-1){
						$fieldString = $fieldString.$Field[$i].")";
					}else{
						$fieldString = $fieldString.$Field[$i].",";
					}
				}
			}

			$inquiry = new Model('book');
			if(is_null($bookIDs)){
				if(is_null($Field)){
					$result = $inquiry
					->join("inner join tp_packageconfig on tp_book.book_type=tp_packageconfig.packageconID and isdelete=0")
					->select();
				}else{
					$result = $inquiry
					->join("inner join ty_packageconfig on tp_book.book_type=tp_pakcageconfig.packageconID and isdelete=0")
					->field($fieldString)->select();
				}
			}else{
				if(is_null($fieldString)){
					$result = $inquiry
					->join("inner join tp_packageconfig on tp_book.book_type=tp_packageconfig.packageconID and isdelete=0")
					->where($condition)->select();
				}else{
					$result = $inquiry
					->join("inner join tp_packageconfig on tp_book.book_type=tp_packageconfig.packageconID and isdelete=0")
					->where($condition)->field($fieldString)->select();
				}
			}
			return $result;
		}

		/*
		*俞鹏泽
		*根据一定条件获取教材的数据
		*/
		//参数一:要查询的额外的查询条件
		//参数二:要查询的字段信息
		public function getBookInfoWithCondition($sql = null,$Field = null){
			$fieldString = "";
			if(is_array($Field)){
				for ($i=0; $i < count($Field); $i++) {
					if($i == count($Field)-1){
						$fieldString = $fieldString.$Field[$i].")";
					}else{
						$fieldString = $fieldString.$Field[$i].",";
					}
				}
			}elseif(is_string($Field)){
				$fieldString = $Field;
			}else{
				$fieldString = null;
			}

			$inquiry = new Model("book");
			if(is_null($fieldString)){
				if(is_null($sql)){
					$result = $inquiry->where("isdelete=0")->select();
				}else{
					$result = $inquiry->where("{$sql} and isdelete=0")->select();
				}
			}else{
				if(is_null($sql)){
					$result = $inquiry->where("isdelete=0")->field($fieldString)->select();
				}else{
					$result = $inquiry->where("{$sql} and isdelete=0")->field($fieldString)->select();
				}
			}
			return $result;
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
			if(is_null($bookID)){
				$message['status'] = false;
				$message['message'] = "教材ID为空";
				return $message;
			}elseif(is_null($Data)){
				$message['status'] = false;
				$message['message'] = "教材信息为空";
			}else{
				$book = new Model('book');
				$result = $book->where("bookid = $bookID")->save($Data);
			}

			if($result || $result == 0){
				$message['status'] = true;
				$message['message'] = "更新教材数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "更新教材数据失败";
				return $message;
			}
		}

		/*
		*陈泽奇
		*添加教材
		*参数：$Data是一个数组，在这个函数中直接完成添加即可；
		*/
		public function addBook($Data = null){
			$inquiry = new Model('book');
			if($Data == null){
				$message['status'] = false;
				$message['message'] = '没有收到要添加的数据';
				return $message;
			}else{
				$result = $inquiry->add($Data);
			}

			if($result){
				$message['status'] = true;
				$message['message'] = "添加教材数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "添加教材数据失败";
				return $message;
			}
		}
	}
 ?>
