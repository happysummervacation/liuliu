<?php
	class TeacherAction extends Action{
		public function __construct(){
            
        }

		//空操作访问
        public function _empty(){
            echo "访问路径出错";
        }

        public function GetRegisterInfo(){
        	$ID = $_GET['ID'];
        	$check = $_GET['check'];

        	if(md5($ID) != $check){
        		$this->error("路径错误");
        		return;
        	}

        	import("App.Action.Info.InfoOperate");
        	$field = array();
        	array_push($field, "image_path","simplevideo","age","video_path","englishname","introduction");
        	$result = InfoOperate::GetInfoWithID($ID,null,$field);

        	$this->assign("teacherInfo",$result);
        	$this->display("Index:TeacherInfo");
        }

	}
?>
