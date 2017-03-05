<?php
	/*
	*俞鹏泽
	*该类用来处理:
	1.周评,月评的创建
	2.对于过期日评,周评,月评的处理
	3.对于小班课的课程评论的处理
	*/
	class CommentAction extends Action{
		/*
		*俞鹏泽
		*创建周评的信息
		*/
		public function CreateWeekComment(){
			import("BackStage.Action.Record.Record");
			import("BackStage.Action.Public.PublicFunction");
			import("BackStage.Action.Comment.CommentService");
			//用于记录周评创建的时间
			Record::CreateLog('在'.date('Y-m-d H:i:s',PublicFunction::getTime()).
			'时间，访问了CreateWeekComment根据条件自动创建周评数据的方法');
			CommentService::CreateWeekCommentService();
		}

		/*
		*俞鹏泽
		*创建月评的评论数据
		*/
		public function CreateMonthComment(){
			import("BackStage.Action.Record.Record");
			import("BackStage.Action.Public.PublicFunction");
			import("BackStage.Action.Comment.CommentService");
			//用于记录周评创建的时间
			Record::CreateLog('在'.date('Y-m-d H:i:s',PublicFunction::getTime()).
			'时间，访问了CreateWeekComment根据条件自动创建周评数据的方法');
			CommentService::CreateMonthComentService();
		}

		/*
		*俞鹏泽
		*自动周评,当当前时间超过最后评论的截止时间并且处于教师还没有评论的状态,就进行自动评论
		*/
		public function AutoWeekComment(){
			import("BackStage.Action.Record.Record");
			import("BackStage.Action.Public.PublicFunction");
			import("BackStage.Action.DBConfig.Config");
			import("BackStage.Action.Template.AutoCommentTemplate");
			Record::CreateLog('在'.date('Y-m-d H:i:s',PublicFunction::getTime()).
			'时间,访问了AutoWeekComment进行周评自动评论的方法');

			$commentlevel = AutoCommentTemplate::$week_level;
			$commentcontent = AutoCommentTemplate::$week_content;

			$inquiry = new Model("",Config::$frefix,Config::$db_config);
			//如果评论是未评论的状态,同时时间已经超过了评论的最后期限就将评论状态设置成周评,自动评论
			$sql = "update tp_oneteachercom set commentlevel={$commentlevel},commentcontent={$commentcontent},
			comStatus=concat('1:2:',substring_index(comStatus,':',-1))
			 where substring_index(substring_index(comStatus,':',2),':',-1)='3'";
			$result = $inquiry->execute($sql);   //这里暂时不做成功与否的判断
		}

		/*
		*俞鹏泽
		*自动月评,当当前时间超过最后评论的截止时间并且处于教师还没有评论的状态,就进行自动评论
		*/
		public function AutoMonthComment(){
			import("BackStage.Action.Record.Record");
			import("BackStage.Action.Public.PublicFunction");
			import("BackStage.Action.DBConfig.Config");
			import("BackStage.Action.Template.AutoCommentTemplate");
			Record::CreateLog('在'.date('Y-m-d H:i:s',PublicFunction::getTime()).
			'时间,访问了AutoWeekComment进行月评自动评论的方法');

			$commentlevel = AutoCommentTemplate::$month_level;
			$monthcontent = AutoCommentTemplate::$month_content;

			$inquiry = new Model("",Config::$frefix,Config::$db_config);
			//如果评论是未评论的状态,同时时间已经超过了评论的最后期限就将评论状态设置成周评,自动评论
			$sql = "update tp_oneteachercom set commentlevel={$commentlevel},commentcontent={$commentcontent},
			comStatus=concat('2:2:',substring_index(comStatus,':',-1))
			 where substring_index(substring_index(comStatus,':',2),':',-1)='3'";
			$result = $inquiry->execute($sql);   //这里暂时不做成功与否的判断
		}

		/*
		*俞鹏泽
		*进行自动的一对一课程评论
		*/
		public function AutoDayComment(){
			import("BackStage.Action.Record.Record");
			import("BackStage.Action.Public.PublicFunction");
			import("BackStage.Action.DBConfig.Config");
			import("BackStage.Action.Template.AutoCommentTemplate");
			import("BackStage.Action.System.SystemSet");

			$systemSet = SystemSet::getSystemSet();
			$nowTime = PublicFunction::getTime();
			//先获取所有已经上过课的并且当前时间已经超过可以评论的期限
			$inquiry = new Model("oneteachercom",Config::$frefix,Config::$db_config);
			$sql = "select oneorderclassID,studentID,teacherID,classEndTime from tp_oneorderclass
			inner join tp_class on tp_class.classID=
			tp_oneorderclass.classID and (classStatus=1 or classStatus=3 or classStatus=4) and
			classEndTime<({$nowTime}-{$systemSet['dayDeadline']}) and teacherComment is null";
			$classResult = $inquiry->query($sql);

			$commentlevel = AutoCommentTemplate::$day_level;
			$commentcontent = AutoCommentTemplate::$day_content;
			$nowTime = PublicFunction::getTime();

			foreach ($classResult as $key => $value) {
				$inquiry->startTrans();
				//先添加评论的数据
				$deadline = (int)$value['classEndTime']+(int)$systemSet['dayDeadline'];
				$data = array();
				$data['studentID'] = $value['studentID'];
				$data['teacherID'] = $value['teacherID'];
				$data['commentlevel'] = $commentlevel;
				$data['commentcontent'] = $commentcontent;
				$data['comStartTime'] = $value['classEndTime'];
				$data['comEndTime'] = $nowTime;
				$data['comDeadline'] = $deadline;
				$data['comStatus'] = "0:2:0";
				$data['createTime'] = $nowTime;
				$addResult = $inquiry->add($data);
				//再更新课程中的数据
				$sql = "update tp_oneorderclass set teacherComment={$addResult}
				where oneorderclassID={$value['oneorderclassID']}";

				$updateResult = $inquiry->execute($sql);

				if($addResult && $updateResult){
					$inquiry->commit();
				}else{
					$inquiry->rollback();
				}
			}
		}
	}
