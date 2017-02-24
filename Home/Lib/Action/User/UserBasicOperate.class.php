<?php
    class UserBasicOperate extends Action{
        /*
        *俞鹏泽
        *根据参数进行用户信息的查询
        */
        //参数一:要查询的表名
        //参数二:用户ID号,参数三:账号,参数四:联系号码,参数五:邮箱     这些参数可以是数组,字符串,或者是单个值
        //查询时,按照先后的顺序一步一步查询

        //参数六:要查找的字段
        public function getUserInfo($tableName = null,$userID = null,$Account = null,$Phone = null,$Email = null,$Field = null){
            $condition = "";
            $fieldString = "(";
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

            if(!is_null($tableName)){
                $inquiry = new Model($tableName);
            }else{
                $inquiry = new Model();
            }

            if(!is_null($Field)){
                for ($i = 0; $i < count($Field); $i++) {
                    if($i == count($Filed)-1){
                        $fieldString = $fieldString.$Field[$i];
                    }else{
                        $fieldString = $fieldString.$Field[$i].",";
                    }
                }

                if(!empty($condition)){
                    $result = $inquiry->where($condition)->field($fieldString)->select();
                }else{
                    $result = $inquiry->field($fieldString)->select();
                }
            }else{
                if(!empty($condition)){
                    $result = $inquiry->where($condition)->select();
                }else{
                    $result = $inquiry->select();
                }
            }
            return $result;
        }

        /*
        *俞鹏泽
        *更新用户的数据
        */
        public function updateUserInfo($userID = null,$Account = null,$Data = null){
            $message = array();

            if(is_null($Data)){
                $message['status'] = false;
                $message['message'] = "要更新的用户的数据为空";
                return $message;
            }

            if(is_null($userID) && is_null($Account)){
                $message['status'] = false;
                $message['message'] = "没有该用户";
                return $message;
            }

            $inquiry = new Model('register');

            if(!is_null($userID)){
                $result = $inquiry->where("ID={$userID}")->save($Data);
            }else{
                $result = $inquiry->where("account={$Account}")->save($Data);
            }

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
        *删除用户
        */
        public function deleteUser($userID = null,$Account = null){
            $message = array();

            $inquiry = new Model('register');

            $result = $inquiry->where("ID={$userID} or account={$Account}")->delete($Data);

            if($result){
                $message['status'] = true;
                $message['message'] = "用户的数据成功删除";
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "用户的数据删除失败";
                return $message;
            }
        }

        /*
        *俞鹏泽
        *增加用户
        */
        public function addUser($Data = null){
            $message = array();

            if(is_null($Data)){
                $message['status'] = false;
                $message['message'] = "要添加的用户的数据为空";
                return $message;
            }

            $inquiry = new Model('register');

            $result = $inquiry->add($Data);

            if($result){
                $message['status'] = true;
                $message['message'] = "用户数据增添成功";
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "用户数据增添失败";
                return $message;
            }
        }

        /*
        *俞鹏泽
        *统计用户的数据
        */
        //参数一:必选是数组
        public function CountUserFieldData($Field = null){
            $message = array();
            $sql = "select ";

            if(is_null($Field)){
                $message['status'] = false;
                $message['message'] = "要统计的用户的字段为空";
                return $message;
            }
            foreach ($Field as $key => $value) {
                $sql = $sql."count($key='$value' or null) as $key,";
            }

            $sql = $sql."null ";

            $sql = $sql." from tp_register";

            $inquiry = new Model();

            $result = $inquiry->query($sql);

            return $result;

        }
    }

 ?>
