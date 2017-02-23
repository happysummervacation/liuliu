<?php
	class PackageConfigBasicOperate extends Action{
		public function getPackageConfigInfo(){
			$inquiry = new Model('packageconfig');
			$result = $inquiry->select();
			return $result;
		}
	}
 ?>
