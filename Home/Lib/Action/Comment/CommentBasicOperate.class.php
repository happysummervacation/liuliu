<?php
	class CommentBasicOperate extends Action{
		private $systemSet = null;
		public function __construct(){
            //获取系统设置
            $field = array();
            import("Home.Action.System.SystemBasicOperate");
			$sysOp = new SystemBasicOperate();
            $result = $sysOp->getSystemSet();
			$this->systemSet = $result;
        }

		/*
		蒋周杰
		获取学生已经完成的课程评论
		参数一：教师的ID
		*/
		public function getStudentComment($teacherID = null){
			if(is_null($teacherID)){
				return 0;
			}
			$inquiry = new Model();
			$result = $inquiry->table('tp_class,tp_onestudentcom,tp_oneorderclass')
			->where("tp_onestudentcom.onestudentcommentID
				= tp_oneorderclass.studentComment
				and tp_oneorderclass.classID = tp_class.classID
				and tp_onestudentcom.teacherID = {$teacherID}")
			->field("tp_class.classStartTime,tp_oneorderclass.oneorderclassID,
				tp_onestudentcom.*")
			->select();
			return $result;
		}

		/*
		*俞鹏泽
		*获取教师还没有评论过的周评或者月评
		*/
		public function getNotFeedComment($teacherID = null,$commentType = null){
			if(is_null($teacherID) || is_null($commentType)){
				return null;
			}

			$inquiry = new Model("oneteachercom");

			if("week" == $commentType){
				$deadline = (int)getTime()-(int)$this->systemSet['weekDeadline'];

				$result = $inquiry
				->join("inner join tp_student on tp_student.ID=tp_oneteachercom.studentID")
				->where("teacherID={$teacherID} and comDeadline>{$deadline} and
				 substring_index(comStatus,':',1)='1' and substring_index(comStatus,':',-1)='0'
				 and substring_index(substring_index(comStatus,':',2),':',-1)='3'")->select();

				 return $result;
			}elseif("month" == $commentType){
				$deadline = (int)getTime()-(int)$this->systemSet['monthDeadline'];

				$result = $inquiry
				->join("inner join tp_student on tp_student.ID=tp_oneteachercom.studentID")
				->where("teacherID={$teacherID} and comDeadline>{$deadline} and
				 substring_index(comStatus,':',1)='2' and substring_index(comStatus,':',-1)='0'
				 and substring_index(substring_index(comStatus,':',2),':',-1)='3'")->select();
				 return $result;
			}
		}

		/*
		*俞鹏泽
		*获取教师已经评论过的周评或者月评
		*/
		public function getFeededComment($teacherID = null,$commentType = null,$startTime = null,$endTime = null){
			if(is_null($teacherID) || is_null($commentType)){
				return null;
			}

			$inquiry = new Model("oneteachercom");

			if(is_null($startTime) || is_null($endTime)){
				if("one" == $commentType){
					$result = $inquiry
					->join("inner join tp_student on tp_student.ID=tp_oneteachercom.studentID")
					->where("teacherID={$teacherID} and substring_index(comStatus,':',1)='1'
					and substring_index(comStatus,':',-1)='0'
					and substring_index(substring_index(comStatus,':',2),':',-1)='0'")
					->select();
					return $result;
				}elseif("month" == $commentType){
					$result = $inquiry
					->join("inner join tp_student on tp_student.ID=tp_oneteachercom.studentID")
					->where("teacherID={$teacherID} and substring_index(comStatus,':',1)='2'
					and substring_index(comStatus,':',-1)='0'
					and substring_index(substring_index(comStatus,':',2),':',-1)='0'")
					->select();
					return $result;
				}
			}else{
				if("one" == $commentType){
					$result = $inquiry
					->join("inner join tp_student on tp_student.ID=tp_oneteachercom.studentID")
					->where("teacherID={$teacherID} and substring_index(comStatus,':',1)='1'
					and substring_index(comStatus,':',-1)='0'
					and substring_index(substring_index(comStatus,':',2),':',-1)='0' and
					comEndTime>={$startTime} and comEndTime<={$endTime}")
					->select();
					return $result;
				}elseif("month" == $commentType){
					$result = $inquiry
					->join("inner join tp_student on tp_student.ID=tp_oneteachercom.studentID")
					->where("teacherID={$teacherID} and substring_index(comStatus,':',1)='2'
					and substring_index(comStatus,':',-1)='0'
					and substring_index(substring_index(comStatus,':',2),':',-1)='0' and
					comEndTime>={$startTime} and comEndTime<={$endTime}")
					->select();
					return $result;
				}
			}
		}

		/*
		*蒋周杰
		*获取学生还没有评论过的一对一课程
		*参数一：学生的ID
		*/
		public function getNeedCommentClass($studentID = null){
			if(is_null($studentID)){
				return null;
			}
			$inquiry = new Model();
			$result = $inquiry->table("tp_oneorderclass,tp_class,tp_teacher")
			->where("tp_oneorderclass.studentID = {$studentID} and
			tp_oneorderclass.classID = tp_class.classID and
			tp_class.teacherID = tp_teacher.ID and (tp_oneorderclass.classStatus = 1
			or tp_oneorderclass.classStatus = 3 or tp_oneorderclass.classStatus = 4)
			and tp_oneorderclass.studentComment is null")
			->select();

			return $result;
		}

		/*
		*蒋周杰
		*获取日评
		*参数一：学生ID
		*/
		public function getDailyCommentFromTeacher($studentID = null){
			$inquiry = new Model();
			$result = $inquiry->table('tp_oneteachercom,tp_teacher')
			->where("tp_oneteachercom.studentID = {$studentID} and
			tp_oneteachercom.teacherID = tp_teacher.ID and
			SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',1)=0 and
			SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',2)=0 and
			SUBSTRING_INDEX(SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',2),':',-1)='0'")
			->select();
			return $result;
		}

		/*
		*蒋周杰
		*获取周评
		*参数一：学生ID
		*/
		public function getWeekCommentFromTeacher($studentID = null){
			$inquiry = new Model();
			$result = $inquiry->table('tp_oneteachercom,tp_teacher')
			->where("tp_oneteachercom.studentID = {$studentID} and
			tp_oneteachercom.teacherID = tp_teacher.ID and
			SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',1)='1' and
			(SUBSTRING_INDEX(SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',2),':',-1)='0' or
			SUBSTRING_INDEX(SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',2),':',-1)='3')")->select();

			return $result;
		}

		/*
		*蒋周杰
		*获取月评
		*参数一：学生ID
		*/
		public function getMonthCommentFromTeacher($studentID = null){
			$inquiry = new Model();
			$result = $inquiry->table('tp_oneteachercom,tp_teacher')
			->where("tp_oneteachercom.studentID = {$studentID} and
			tp_oneteachercom.teacherID = tp_teacher.ID and
			SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',1)=2 and
			(SUBSTRING_INDEX(SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',2),':',-1)='0' or
			SUBSTRING_INDEX(SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',2),':',-1)='3')")->select();
			return $result;
		}

		/*
		*蒋周杰
		*获取试听课评论
		*参数一学生ID
		*/
		public function getTestCommentFromTeacher($studentID = null){
			$inquiry = new Model();
			$result = $inquiry->table('tp_oneteachercom,tp_teacher')
			->where("tp_oneteachercom.studentID = {$studentID} and
			tp_oneteachercom.teacherID = tp_teacher.ID and
			SUBSTRING_INDEX(tp_oneteachercom.comStatus,':',1) = 3")->select();
			return $result;
		}

	}
 ?>
