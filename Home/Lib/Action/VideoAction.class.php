<?php
	class VideoAction extends Action{
		public function __construct(){
            //获取系统设置
            // $field = array();
            // import("Home.Action.System.SystemBasicOperate");
			// $sysOp = new SystemBasicOperate();
            // $result = $sysOp->getSystemSet();
			// $this->systemSet = $result;
        }

		//空操作访问
        public function _empty(){
            echo "访问路径出错";
        }

		//不仅要查看登录的用户名，还要查看登录者的身份
	    public function CheckSession(){
			if(isset($_SESSION['account']) && $_SESSION['account']!='' && !is_null($_SESSION['identity'])){
				;
			}else{
				$this->error('请先登录',U('Login/Login'));
				return;
			}
		}

		public function showVideoInfo(){
			$this->CheckSession();
			$identity = $_SESSION['identity'];


			if(1 == $identity){
				$type = $_GET['type'];
				if('history' == $type){
					import("Home.Action.Video.VideoBasicOperate");
					$videoOp = new VideoBasicOperate();
					$id =$_SESSION['ID'];
					$result = $videoOp->getVideoInfo("uploader = $id",null);
					$this->assign('video_result',$result);
					$this->display("Teacher:UploadedVideos");
				}elseif('updateVideo' == $type){
					$this->display("Teacher:UploadNow");
				}elseif('updateIntroduction' == $type){
					$this->display("Teacher:UploadIntroductionVideo");
				}
			}elseif(4 == $identify){

			}else{
				$this->error('你无权访问该界面！');
			}
		}
		/*
		*蒋周杰
		*上传教学视频信息
		*/
		public function uploadVideo(){
			$this->CheckSession();
			$identity = $_SESSION['identity'];
			if(1 == $identity){
				import("Home.Action.Video.VideoBasicOperate");
				$videoOp = new VideoBasicOperate();
				$result = $videoOp->addVideoInfo($_SESSION['ID'],$_POST);
				if($result['status']){
					$this->success($result['message']);
				}else{
					$this->error($result['message']);
				}
			}else{
				$this->error('你无权访问该界面！');
			}
		}

		/*
		*蒋周杰
		*上传介绍视频
		*/
		public function uploadIntroductionVideo(){
			$this->CheckSession();

			if(is_null($_FILES)){
				$this->error('未添加视频!');
			}
			$identity = $_SESSION['identity'];
			import("Home.Action.Video.VideoBasicService");
			$videoOp = new VideoBasicService();
			if(1 == $identity || "1" == $identity){
				$result = $videoOp->addIntroductionVideo($_SESSION['ID'],1);
				if($result['status']){
					$this->success($result['message']);
				}else{
					$this->error($result['message']);
				}
			}elseif(4 == $identity || "4" == $identity){
				$result = $videoOp->addIntroductionVideo($_GET['ID'],0);
				if($result['status']){
					$this->success($result['message']);
				}else{
					$this->error($result['message']);
				}
			}else{
				$this->error('你无权访问该界面！');
			}
		}

	}

 ?>
