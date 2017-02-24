<?php
	class BookBasicService extends Action{
		private $filesType = array(
				'jpg', 'gif', 'png', 'jpeg','pdf','rar','zip','txt','doc','docx','pdf'
				);
		private $filesSize = 52428800;   //1024*1024*50
		private $aboutFiles = array(
			'book'=>'./Book/',
			'book_image'=>'./BookImage/'
			);

		/*陈泽奇
		*$postData是页面的post过来的数据。
		*在这个函数中将post数据和完成上传文件后的数据进行结合
		并交给 BookBasicOperate;
		*/
		public function addBookInfo($postData = null){
			$message = array();
			if(is_null($postData)){
				$message['status'] = false;
				$message['message'] = "没有要添加的数据";
				return $message;
			}
			$result = UploadFiles($this->aboutFiles,$this->filesSize,$this->filesType);  //上传文件

			if($result['status']){
				$data['bookname'] = $postData['book_name'];
				$data['page'] = $postData['page'];
				$data['candownload'] = $postData['can_load'];
				$data['book_type'] = $postData['book_type'];
				$data['isdelete'] = 0;
				$data['download_link'] = '/liuliu/Book/'.$result['message']['0']['savename'];
				$data['bookimagelink'] = '/liuliu/BookImage/'.$result['message']['1']['savename'];
				$data['uploader'] = $_SESSION['ID'];
				$data['create_time'] = getTime();
				import("Home.Action.Book.BookBasicOperate");
				$bookOp = new BookBasicOperate();
				$addResult = $bookOp->addBook($data);
			}else{
				$message['status'] = false;
				$message['message'] = $result['message'];
				return $message;
			}

			if($addResult){
				$message['status'] = true;
				$message['message'] = '添加数据成功';
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = $addResult['message'];
				return $message;
			}
		}

		public function updateBookInfo(){

		}

		public function deleteBookInfo(){

		}
	}
 ?>
