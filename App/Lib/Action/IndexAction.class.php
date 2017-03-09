<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		$this->display();
    }
    public function aboutUs(){
    	$this->display();
    }
    public function teachingSystem(){
    	$this->display();
    }
    /*
    *俞鹏泽
    *获取教师的数据
    */
    public function teachers(){
        import("App.Action.Info.InfoOperate");
        $field = array();
        array_push($field, "ID","country","teachercomment","image_path","englishname");
        $result = InfoOperate::GetInfoWithID(null,null,$field);
// dump($result);
// exit;
        $this->assign("teacherInfo",$result);
    	$this->display();
    }
    public function childEng(){
    	$this->display();
    }
    public function price(){
    	$this->display();
    }
    public function publicClass(){
    	$this->display();
    }
    public function teacherInfo(){
    	$this->display();
    }

    public function ShowTeacher(){
        $Teacher = $_GET['name'];
        $this->display($Teacher);
    }
}
