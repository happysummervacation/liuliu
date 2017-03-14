<?php
	/*
	*俞鹏泽
	*该类用来设置教师的评论的比率相关的操作
	*/
	class TeaCommentRateSetService extends Action{
		/*
		*俞鹏泽
		*该函数用来查询教师的评论的比率
		*/
		//参数一:教师的ID,用来表示是哪个教师的评论数据
		//参数二:评论的类型  只能是一对一课程,小班课程与日评,周评,月评的组合形式   数据从GlobalValue中进行获取
		//如果参数为null,表示查询所有,多种方式时查询时使用***:***&***:***的方式
		//其中***:***,第一个***表示课程的类型只能是一对一和小班  后面的***:***表示评论类型日评,周评,月评,使用&进行分隔
		//用来表示多组
		//参数三:表示要查询的字段
		//参数四:表示查询的数据是否是最新的,  null时表示查询所有,true时表示查询最新的,false时表示查询不是最新的
		//参数五:表示限制查询时间的开始时间(时间戳)
		//参数六:表示限制查询时间的结束时间
		public function getTeacherCommentRateSer($teacherID = null,$commentType = null,
		$field = null,$isLatest = null,$startTime = null,$endTime = null){
			if(is_null($teacherID)){
				return null;
			}
			$commentTypeCondition = "( 1=2 ";   //评论的条件
			if(is_null($commentType)){
				$commentTypeCondition = "( commenttype='0:0' or commenttype='0:1' or commenttype='0:2' or
				commenttype='1:0')";
			}else{
				$commentTypeExResult = explode("&",$commentType);
				foreach ($commentTypeExResult as $key => $value) {
					$commentTypeCondition .= " or commenttype='{$value}'";
				}
				$commentTypeCondition .= ")";
			}
			$fieldString = "";    //字段条件
			$fieldString = transformFieldToFieldString($field);

			$isLatestCondition = "";    //是否是最新的条件
			if(!is_null($isLatest)){
				if($isLatest){
					$isLatestCondition = "and islastest=1";
				}else{
					$isLatestCondition = "and islastest=0";
				}
			}

			$timeCondition = "";   //表示时间条件
			if(!is_null($startTime) && !is_null($endTime)){
				$timeCondition = "((cstarttime>={$startTime} and cendtime<={$endTime}) ||
				(cstarttime<={$startTime} and cendtime>={$startTime}) ||
				(cstarttime<={$endTime} and cendtime>={$endTime}))";
				$timeCondition = " and ".$timeCondition;
			}

			$inquiry = new Model("teacommentrateset");
			$result = $inquiry
			->where("teacherID={$teacherID} and {$commentTypeCondition} {$isLatestCondition}
			{$timeCondition}")
			->field("{$fieldString}")
			->select();

			return $result;
		}

		/*
		*俞鹏泽
		*更改教师的评论的比率
		*/
		//参数一:教师的ID
		//参数二:表示要修改的评论的类型,其中***:***,第一个***表示课程的类型只能是一对一和小班
		//后面的***:***表示评论类型日评,周评,月评,其中的***的值只能是GlobalValue的值.只能是***:***一组数据
		//参数三:表示要修改的值
		public function updateTeaCommentRate($teacherID = null,$commentType = null,$rate = 0){
			$message = array();
			if(is_null($message) || is_null($commentType)){
				$message['status'] = false;
				$message['message'] = "缺少更新的数据";
				return $message;
			}
			if($rate < 0 || $rate > 100){
				$message['status'] = false;
				$message['message'] = "设置的值大于100%或者小于0%";
				return $message;
			}

			//先查询该条要修改的数据是否含有最新的值,如果有表示原来的数据,需要先修改原来的数据,再添加新的数据
			//如果没有原来的数据,就直接进行数据添加
			$inquiry = new Model("teacommentrateset");
			$selectResult = $this->getTeacherCommentRateSer($teacherID,$commentType,"teacommentratesetID",true);

			if($selectResult){   //表示原来有最新的数据
				//先更新旧的数据
				//再添加新的数据
				$updateData = $this->createCommentSetUpdateInfo();
				$updateResult = $inquiry
				->where("teacommentratesetID={$selectResult[0]['teacommentratesetID']}")
				->save($updateData);
				if($updateData){
					$newData = $this->createNewCommentRateInfo($teacherID,$commentType,$rate);
					$addResult = $inquiry->add($newData);
					if($addResult){
						$message['status'] = true;
						$message['message'] = "添加新的数据成功";
						return $message;
					}else{
						$message['status'] = false;
						$message['message'] = "添加新的数据失败";
						return $message;
					}
				}else{
					$message['status'] = false;
					$message['message'] = "修改旧数据失败";
					return $message;
				}
			}else{   //表示原来没有最新的操作数据
				//直接添加信息数据
				$newData = $this->createNewCommentRateInfo($teacherID,$commentType,$rate);
				$addResult = $inquiry->add($newData);
				if($addResult){
					$message['status'] = true;
					$message['message'] = "添加新的数据成功";
					return $message;
				}else{
					$message['status'] = false;
					$message['message'] = "添加新的数据失败";
					return $message;
				}
			}
		}

		/*
		*俞鹏泽
		*创建更新就评论的数据
		*/
		private function createCommentSetUpdateInfo(){
			$data = array();
			$data['cendtime'] = getTime();
			$data['islastest'] = 0;
			return $data;
		}
		/*
		*俞鹏泽
		*创建新的评论的数据
		*/
		private function createNewCommentRateInfo($teacherID = null,$commentType = null,$rate = null){
			$data = array();
			if(is_null($teacherID) || is_null($commentType) || is_null($rate)){
				return $data;
			}

			import("Home.Action.GlobalValue.GlobalValue");
			$data['teacherID'] = $teacherID;
			$data['cstarttime'] = getTime();
			$data['cendtime'] = GlobalValue::initOrderPackageTime;
			$data['commenttype'] = $commentType;
			$data['rate'] = $rate;
			$data['islastest'] = 1;

			return $data;
		}
	}
