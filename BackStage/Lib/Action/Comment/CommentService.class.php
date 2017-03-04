<?php
	class CommentService extends Action{
		/*
		*俞鹏泽
		*创建周评的服务
		*/
		//首先获取该周的学生的订课信息
		public static function CreateWeekCommentService(){
			import("BackStage.Action.OrderClass.OrderClass");
			import("BackStage.Action.Public.PublicFunction");

			$weekStuOrderClassResult = OrderClass::GetTeacherAndStudentWeekSituationService();
			if($weekStuOrderClassResult){
				$add_result = CommentService::AddWeekCommentOperate($weekStuOrderClassResult);
			}else{
				$time = date('Y-m-d H:i:s',PublicFunction::getTime());
				echo $time."   查询本周的学生的教师的频率失败，请注意检查数据库数组状态\n";
			}
		}

		/*
		*俞鹏泽
		*将周评的数据添加到数据库中
		*/
		public static function AddWeekCommentOperate($weekStuOrderClassResult = null){
			$error = 0;
			if(is_null($weekStuOrderClassResult)){
				return $error;
			}

			import("BackStage.Action.System.SystemSet");
			import("BackStage.Action.Public.PublicFunction");
			import("BackStage.Action.DBConfig.Config");
			import("BackStage.Action.Mail.MailTo");
			import("BackStage.Action.User.UserOperate");
			$systemSet = SystemSet::getSystemSet();
			$nowTime = PublicFunction::getTime();

			$inquiry = new Model('oneteachercom',Config::$frefix,Config::$db_config);
			$check_arr = array();  //用来确认哪些学生的教师已经被评论过了

			foreach ($weekStuOrderClassResult as $key => $value) {
				if(in_array($value['studentID'], $check_arr)){   //表示已经有上课订课最大的值了
					$data = array();
					$data['studentID'] = $value['studentID'];
					$data['teacherID'] = $value['teacherID'];
					$data['comStartTime'] = PublicFunction::getTime();
					$data['comEndTime'] = PublicFunction::getTime();
					$data['comDeadline'] = (int)PublicFunction::getTime()+(int)$systemSet['weekDeadline'];
					$data['comStatus'] = "1:2:1"; //表示是周评:教师还没有进行评论:教师不需要进行评论
					$data['createTime'] = PublicFunction::getTime();
					$data['isdelete'] = 0;
					$add_result = $inquiry->add($data);
					if(!$add_result){
						echo date('Y-m-d H:i:d',PublicFunction::getTime())."创建{$value['teacherID']}教师
						对{$value['studentID']}学生的周评数据失败，该数据是不需要教师进行评论的\n";
						$error += 1;
					}
				}else{      //表不存在表名该老师是最高频率的教师，该老师需要进行周评评价,并将其放入check_arr数组中
					$data = array();
					$data['studentID'] = $value['studentID'];
					$data['teacherID'] = $value['teacherID'];
					$data['comStartTime'] = PublicFunction::getTime();
					$data['comDeadline'] = (int)PublicFunction::getTime()+(int)$systemSet['weekDeadline'];
					$data['comStatus'] = "1:3:0"; //表示是周评:自动进行评论:教师需要进行评论
					$data['createTime'] = PublicFunction::getTime();
					$data['isdelete'] = 0;
					$add_result = $inquiry->add($data);
					if(!$add_result){
						echo date('Y-m-d H:i:d',PublicFunction::getTime())."创建{$value['teacherID']}教师
						对{$value['studentID']}学生的周评数据失败，该数据是要教师进行评论的\n";
						$error += 1;
					}
					//将该学生放入check_arr数组中，表示该学生的最高频率的教师的评论已经创建了
					array_push($check_arr, $value['studentID']);
					//进行周评邮件提醒
					//获取指定教师的邮箱
					$email = UserOperate::getUserInfo('teacher',$value['teacherID'],null,null,null,"email")[0]['email'];
					MailTo::PostMail($email,"周评添加提醒","老师，本周你需要对本周上过的学生进行周评评价，请注意等账户查看");
					//不进行发送成功与否的判断
				}
			}

			return $error;
		}

		/*
		*俞鹏泽
		*创建月评服务
		*/
		public static function CreateMonthComentService(){
			import("BackStage.Action.OrderClass.OrderClass");
			import("BackStage.Action.Public.PublicFunction");

			$monthStuOrderClassResult = OrderClass::GetTeacherAndStudentMonthSituationService();

			if($monthStuOrderClassResult){
				$add_result = CommentService::AddMonthCommentOperate($monthStuOrderClassResult);
			}else{
				$time = date('Y-m-d H:i:s',PublicFunction::getTime());
				echo $time."   查询本月的学生的教师的频率失败，请注意检查数据库数组状态\n";
			}
		}
		/*
		*俞鹏泽
		*将月评数据添加到数据库中去
		*/
		public static function AddMonthCommentOperate($monthStuOrderClassResult = null){
			$error = 0;
			if(is_null($monthStuOrderClassResult)){
				return $error;
			}

			import("BackStage.Action.System.SystemSet");
			import("BackStage.Action.Public.PublicFunction");
			import("BackStage.Action.DBConfig.Config");
			import("BackStage.Action.Mail.MailTo");
			import("BackStage.Action.User.UserOperate");
			$systemSet = SystemSet::getSystemSet();
			$nowTime = PublicFunction::getTime();

			$inquiry = new Model('oneteachercom',Config::$frefix,Config::$db_config);
			$check_arr = array();  //用来确认哪些学生的教师已经被评论过了

			foreach ($monthStuOrderClassResult as $key => $value) {
				if(in_array($value['studentID'], $check_arr)){   //表示已经有上课订课最大的值了
					$data = array();
					$data['studentID'] = $value['studentID'];
					$data['teacherID'] = $value['teacherID'];
					$data['comStartTime'] = PublicFunction::getTime();
					$data['comEndTime'] = PublicFunction::getTime();
					$data['comDeadline'] = (int)PublicFunction::getTime()+(int)$systemSet['monthDeadline'];
					$data['comStatus'] = "2:2:1"; //表示是周评:教师还没有进行评论:教师不需要进行评论
					$data['createTime'] = PublicFunction::getTime();
					$data['isdelete'] = 0;
					$add_result = $inquiry->add($data);
					if(!$add_result){
						echo date('Y-m-d H:i:d',PublicFunction::getTime())."创建{$value['teacherID']}教师
						对{$value['studentID']}学生的月评数据失败，该数据是不需要教师进行评论的\n";
						$error += 1;
					}
				}else{      //表不存在表名该老师是最高频率的教师，该老师需要进行周评评价,并将其放入check_arr数组中
					$data = array();
					$data['studentID'] = $value['studentID'];
					$data['teacherID'] = $value['teacherID'];
					$data['comStartTime'] = PublicFunction::getTime();
					$data['comDeadline'] = (int)PublicFunction::getTime()+(int)$systemSet['monthDeadline'];
					$data['comStatus'] = "2:3:0"; //表示是周评:自动进行评论:教师需要进行评论
					$data['createTime'] = PublicFunction::getTime();
					$data['isdelete'] = 0;
					$add_result = $inquiry->add($data);
					if(!$add_result){
						echo date('Y-m-d H:i:d',PublicFunction::getTime())."创建{$value['teacherID']}教师
						对{$value['studentID']}学生的月评数据失败，该数据是要教师进行评论的\n";
						$error += 1;
					}
					//将该学生放入check_arr数组中，表示该学生的最高频率的教师的评论已经创建了
					array_push($check_arr, $value['studentID']);
					//进行月评邮件提醒
					//获取指定教师的邮箱
					$email = UserOperate::getUserInfo('teacher',$value['teacherID'],null,null,null,"email")[0]['email'];
					$result = MailTo::PostMail($email,"月评评添加提醒","老师，本月你需要对本月上过的学生进行月评评价，请注意等账户查看");
					//不进行发送成功与否的判断
				}
			}

			return $error;
		}
	}
