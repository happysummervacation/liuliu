<?php
	
	class VideoBasicCountService extends Action{
		/*
		获取某位教师上传的Video数量
		*/
		public function getVideoNum($teacherID = null){
			if(is_null($teacherID)){
				return 0;
			}

			$inquiry = new Model();
			$sql = "select count(uploader = {$teacherID}) as num 
			from tp_video where isdelete=0";
			$result = $inquiry->query($sql);

			return $result[0]['num'];

		}
	}
?>