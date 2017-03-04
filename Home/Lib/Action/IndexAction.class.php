<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
        // import("Home.Action.Mail.MailTo");
        // MailTo::PostMail("1436372607@qq.com","上课提醒","你晚上的课程不要忘了");
        $this->redirect('Login/Login');
    }
}
