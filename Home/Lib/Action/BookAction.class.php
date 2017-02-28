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
			}elseif($identity == 2 || $identity == "2"){  //admin
				$bookAdminResult = $bookBasicOperate->getBookSInfo();
				$this->assign("bookresult",$bookAdminResult);
				$this->display("Admin:Book");
			}elseif($identity == 1 || $identity == "1"){   //teacher
				$bookResult1 = $bookBasicOperate->getBookSInfo();
				$this->assign("bookresult",$bookResult1);
				$this->display("Teacher:TeachingMaterials");
			}elseif($identity == 0 || $identity == "0"){   //student
				$bookStudentResult = $bookBasicOperate->getBookSInfo();
				$this->assign("bookresult",$bookStudentResult);
				$this->display('Student:MyBook');
				return;
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

		/*
		*俞鹏泽
		*根据订购的套餐的ID来获取对应类型的教材数据
		*/
		public function AjaxGetBookInfoWithOrderClassID(){
			$ajaxResult = judgeAjaxRequest();
			if(!$ajaxResult){
				echo "非指定的访问方式";
				return;
			}

			$identity = $_SESSION['identity'];
			if("2" != $identity && 2 != $identity && 4!=$identity && "4"!=$identity){
				$this->error("你没有权限进行查看");
				return;
			}else{
				//根据返回的订购套餐的ID获取学生订购的套餐的数据
				$orderPackageID = $_POST['ID'];
				import("Home.Action.OrderPackage.OrderPackageBasicOperate");
				$orderPackageOp = new OrderPackageBasicOperate();
				$orderPackageResult = $orderPackageOp->getOrderPackagesInfo($orderPackageID,"category");

				import("Home.Action.Book.BookBasicOperate");
				$bookOp = new BookBasicOperate();
				$sql = "book_type={$orderPackageResult[0]['category']} ";
				$bookResult = $bookOp->getBookInfoWithCondition($sql);

				echo json_encode($bookResult);
			}
		}

		/*
		*俞鹏泽
		*为学生指定教材一对一课程的教材
		*/
		public function selectBookForStudent(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if("2" != $identity && 2 != $identity && 4!=$identity && "4"!=$identity){
				$this->error("你没有权限进行查看");
				return;
			}else{
				//先查询指定的套餐的数据
				import("Home.Action.OrderPackage.OrderPackageBasicOperate");
				$orderPackageOp = new OrderPackageBasicOperate();
				$orderPacCate = $orderPackageOp->getOneOrderPackageInfo($_POST['packageId'],"category");
				$data['material'] = "{$_POST['BookID']}:{$_POST['bookname']}:{$orderPacCate[0]['category']}";
				$result = $orderPackageOp->updateOrderPackageInfo($_POST['packageId'],$data);
				if($result['status']){
					$this->success("教材指定成功");
				}else{
					$this->error("教材指定失败");
				}
			}
		}
	}
 ?>
