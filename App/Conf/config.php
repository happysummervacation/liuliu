<?php
return array(
	//'配置项'=>'配置值'
	'URL_PATHINFO_DEPR'=>'/',  //url定界符设置
	'TMPL_L_DELIM'=>'<{',  //模板引擎普通标签开始标记
	'TMPL_R_DELIM'=>'}>',  //模板引擎普通标签结束标记

    // 'SHOW_PAGE_TRACE'=>true,  //开启页面调试
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
);
?>
