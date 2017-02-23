<?php
		/*
		*俞鹏泽
		*获取中国时间
		*/
		function getTime(){
			  //设置中国时间
			  date_default_timezone_set("PRC");
			  //返回时间戳
			  return time();
		}

		/*
		*俞鹏泽
		*划分url,获取url中的各个部分的信息
		*/
		function path_info($filepath){
        $path_parts = array();
        $path_parts ['dirname'] = rtrim(substr($filepath, 0, strrpos($filepath, '/')),"/")."/";
        $path_parts ['basename'] = ltrim(substr($filepath, strrpos($filepath, '/')),"/");
        $path_parts ['extension'] = substr(strrchr($filepath, '.'), 1);
        $path_parts ['filename'] = ltrim(substr($path_parts ['basename'], 0, strrpos($path_parts ['basename'], '.')),"/");
        return $path_parts;
    }

		/*
		*俞鹏泽
		*获取某年,某月的开始时间与结束时间
		*/
		function getMonthStartEndTimeWithTime($year,$month){
        $year = (int)$year;
        $month = (int)$month;

        if($year == "" || $month == ""){
        	return null;
        }

        $this_month_start_time = strtotime(date("$year-$month-01 00:00:00",getTime()));
        $this_month_end_time = strtotime(date('Y-m-d H:i:s',$this_month_start_time)." +1 month");
        $arr = array();
        array_push($arr, $this_month_start_time,$this_month_end_time);
        return $arr;
    }

		/*
		*俞鹏泽
		*获取当前的月的开始时间与结束时间
		*/
		function getThisMonthStartEndTime(){
        $this_month_start_time = strtotime(date('Y-m-01 H:i:s', strtotime(date("Y-m-d",getTime()))));
        $this_month_end_time = strtotime(date('Y-m-d H:i:s',$this_month_start_time)." +1 month");
        $arr = array();
        array_push($arr, $this_month_start_time,$this_month_end_time);
        return $arr;
    }

		/*
		*俞鹏泽
		*根据一个时间点与一段时间获取下一个时间点的时间戳
		*/
		function getEndTimeWithTimeAndPeriod($time = "",$period = ""){
    	  if("" == $time || "" == $period){
    	  	return null;
    	  }
      	$time = date('Y-m-d H:i:s',$time);
      	return strtotime("$time $period month");
    }

		/*
		*俞鹏泽
		*获取莫一天的开始时间与结束时间
		*/
		function GetOneDayStartEndTime($time = null){
			if($time == null){
				return null;
			}else{
				$OnedayStartTime = strtotime(date('Y-m-d',$time));
				$OnedayEndTime = strtotime(date('Y-m-d H:i:s',$OnedayStartTime)." +1 day");
				$arr = array();
				array_push($arr,$OnedayStartTime,$OnedayEndTime);
				return $arr;
			}
		}

		/*
		*俞鹏泽
		*上传单个文件
		*/
		//参数一:文件路径
		//参数二:文件大小
		//参数三:文件的类型.必须是数组
		function UploadOneFile($Path = null,$fileSize = null,$fileType = null){
			$message = array();
			if(is_null($Path)){
				$message['status'] = false;
				$message['message'] = "文件路径没有指定";
				return $message;
			}
			if(is_null($fileSize)){
				$message['status'] = false;
				$message['message'] = "文件大小限定没有指定";
				return $message;
			}
			if(is_null($fileType)){
				$message['status'] = false;
				$message['message'] = "文件类型限定没有指定";
				return $message;
			}

			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = $fileSize ;// 设置附件上传大小
			$upload->allowExts  = $fileType;// 设置附件上传类型
			$upload->savePath =  $Path;// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				$message['status'] = false;
				$message['message'] = $upload->getErrorMsg();
				return $message;
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				return $info;
			}
		}

		/*
		*俞鹏泽
		*下载单个文件
		*/
		function downloadOneFile($filePath = null,$fileType = "txt",$fileName = "download"){
			//如果文件名是null就直接返回
			if(is_null($filePath)){
				echo "文件路径错误";
				return;
			}

			//如果存在文件就直接进行下载
			if(file_exists($filePath)){
				header("Content-type:application/".$fileType);
				header("Content-Disposition:attachment;filename='{$fileName}.{$fileType}'");

				$myfile = fopen($filePath,"r");
				while(!feof($myfile)){
					echo fgets($myfile);
				}
				fclose($myfile);
			}else{
				echo "文件不存在";
				return;
			}
		}

		/*
		*俞鹏泽
		*创建课程顾问动作日志记录
		*/
		function createActionLog($txt = "",$time = null){
			//如果输入的时间为空就默认使用当前的日期
	    	if(is_null($time)){
	    		$time = getTime();
	    	}
	    	$year = date('Y',$time);
	    	$month = date('m',$time);
	    	$day = date('d',$time);

	    	if(!file_exists("./Record/$year/$month/$day")){
	    		if(!mkdir("./Record/$year/$month/$day",0777,true)){
	    			echo "can not create /Record/$year/$month/$day";
	    			return false;
	    		}
	    	}

	        try{
	            $filename = "./Record/$year/$month/$day/".date('Y-m-d',$time)."-".md5(date('Y-m-d',$time));
	            if(!file_exists($filename)){
	                if(!touch($filename)){
	                	echo "创建错误日志记录文件失败";
	                	return false;
	                }
	            }
	            $txt = date('Y-m-d H:i:s',$time)."       ".$txt."\n";
	            if(!file_put_contents($filename,$txt,FILE_APPEND | LOCK_EX)){
	            	echo "敏感记录错误";
	            	return false;
	            }
	        }catch(Exception $e){
	            echo "敏感日志记录有问题";
	            return false;
	        }
		}

		/*
		*俞鹏泽
		*错误的日志记录
		*/
		function createErrorLog($txt = "",$time = null){
			//如果输入的时间为空就默认使用当前的日期
	    	if(is_null($time)){
	    		$time = getTime();
	    	}
	    	$year = date('Y',$time);
	    	$month = date('m',$time);
	    	$day = date('d',$time);
	    	//判断是否存在指定的文件夹
	    	if(!file_exists("./ErrorLog")){
	    		if(!mkdir("./ErrorLog",0777,true)){
	    			echo "不能创建ErrorLog文件夹";
	    			return false;
	    		}
	    	}
	    	if(!file_exists("./ErrorLog/$year/$month/$day")){
	    		if(!mkdir("./ErrorLog/$year/$month/$day",0777,true)){
	    			echo "./ErrorLog/$year/$month/$day";
	    			return false;
	    		}
	    	}

	        try{
	            $filename = "./ErrorLog/$year/$month/$day/".date('Y-m-d',$time)."-".md5(date('Y-m-d',$time));
	            if(!file_exists($filename)){
	                if(!touch($filename)){
	                	echo "创建错误日志记录文件失败";
	                	return false;
	                }
	            }
	            $txt = date('Y-m-d H:i:s',$time)."       ".$txt."\n";
	            if(!file_put_contents($filename,$txt,FILE_APPEND | LOCK_EX)){
	            	echo "日志记录错误";
	            	return false;
	            }
	        }catch(Exception $e){
	            echo "错误日志记录有问题";
	            return false;
	        }
		}

		/*
		*俞鹏泽
		*支付宝的日志记录
		*/
		/*
		*俞鹏泽
		*用来记录用户的支付记录
		*/
		function AlipayLog($txt = "",$time = null){
			//如果输入的时间为空就默认使用当前的日期
	    	if(is_null($time)){
	    		$time = getTime();
	    	}
	    	$year = date('Y',$time);
	    	$month = date('m',$time);
	    	$day = date('d',$time);
	    	//判断是否存在指定的文件夹
	    	if(!file_exists("./AlipayRecord")){
	    		if(!mkdir("./AlipayRecord",0777,true)){
	    			echo "不能创建AlipayRecord文件夹";
	    			return false;
	    		}
	    	}

	    	if(!file_exists("./AlipayRecord/$year/$month/$day")){
	    		if(!mkdir("./AlipayRecord/$year/$month/$day",0777,true)){
	    			echo "./AlipayRecord/$year/$month/$day";
	    			return false;
	    		}
	    	}

	        try{
	            $filename = "./AlipayRecord/$year/$month/$day/".date('Y-m-d',$time)."-".md5(date('Y-m-d',$time));
	            if(!file_exists($filename)){
	                if(!touch($filename)){
	                	echo "创建用户支付日志记录文件失败";
	                	return false;
	                }
	            }
	            $txt = date('Y-m-d H:i:s',$time)."       ".$txt."\n";
	            if(!file_put_contents($filename,$txt,FILE_APPEND | LOCK_EX)){
	            	echo "用户支付日志记录错误";
	            	return false;
	            }
	        }catch(Exception $e){
	            echo "用户支付日志记录有问题";
	            return false;
	        }
		}
