<?php
	class BookAction extends Action{
		public function __construct(){
            //获取系统设置
            // $field = array();
            // array_push($field, "studentcancelrate");
            // import("Home.Action.System.SystemOperate");
            // $result = SystemOperate::GetSystemSet($field);
            // $this->CancelClassRate = $result['studentcancelrate'];
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
		*显示各个用户的教材
		*/
		public function showBookInfo(){
			$this->CheckSession();

			import("Home.Action.Book.BookBasicOperate");
			import("Home.Action.Package.PackageConfigBasicOperate");
			$configOp = new PackageConfigBasicOperate();
			$bookBasicOperate = new BookBasicOperate();

			$identity = $_SESSION['identity'];
			if($identity == 4 || $identity == "4"){      //root
				$bookResult = $bookBasicOperate->getBookSInfo();
				$result = $configOp->getPackageConfigInfo();
				$this->assign("packageConfig",$result);
				$this->assign("bookresult",$bookResult);
				$this->display("Root:MaterialManage");
			}elseif($identity == 2 || $identity = "2"){  //admin

			}elseif($identity == 1 || $identity == "1"){   //teacher

			}elseif($identity == 0 || $identity == "0"){   //student

			}else{
				$this->error("用户身份错误");
			}
		}

		/*
		*俞鹏泽
		*关于教材的各个操作
		*/
		public function bookManage(){
			$this->CheckSession();

			$type = $_GET['type'];

			import("Home.Action.Book.BookBasicService");
			$bookSer = new BookBasicService();

			$identity = $_SESSION['identity'];
			if($identity == 4 || $identity == "4"){
				if($type == "add"){
					$result = $bookSer->addBookInfo($_POST);
					if($result['status']){
						$this->success($result['message']);
					}else{
						$this->error($result['message']);
					}
					return;
				}elseif($type == "update"){

				}elseif($type == "delete"){

				}else{
					$this->error("非制定操作类型");
				}
			}else{
				$this->error("你没有权限操作");
			}
		}
	}
 ?>
