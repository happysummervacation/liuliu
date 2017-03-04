<?php
	class SystemSet{
		/*
		*获取系统的设置
		*/
		public function getSystemSet(){
			import("BackStage.Action.DBConfig.Config");
			$inquiry = new Model("systemset",Config::$frefix,Config::$db_config);
			$result = $inquiry->select();
			return $result[0];
		}
	}
