<?php
	class VideoBasicService extends Action{
		private $videoType = array('mp4', 'avi','flv','wmv');
		private $fileSize = 104857600;
		private $videoPath = './Video/';
		/*上传介绍视频
		*/
		//参数一：上传者的ID
		//参数二：上传视频的类型，0为simplevideo  1为video_path
		public function addIntroductionVideo($uploader = null,$type = null){
			$message = array();
			if(is_null($uploader)){
				$message['status'] = false;
				$message['message'] = "该用户不存在！";
				return $message;
			}
			if(is_null($type)){
				$message['status'] = false;
				$message['message'] = "未指定视频类型！";
				return $message;
			}

			$filePath = null;
			$filePath = UploadOneFile($this->videoPath,$this->fileSize,$this->videoType);


			if(!$filePath['status']){
				$message['status'] = false;
				$message['message'] = "用户要更新的数据失败";
				return $message;
			}

			$data = array();
			if (1 == $type) {
				$data['video_path'] = '/liuliu'.explode(".",$filePath['message'][0]['savepath'])[1].$filePath['message'][0]['savename'];
			}else{
				$data['simplevideo'] = '/liuliu'.explode(".",$filePath['message'][0]['savepath'])[1].$filePath['message'][0]['savename'];
			}
			$inquiry = new Model('teacher');
			$result = $inquiry->where("ID={$uploader}")->save($data);

			 if($result){
                $message['status'] = true;
                $message['message'] = "视频上传成功";
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "视频上传失败";
                return $message;
            }
		}
	}
 ?>
