<?php
	class UserOperate{
		/*
        *俞鹏泽
        *根据参数进行用户信息的查询
        */
        //参数一:要查询的表名
        //参数二:用户ID号,参数三:账号,参数四:联系号码,参数五:邮箱     这些参数可以是数组,字符串,或者是单个值
        //查询时,按照先后的顺序一步一步查询

        //参数六:要查找的字段
        public static function getUserInfo($tableName = null,$userID = null,$Account = null,$Phone = null,$Email = null,$Field = null){
            $condition = "";
            $fieldString = "";
            $inquiry = null;
            $result = null;

            if(!is_null($userID)){
                if(is_array($userID)){
                    for ($i = 0; $i < count($userID); $i++) {
                        if($i == count($userID)-1){
                            $condition = $condition."ID=$userID[$i])";
                        }else{
                            $condition = $condtion."ID=$userID[$i] or ";
                        }
                    }
                }elseif (is_string($userID) || is_numeric($userID)) {
                    $condition = "ID=".(int)$userID;
                }
            }elseif(!is_null($Account)) {

                if(is_array($Account)){
                    for ($i = 0; $i < count($Account); $i++) {
                        if($i == count($userID)-1){
                            $condition = $condition."account='$Account[$i]')";
                        }else{
                            $condition = $condtion."account='$Account[$i]' or ";
                        }
                    }
                }elseif (is_string($Account)) {
                    $condition = "account='$Account'";
                }
            }elseif(!is_null($Phone)) {
                if(is_array($Phone)){
                    for ($i = 0; $i < count($Phone); $i++) {
                        if($i == count($userID)-1){
                            $condition = $condition."phone='$Phone[$i]')";
                        }else{
                            $condition = $condtion."phone='$Phone[$i]' or ";
                        }
                    }
                }elseif (is_string($Phone)) {
                    $condition = "phone='$Phone'";
                }
            }elseif(!is_null($Email)) {
                if(is_array($Email)){
                    for ($i = 0; $i < count($Email); $i++) {
                        if($i == count($userID)-1){
                            $condition = $condition."email='$Email[$i]')";
                        }else{
                            $condition = $condtion."email='$Email[$i]' or ";
                        }
                    }
                }elseif (is_string($Phone)) {
                    $condition = "email='$Email'";
                }
            }

			import("BackStage.Action.DBConfig.Config");
            if(!is_null($tableName)){
                $inquiry = new Model($tableName,Config::$frefix,Config::$db_config);
            }else{
                $inquiry = new Model('',Config::$frefix,Config::$db_config);
            }

            $fieldString = "";
            if(is_array($Field)){
                for ($i = 0; $i < count($Field); $i++) {
                    if($i == count($Field)-1){
                        $fieldString = $fieldString.$Field[$i];
                    }else{
                        $fieldString = $fieldString.$Field[$i].",";
                    }
                }
            }elseif(is_string($Field)){
                $fieldString = $Field;
            }else{
                $fieldString = null;
            }

            if(!is_null($fieldString)){
               if(!empty($condition)){
                   $result = $inquiry->where($condition)->field($fieldString)->select();
               }else{
                   $result = $inquiry->field($fieldString)->select();
               }
           }else{
              if(!empty($condition)){
                   $result = $inquiry->where($condition)->select();
               }else{
                   $result = $inquiry->field($fieldString)->select();
               }
           }
            return $result;
        }
	}
