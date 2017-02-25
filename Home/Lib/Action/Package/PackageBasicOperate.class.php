<?php
	class PackageBasicOperate extends Action{
		/*
		*俞鹏泽
		*获取套餐信息
		*/
		//参数一:套餐ID值,null表示所有的套餐,某个值表示某个套餐,也可以是数组
		//参数二:null表示查询所有的字段,数组的话,表示查找数组中的对应字段
		public function getPackageInfo($packageID = null,$Field = null){
			$condition = "(";
			$fieldString = "(";

			if(is_array($packageID)){
				for ($i = 0; $i < count($packageID); $i++) {
					if($i == count($packageID)-1){
						$condition = $condition."package_id=".$packageID[$i].")";
					}else{
						$condition = $condition."package_id=".$packageID[$i]." or ";
					}
				}
			}elseif(is_numeric($packageID) || is_string($packageID)){
				$condition = "package_id=".$package_id;
			}else{
				$condition = null;
			}

			if(!is_null($Field)){
				for ($i=0; $i < count($Field); $i++) {
					if($i == count($Field)-1){
						$fieldString = $fieldString.$Field[$i].")";
					}else{
						$fieldString = $fieldString.$Field[$i]." or ";
					}
				}
			}

			$inquiry = new Model("package");
			if(is_null($packageID)){
				if(is_null($Field)){
					$result = $inquiry->join("inner join tp_packageconfig on tp_package.category=tp_packageconfig.packageconID
					 and isdelete=0")
					->select();
				}else{
					$result = $inquiry->join("inner join tp_packageconfig on tp_package.category=tp_packageconfig.packageconID
					 and isdelete=0")
					->field($fieldString)->select();
				}
			}else{
				if(is_null($Field)){
					$result = $inquiry->join("inner join tp_packageconfig on tp_package.category=tp_packageconfig.packageconID
					 and isdelete=0")
					->where($condition)->select();
				}else{
					$result = $inquiry->join("inner join tp_packageconfig on tp_package.category=tp_packageconfig.packageconID
					 and isdelete=0")
					->where($condition)->select();
				}
			}

			return $result;
		}

		/*
		*俞鹏泽
		*更新一个套餐
		*/
		public function updatePackageInfo($packageID = null,$Data = null){
            $message = array();

            if(is_null($Data)){
                $message['status'] = false;
                $message['message'] = "要更新的套餐的数据为空";
                return $message;
            }

            $inquiry = new Model('package');

            $result = $inquiry->where("package_id={$packageID}")->save($Data);

            if($result || $result == 0){
                $message['status'] = true;
                $message['message'] = "用户的数据成功更新进入数据库";
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "用户的数据失败更新进入数据库";
                return $message;
            }
        }

		/*
		*俞鹏泽
		*新增一个套餐
		*/
		public function addPackage($Data = null){
			$message = array();

            if(is_null($Data)){
                $message['status'] = false;
                $message['message'] = "要添加的套餐的数据为空";
                return $message;
            }

            $inquiry = new Model('package');

            $result = $inquiry->add($Data);

            if($result){
                $message['status'] = true;
                $message['message'] = "套餐数据增添成功";
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "套餐数据增添失败";
                return $message;
            }
		}

		/*陈泽奇
		*第一个参数是数组,当为null时，就查询所有
		*第二个参数是字段,当为null时，就查询所有
		*返回符合条件的数组。
		*/
		public function selectPackage($postID = null,$Field = null)
		{
			$message = array();
			$inquiry = new Model('package');
			$condition = "";

			if($postID['class_type'] != "null"){
				$condition = $condition."class_type=".$postID['class_type']." and ";
			}
			if($postID['package_type'] != "null"){
				$condition = $condition."package_type=".$postID['package_type']
				." and ";
			}
			if($postID['teacher_type'] != "null"){
				$condition = $condition."teacher_type=".$postID['teacher_type']
				." and ";
			}
			if($postID['teacher_nation'] != "null"){
				$condition = $condition."teacher_nation=".$postID['teacher_nation']." and ";
			}
			if($postID['packageconID'] != "null"){
				$condition = $condition."category=".$postID['packageconID']." and ";
			}
			$condition = $condition."1";

			if(is_null($Field)){
				$result = $inquiry
				->join("inner join tp_packageconfig on tp_package.category=tp_packageconfig.packageconID and isdelete=0")
				->where($condition)->select();
				return $result;

			}else{
				$fieldString = "";
				if(!is_null($Field)){
					for ($i=0; $i < count($Field); $i++) {
						if($i == count($Field)-1){
							$fieldString = $fieldString.$Field[$i].")";
						}else{
							$fieldString = $fieldString.$Field[$i]." or ";
						}
					}
				}
				$result = $inquiry
				->join("inner join tp_packageconfig on tp_package.category=tp_packageconfig.packageconID and isdelete=0")
				->where($condition)
				->field($fieldString)->select();
				return $result;
			}
		}
	}
 ?>
