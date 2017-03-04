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
	}

 ?>
