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
	}
