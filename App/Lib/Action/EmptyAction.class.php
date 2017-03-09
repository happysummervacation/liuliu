<?php
	class EmptyAction extends Action{
    	public function index(){
    		echo "访问路径出错";
    	}

    	//空操作访问
        public function _empty(){
            echo "访问路径出错";
        }
    }