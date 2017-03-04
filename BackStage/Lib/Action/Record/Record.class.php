<?php
	class Record {
		//$txt是输入的内容是要记录的内容，$time是记录的时间，默认是当前时间
		//该函数用来记录错误的日志信息
		public static function CreateLog($txt,$time = ""){
			import('Home.Action.PublicFunction.PublicFunction');
			//如果输入的时间为空就默认使用当前的日期
	    	if("" == $time){
	    		$time = PublicFunction::GetTime();
	    	}

	    	$root_path = substr(__FILE__,0,strpos(__FILE__, 'liuliu3')+7);
			//这里正式做的时候要改成   strpos(__FILE__, 'liuliu')+6

	    	$year = date('Y',$time);
	    	$month = date('m',$time);
	    	$day = date('d',$time);

	    	//判断是否存在指定的文件夹
	    	if(!file_exists($root_path."/BackStageLog")){
	    		if(!mkdir($root_path."/BackStageLog")){
	    			echo date('Y-m-d H:i:s',$time)."               不能创建BackStageLog文件夹";
	    			return false;
	    		}
	    	}
	   		if(!file_exists($root_path."/BackStageLog/$year/$month/$day")){
	   			if(!mkdir($root_path."/BackStageLog/$year/$month/$day",0777,true)){
	   				echo date('Y-m-d H:i:s',$time)."              不能创建BackStageLog下的{$year}下的{$month}下的{$day}的文件夹";
	   				return false;
	   			}
	   		}
	        try{
	            $filename = $root_path."/BackStageLog/$year/$month/$day/".date('Y-m-d',$time)."-".md5(date('Y-m-d',$time));
	            if(!file_exists($filename)){
	                if(!touch($filename)){
	                	echo date('Y-m-d H:i:s',$time)."                        创建错误日志记录文件失败";
	                	return false;
	                }
	            }
	            $txt = date('Y-m-d H:i:s',$time)."       ".$txt."\n";
	            if(!file_put_contents($filename,$txt,FILE_APPEND | LOCK_EX)){
	            	echo date('Y-m-d H:i:s',$time)."                           日志记录错误";
	            	return false;
	            }
	        }catch(Exception $e){
	            echo date('Y-m-d H:i:s',$time)."                            错误日志记录有问题";
	            return false;
	        }
		}
	}
