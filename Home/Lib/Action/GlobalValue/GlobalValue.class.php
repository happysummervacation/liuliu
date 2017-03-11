<?php
	class GlobalValue{
		const initOrderPackageTime = 2145888000;     //表示是2038-1-1

		const beforeTime = 7;   //表示前7天
		const afterTime = 7;    //表示后7天

		const notClass = "notClass";   //表示没有上课
		const haveClass = "haveClass";   //表示正常上课

		const dayComment = '0';   //表示评论的类型是日评

		const teaComment = '0';   //表示评论的结果是教师完成评论
		const teaNotComment = '1';   //表示教师没有完成评论
		const autoComment = '2';    //表示自动完成评论
		const teaStillNotComment = '3';  //表示教师还没有进行评论

		const teaNeedComment = '0';   //表示教师需要进行评论
		const teaNotNeedComment = '1';  //表示教师不需要进行评论
	}
 ?>
