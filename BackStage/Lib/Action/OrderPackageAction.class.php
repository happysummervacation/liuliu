<?php
	class OrderPackageAction extends Action{
		/*
		*俞鹏泽
		*自动将超出有效期限的套餐的设置成失效状态
		*/
		//每天都要执行该函数,用以设置套餐是否有效
		public function AutoSetOrderPacStatus(){
			import("BackStage.Action.DBConfig.Config");
			import("BackStage.Action.Public.PublicFunction");
			$nowTime = PublicFunction::getTime();

			$inquiry = new Model('orderpackage',Config::$frefix,Config::$db_config);
			$sql = "update tp_orderpackage set status=0 where status=1 and endTime<{$nowTime}";
			$result = $inquiry->execute($sql);   //这里不做结果的判断
		}
	}
 ?>
