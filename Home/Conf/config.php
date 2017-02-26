<?php
return array(
	//'配置项'=>'配置值'
	'URL_PATHINFO_DEPR'=>'/',  //url定界符设置
	'TMPL_L_DELIM'=>'<{',  //模板引擎普通标签开始标记
	'TMPL_R_DELIM'=>'}>',  //模板引擎普通标签结束标记

    //'SHOW_PAGE_TRACE'=>true,  //开启页面调试
    // 'ERROR_MESSAGE' =>'发生错误!',  //错误信息显示

    'DB_DSN'=>'mysql://root:123456@localhost:3306/liuliu', //数据库连接配置
    'DB_PREFIX'=>'tp_',  //设置表前缀

    'DEFAULT_CHARSET'=>'utf8',  //设置默认编码

    '__UserImage__'=>__ROOT__.'/UserImage',   //设置自定义的路径
    '__Book__'=>__ROOT__.'/Book',   //定义教材存放路径
    // '__UploadFile__'=>__ROOT__.'/Public/plug-in/examples/simple',

    'LOG_RECORD'=>true,    //开启日志记录
    'LOG_LEVEL'=>'EMERG,ALERT,CRIT,ERR,WARN,NOTICE',   //记录的日志的内容等级
	'LOG_TYPE'=>3,   //记录方式
	'LOG_EXCEPTION_RECORD'=>true,  //记录异常信息日志
	'LOG_FILE_SIZE'=>1024*1024,

    //设置邮箱的配置
    'MAIL_ADDRESS'=>'17855833070@163.com',//'2722007440@qq.com', // 邮箱地址
    'MAIL_LOGINNAME'=>'17855833070@163.com',//2722007440@qq.com', // 邮箱登录帐号
    'MAIL_SMTP'=>'smtp.163.com',//'smtp.qq.com', // 邮箱SMTP服务器
    'MAIL_PASSWORD'=>'yupengze1995',//'winter@123', // 邮箱密码

    //短信发送的配置
    //短信账号
    'UID'=>'66speak',
    //短信密钥
    'KEY'=>'8c8396d18c820ba71465',

    /*支付宝的配置*/

    //合作者身份ID，即签约客户
    'partner' => '2088911561275180',
    //收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
    'seller_id' => '2088911561275180',
    //MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.html
    'key' => '8mfuu4k8kbhu6ucbxi6sqw9t1oe5wxgn',
    //服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    'notify_url' => 'http://localhost/liuliu/app.php/Alipay/notify_url',
    //页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    'return_url' => 'http://localhost/liuliu/app.php/Alipay/return_url',
    //签名方式
    'sign_type' => strtoupper('MD5'),
    //字符编码格式 目前支持 gbk 或 utf-8
    'input_charset' => strtolower('utf-8'),
    //ca证书路径地址，用于curl中ssl校验
    'cacert' => getcwd()."/cacert.pem",//'D:/wamp/www/AlipayTest/cacert.pem',
    //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
    'transport' => 'http',
    //支付类型
    'payment_type' => '1',
    //
    'service' => 'create_direct_pay_by_user',

    /*这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可*/
    //防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
    'anti_phishing_key' => "",
    //客户端的IP地址 非局域网的外网IP地址，如：221.0.0.1
    'exter_invoke_ip' => "",
);
?>
