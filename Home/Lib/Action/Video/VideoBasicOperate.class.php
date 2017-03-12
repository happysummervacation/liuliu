<?php
	class VideoBasicOperate extends Action{
		/*获取教学视频的信息
		*/
		//参数一:查询条件  字符串
		//参数二:过滤信息  字符串，数组，null
		public function getVideoInfo($con = null,$Field = null){
				$fieldString = "";
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

				$inquiry = new Model('video');
				if(null == $con ){
					if(null == $Field){
						$result = $inquiry->where("isdelete = 0")->select();
					}else{
						$result = $inquiry->where("isdelete = 0")->field($fieldString)->select();
					}
				}else{
					if(null == $Field){
						$result = $inquiry->where($con." and isdelete = 0")->select();
					}else{
						$result = $inquiry->where($con." and isdelete = 0")->field($fieldString)->select();
					}
				}
				return $result;
		}

		/*增添教学视频信息
		*/
		//参数一:上传者的ID
		//参数二:视频信息
		public function addVideoInfo($uploader = null,$Data = null){
			$message = array();
			if(is_null($uploader)){
				$message['status'] = false;
				$message['message'] = "该用户不存在！";
				return $message;
			}
			if(is_null($Data['download_link'])){
				$message['status'] = false;
				$message['message'] = "上传的数据不齐全！";
				return $message;
			}

			$Data['uploader'] = $uploader;
			$Data['create_time'] = getTime();
			$Data['isdelete'] = 0;

			$inquiry = new Model('video');
			$result = $inquiry->add($Data);
            if($result){
                $message['status'] = true;
                $message['message'] = "视频上传成功！";
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "视频上传失败";
                return $message;
            }


		}


		/*删除教学视频
		*/
		//参数一:要删除的视频信息
		public function deleteVideoInfo($videoId = null){
			$message = array();
			if(is_null($videoId)){
                $message['status'] = false;
                $message['message'] = "不存在的视频！";
                return $message;
            }

             $inquiry = new Model('video');
             $Data = array();
             $Data['isdelete'] = 1;
             $result = $inquiry->where("video_id={$videoId}")->save($Data);

             if($result){
                $message['status'] = true;
                $message['message'] = "视频删除成功";
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "视频删除失败";
                return $message;
            }
		}
		/*更新教学视频
		*参数一：视频ID
		*参数二:视频信息
		*/
		public function updateVideoInfo($videoId = null,$Data = null){
			$message = array();
            if(is_null($Data)){
                $message['status'] = false;
                $message['message'] = "视频的更新数据为空";
                return $message;
            }
            if(is_null($videoId)){
                $message['status'] = false;
                $message['message'] = "不存在的视频！";
                return $message;
            }

            $inquiry = new Model('video');
            $result = $inquiry->where("video_id={$videoId}")->save($Data);

            if($result){
                $message['status'] = true;
                $message['message'] = "视频更新成功";
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "视频更新失败";
                return $message;
            }
		}
	}
 ?>
