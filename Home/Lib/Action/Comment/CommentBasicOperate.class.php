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
		*俞鹏泽
		*获取教师还没有评论过的周评或者月评
		*/
		public function getNotFeedComment($teacherID = null,$commentType = null){
			if(is_null($teacherID) || is_null($commentType)){
				return null;
			}

			$inquiry = new Model("oneteachercom");
			$deadline = (int)getTime()-(int)$this->systemSet['weekDeadline'];

			if("week" == $commentType){
				$deadline = (int)getTime()-(int)$this->systemSet['weekDeadline'];

				$result = $inquiry->where("teacherID={$teacherID} and comDeadline>{$deadline} and
				 substring_index(comStatus,':',1)='1' and substring_index(comStatus,':',-1)='0'
				 and substring_index(substring_index(comStatus,':',2),':',-1)='3'")->select();
				 return $result;
			}elseif("month" == $commentType){
				$deadline = (int)getTime()-(int)$this->systemSet['monthDeadline'];

				$result = $inquiry->where("teacherID={$teacherID} and comDeadline>{$deadline} and
				 substring_index(comStatus,':',1)='2' and substring_index(comStatus,':',-1)='0'
				 and substring_index(substring_index(comStatus,':',2),':',-1)='3'")->select();
				 return $result;
			}
		}
	}
 ?>
