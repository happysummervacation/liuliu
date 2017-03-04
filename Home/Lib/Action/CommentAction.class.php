<?php
	class CommentAction extends Action{
		private $systemSet = null;
		public function __construct(){
            //获取系统设置
            $field = array();
            import("Home.Action.System.SystemBasicOperate");
			$sysOp = new SystemBasicOperate();
            $result = $sysOp->getSystemSet();
			$this->systemSet = $result;
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

		/*
		*俞鹏泽
		*教师查看自己的评论
		*/
		public function TeacherCommentManage(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(1 == $identity || "1" == $identity){
				$type = $_GET['type'];
				if("now" == $type){   //表示需要进行评论的数据
					import("Home.Action.Comment.CommentBasicService");
					$comSerOp = new CommentBasicService();
					$result = $comSerOp->getOneNeedToFeedComment($_SESSION['ID']);

					$this->assign("dayComData",$result[0]);
					$this->assign("weekComData",$result[1]);
					$this->assign("monthComData",$result[2]);
					$this->assign("auditionComData",$result[3]);
					$this->display("Teacher:Feedback");
				}elseif("history" == $type){   //表示历史的评论数据
					dump("history");
					$this->display("Teacher:HistoryFeedback");
				}else{
					$this->error("没有该种类型的操作");
					return;
				}
			}else{
				$this->error("你没有权限进行查看");
				return;
			}
		}

		/*
		*俞鹏泽
		*教师评论日评,周评,月评,试听课评论
		*/
		public function TeacherComment(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(1 == $identity || "1" == $identity){
				$commentType = $_POST['comment_type'];
				if("0" == $commentType){
					import("Home.Action.Comment.CommentBasicService");
					$comSerOp = new CommentBasicService();
					$dayCommentResult = $comSerOp->OneClassDayCommentService($_POST,$_SESSION['ID']);
					if($dayCommentResult['status']){
						$this->success("日评上传成功");
					}else{
						$this->error("日评上传失败");
					}
					return;
				}elseif("1" == $commentType){
					import("Home.Action.Comment.CommentBasicService");
					$comSerOp = new CommentBasicService();
					$weekCommentResult = $comSerOp->OneClassWeekCommentService($_POST,$_SESSION['ID']);
					if($weekCommentResult){
						$this->success("周评上传成功");
					}else{
						$this->error("周评上传失败");
					}
					return;
				}elseif("2" == $commentType){
					import("Home.Action.Comment.CommentBasicService");
					$comSerOp = new CommentBasicService();
					$monthCommentResult = $comSerOp->OneClassMonthCommentService($_POST,$_SESSION['ID']);
					if($monthCommentResult){
						$this->success("月评上传成功");
					}else{
						$this->error("月评上传失败");
					}
					return;
				}elseif("3" == $commentType){

				}else {
					$this->error("没有该种类型的评论");
					exit;
				}
			}else{
				$this->error("你没有权限进行查看");
				return;
			}
		}

		/*
		*俞鹏泽
		*教师上传自己的课程笔记
		*/
		public function teacherUploadNote(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(1 == $identity || "1" == $identity){
				import("Home.Action.OrderClass.OrderClassBasicOperate");
				$orderClassOp = new OrderClassBasicOperate();
				$data['note'] = $_POST['file'];
				$result = $orderClassOp->updateOneOrderClassInfo($_POST['orderclassID'],$data);
				if($result['status']){
					$this->success("教师上传笔记成功");
				}else{
					$this->error("教师上传笔记失败");
				}
				return;
			}else{
				$this->error("你没有权限进行操作");
			}
		}
	}

 ?>
