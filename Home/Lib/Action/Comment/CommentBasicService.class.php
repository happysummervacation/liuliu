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
			inner join tp_teacher on tp_class.teacherID=tp_teacher.ID")
			->where("(classStatus=1 or classStatus=3 or classStatus=4) and tp_oneorderclass.
			teacherComment is null")
			->select();
dump($inquiry);
			import("Home.Action.Comment.CommentBasicOperate");
			$comBasOp = new CommentBasicOperate();
			$weekCommentresult = $comBasOp->getNotFeedComment($teacherID,"week");
			$monthCommentResult = $comBasOp->getNotFeedComment($teacherID,"month");
			$auditionCommentResult = null;

			$returnData = array();
			array_push($returnData,$dayCommentResult,$weekCommentresult,$monthCommentResult,
			$auditionCommentResult);
dump($returnData);
exit;
			return $returnData;
		}
	}
 ?>
