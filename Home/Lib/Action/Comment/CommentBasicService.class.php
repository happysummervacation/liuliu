<?php
	class CommentBasicService extends Action{
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
		*俞鹏泽
		*获取一对一课程中需要进行评论的日评,周评,月评,以及试听课的评论信息
		*/
		//这里的试听课评论暂时没有完成
		public function getOneNeedToFeedComment($teacherID = null){
			if(is_null($teacherID)){
				return null;
			}
			//获取日评的数据,日评的数据主要是查看获取上过课的学生的评论数据还没有的课程信息
			//由于复用的地方不多这里的要评论的日评数据直接进行获取
			//日评数据子啊进行获取时需要判断当前时间是否已经超过了规定的评价时间
			$nowtime = getTime();
			$deadline = (int)$nowtime-(int)$this->systemSet['dayDeadline'];

			$inquiry = new Model("oneorderclass");
			$dayCommentResult = $inquiry
			->join("inner join tp_class on tp_class.classID=tp_oneorderclass.classID and
			classEndTime>({$deadline}) and teacherID={$teacherID}
			inner join tp_teacher on tp_class.teacherID=tp_teacher.ID
			inner join tp_student on tp_oneorderclass.studentID=tp_student.ID")
			->where("(classStatus=1 or classStatus=3 or classStatus=4) and tp_oneorderclass.
			teacherComment is null")
			->select();

			import("Home.Action.Comment.CommentBasicOperate");
			$comBasOp = new CommentBasicOperate();
			$weekCommentresult = $comBasOp->getNotFeedComment($teacherID,"week");
			$monthCommentResult = $comBasOp->getNotFeedComment($teacherID,"month");
			$auditionCommentResult = null;

			$returnData = array();
			array_push($returnData,$dayCommentResult,$weekCommentresult,$monthCommentResult,
			$auditionCommentResult);
			return $returnData;
		}

		/*
		*俞鹏泽
		*对日评进行评论
		*/
		//先生成评论的数据
		//再跟新订购课程表中的数据
		public function OneClassDayCommentService($postData = null,$teacherID = null){
			$message = array();
			if(is_null($postData) || is_null($teacherID)){
				$message['status'] = false;
				$message['message'] = "评论缺乏数据";
				return $message;
			}

			$inquiry = new Model();
			$inquiry->startTrans();
			//获取指定课程的课程结束时间的数据
			import("Home.Action.Class.ClassBasicOperate");
			$classOp = new ClassBasicOperate();
			$classInfo = $classOp->getClassInfo($postData['classID'],"classEndTime");

			$data['studentID'] = $postData['studentID'];
			$data['teacherID'] = $teacherID;
			$data['commentlevel'] = $postData['comment_level'];
			$data['commentcontent'] = $postData['feedback'];
			$data['comStartTime'] = $classInfo[0]['classEndTime'];   //一对一的课程评论的开始时间就是课程结束时间
			$data['comEndTime'] = getTime();
			$data['comDeadline'] = (int)$classInfo[0]['classEndTime']+(int)$this->systemSet['dayDeadline'];
			$data['comStatus'] = "0:0:0";
			$data['createTime'] = getTime();
			$data['curProgress'] = $postData['currentProcess'];
			$data['furProgress'] = $postData['overallProcess'];
			$data['isdelete'] = 0;

			$inquiryDayComment = new Model("oneteachercom");
			$addResult = $inquiryDayComment->add($data);
			//如果添加成功就进行课程数据的更新
			$sql = "update tp_oneorderclass,tp_class set `remark`='{$postData['classRemark']}',
			`teacherComment`={$addResult} where tp_oneorderclass.classID=tp_class.classID and
			oneorderclassID={$postData['orderclassID']} and tp_class.ClassID='{$postData['classID']}'";

			$updateResult = $inquiry->execute($sql);

			if($addResult && $updateResult){
				$inquiry->commit();    //进行事务提交
				$message['status'] = true;
				$message['message'] = "日评成功";
				return $message;
			}else{
				$inquiry->rollback();   //进行事务回滚
				$message['status'] = false;
				$message['message'] = "日评失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*教师对周评进行评论
		*/
		public function OneClassWeekCommentService($postData = null,$teacherID = null){
			$message = array();
			if(is_null($postData) || is_null($teacherID)){
				$message['status'] = false;
				$message['message'] = "评论缺乏数据";
				return $message;
			}

			$inquiry = new Model("oneteachercom");
			$data['commentlevel'] = $postData['comment_level'];
			$data['commentcontent'] = $postData['feedback'];
			$data['comEndTime'] = getTime();
			$data['comStatus'] = "1:0:0";
			$data['curProgress'] = $postData['current_progress'];
			$data['furProgress'] = $postData['full_progress'];
			$result = $inquiry->where("oneteachercomID={$postData['commentID']}")->save($data);

			if($result){
				$message['status'] = true;
				$message['message'] = "周评成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "周评失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*教师对月评进行评论
		*/
		public function OneClassMonthCommentService($postData = null,$teacherID = null){
			$message = array();
			if(is_null($postData) || is_null($teacherID)){
				$message['status'] = false;
				$message['message'] = "评论缺乏数据";
				return $message;
			}

			$inquiry = new Model("oneteachercom");
			$data['commentlevel'] = $postData['comment_level'];
			$data['commentcontent'] = $postData['feedback'];
			$data['comEndTime'] = getTime();
			$data['comStatus'] = "2:0:0";
			$data['curProgress'] = $postData['current_progress'];
			$data['furProgress'] = $postData['full_progress'];
			$result = $inquiry->where("oneteachercomID={$postData['commentID']}")->save($data);

			if($result){
				$message['status'] = true;
				$message['message'] = "月评成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "月评失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*查询指定时间内教师评论的一对一日评,周评,月评,以及试听课评论
		*/
		public function getOneTeacherFeededComment($teacherID = null,$startTime = null,$endTime = null){
			if(is_null($teacherID) || is_null($startTime) || is_null($endTime)){
				return null;
			}

			//获取教师的一对一评论数据
			$inquiry = new Model('oneorderclass');
			$dayCommentResult = $inquiry
			->join("inner join tp_oneteachercom on tp_oneteachercom.oneteachercomID
			=tp_oneorderclass.teacherComment and teacherID={$teacherID} and comEndTime>={$startTime} and
			comEndTime<={$endTime} and substring_index(comStatus,':',1)='0' and
			substring_index(substring_index(comStatus,':',2),':',-1)='0'
			inner join tp_student on tp_student.ID=tp_oneorderclass.studentID")
			->select();

			import("Home.Action.Comment.CommentBasicOperate");
			$comBasOp = new CommentBasicOperate();
			$weekCommentResult = $comBasOp->getFeededComment($teacherID,'one',$startTime,$endTime);
			$monthCommentResult = $comBasOp->getFeededComment($teacherID,'month',$startTime,$endTime);
			$auditionCommentResult = null;        //试听课评论暂时不管

			$returnData = array();
			array_push($returnData,$dayCommentResult,$weekCommentResult,$monthCommentResult,
			$auditionCommentResult);

			return $returnData;
		}

		/*
		*蒋周杰
		*上传学生对老师的评论
		*参数一:评价信息
		*/
		public function setStudentCommeet($data = null,$oneorderclassID = null){
			$message = array();
			if(is_null($data)||is_null($oneorderclassID)){
				$message['status'] = false;
				$message['message'] = "评价信息不全";
				return $message;
			}

			//添加评论数据的所需信息
			$data['isdelete'] = 0;
			$data['createtime'] = getTime();
			$data['commentcontent'] = "";

			$inquiry = new Model();
			//开启一个事物
			$inquiry->startTrans();
			//提交评论数据
			$addresult = $inquiry->table('tp_onestudentcom')->add($data);
			//更新class中的studentComment
			$updatedata['studentComment'] = $addresult;
			$updateresult = $inquiry->table('tp_oneorderclass')
			->where("tp_oneorderclass.oneorderclassID = {$oneorderclassID}")
			->save($updatedata);
			if($addresult!=false&&$updateresult){
				//提交事务
				$inquiry->commit();
			 	$message['status'] = true;
			 	$message['message'] = "评价成功！";
			}else{
				//事务回滚
				$inquiry ->rollback();
				$message['status'] = false;
			 	$message['message'] = "评价失败！";
			}

			return $message;
		}
	}
 ?>
