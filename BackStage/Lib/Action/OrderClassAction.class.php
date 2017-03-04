<?php
	/*
	*俞鹏泽
	*该类用来处理
	1.对于学生订购的课程,如果当前时间超过上课时间,同时课程是未上过的状态就需要将课程状态设置成上过状态
	*/
	class OrderClassAction extends Action{
		/*
		*俞鹏泽
		*表示将那些已经超过了课程结束时间,但是课程状态还是未上的一对一课程
		*的课程状态自动设置成正常上课的情况
		*/
		public function AutoDealOneOrderClass(){
			import("BackStage.Action.DBConfig.Config");
			import("BackStage.Action.Public.PublicFunction");

			$nowTime = PublicFunction::getTime();
			$inquiry = new Model('',Config::$frefix,Config::$db_config);
			$sql = "update tp_oneorderclass,tp_class set tp_oneorderclass.classStatus=1
			 where tp_oneorderclass.classID=tp_class.classID and tp_class.classEndTime<{$nowTime}
			 and classStatus=0";

			$result = $inquiry->execute($sql);   //这里暂时不做课程处理是否正常的处理判断
		}
	}
