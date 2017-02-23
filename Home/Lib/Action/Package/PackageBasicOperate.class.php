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
			$fieldString = "";

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
						$fieldString = $fieldString."package_id=".$Field[$i].")";
					}else{
						$fieldString = $fieldString."package_id=".$Field[$i]." or ";
					}
				}
			}

			$inquiry = new Model("package");
			if(is_null($condition)){
				if(is_null($fieldString)){
					$result = $inquiry->join("inner join tp_packageconfig on tp_package.category=tp_packageconfig.packageconID
					 and isdelete=0")
					->select();
				}else{
					$result = $inquiry->join("inner join tp_packageconfig on tp_package.category=tp_packageconfig.packageconID
					 and isdelete=0")
					->field($fieldString)->select();
				}
			}else{
				if(is_null($fieldString)){
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
	}
 ?>
