<?php
	class OrderClass extends Action{
		/*
		*俞鹏泽
		*获取本周的学生订购课程的情况(这里的创建周评的信息是根据一对一的课程表来进行创建)
		*/
		public static function GetTeacherAndStudentWeekSituationService(){
			import("BackStage.Action.DBConfig.Config");
			import("BackStage.Action.Public.PublicFunction");

			$week_start_time = PublicFunction::GetThisWeekStartEndTime()[0];
			$week_end_time = PublicFunction::GetThisWeekStartEndTime()[1];

			$inquiry = new Model('',Config::$frefix,Config::$db_config);
			// $sql = "select count(*) as number,tem.student_id,tem.teacher_id from
			//(SELECT tp_orderclass.student_id,tp_class.teacher_id
			// 		FROM `tp_orderclass` inner join tp_class
			// 		on tp_class.class_id=tp_orderclass.class_id
			// 		and tp_orderclass.isdelete=0
			// 		and (class_status!=4 or class_status!=5)
			// 		and tp_class.start_time>={$week_start_time}
			// 		and tp_class.start_time<={$week_end_time}) as tem
			// 		group by tem.student_id,tem.teacher_id
			// 		order by number desc";
			$sql = "
			 select count(*) as number,tem.studentID,tem.teacherID from
			 (select tp_oneorderclass.studentID,tp_class.teacherID
			 from tp_oneorderclass
			 inner join tp_class on tp_class.classID=tp_oneorderclass.classID and
			 tp_oneorderclass.isdelete=0 and (classStatus!=2 and classStatus!=6)
			 and tp_class.classStartTime>={$week_start_time} and
			 tp_class.classStartTime<={$week_end_time}) as tem
			 group by tem.studentID,tem.teacherID
			 order by number desc
			 ";
			 //由于是降序排序,所以第一个值就是最大的值
			 $result = $inquiry->query($sql);
			 return $result;
		}
	}
