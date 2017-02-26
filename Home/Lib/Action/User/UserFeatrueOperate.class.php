<?php
	class UserFeatrueOperate extends Action{
		/*
		*俞鹏泽
		*查询没有课程顾问接管的
		*/
		//$Filed  值类型是null与字符串
		public function getStudentInfoWithoutStudentManage($Field = null){
			$inquiry = new Model("student");
			$result = null;

			if($Field == null){
				$result=$inquiry->where("student_manage_id is null")->select();
			}else{
				$result=$inquiry->where("student_manage_id is null")->field($Filed)->select();
			}
			return $result;
		}

		public function getOwnManager($StudentID = null,$Field = null){
			$inquiry = new Model();
			$result = null;
			if(is_null($StudentID)){
				return null;
			}

			if($Field == null){
				$result=$inquiry->table('tp_student,tp_admin')
				->where("tp_student.student_manage_id = tp_admin.ID and tp_student.id = $StudentID")
				->field('tp_admin.chinesename,tp_admin.weixin,tp_admin.phone,tp_admin.email,tp_admin.QQ')
				->select();
			}else{
				$result=$inquiry->table('tp_student,tp_admin')
				->where("tp_student.student_manage_id = tp_admin.ID and tp_student.id = $StudentID")
				->field($Field)->select();
			}
			return $result;
		}
	}
 ?>
