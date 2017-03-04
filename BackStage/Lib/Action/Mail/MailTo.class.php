<?php
    //该类就是用来发邮件
	class MailTo{
		private static $MAIL_ADDRESS = '17855833070@163.com';
		private static $MAIL_SMTP = 'smtp.163.com';
		private static $MAIL_LOGINNAME = '17855833070@163.com';
		private static $MAIL_PASSWORD = 'yupengze1995';
		//发送邮件的方法   使用smtp服务
		//邮件发送成功，返回true
		//邮件发送失败，返回false
		public static function PostMail($address,$title,$message){
			import('ORG.Net.PHPMailer');
			$mail=new PHPMailer();
			// 设置PHPMailer使用SMTP服务器发送Email
			$mail->IsSMTP();
			// 设置邮件的字符编码，若不指定，则为'UTF-8'
			$mail->CharSet='UTF-8';
			// 添加收件人地址，可以多次使用来添加多个收件人
			$mail->AddAddress($address);
			// 设置邮件正文
			$mail->Body=$message;
			// 设置邮件头的From字段。
			$mail->From=self::$MAIL_ADDRESS;
			// 设置发件人名字
			$mail->FromName='zyimm';
			// 设置邮件标题
			$mail->Subject=$title;
			// 设置SMTP服务器。
			$mail->Host=self::$MAIL_SMTP;
			// 设置为“需要验证”
			$mail->SMTPAuth=true;
			// 设置用户名和密码。
			$mail->Username=self::$MAIL_LOGINNAME;
			$mail->Password=self::$MAIL_PASSWORD;
			// 发送邮件。
			$result = $mail->Send();

			if($result){
				return true;
			}else{
				return false;
			}
		}
	}
