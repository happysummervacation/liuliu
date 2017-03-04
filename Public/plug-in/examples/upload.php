<?php
//dirname( __FILE__ )
function upload(){
	if ( !empty( $_FILES ) ) {

    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    $uploadPath =  dirname( __FILE__ ). DIRECTORY_SEPARATOR . simple . DIRECTORY_SEPARATOR .'Upload' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
	
	$text = fopen('a.txt','w') or die('没有该文件');
	fwrite($text, $uploadPath);
	fclose($text);

    $result = move_uploaded_file( $tempPath, $uploadPath );
    if($result){
		/*
	    $answer = array( 'answer' => 'File transfer completed' );
	    $json = json_encode( $answer );

	    echo $json;
		*/
	}else{
		echo "文件上传失败";
	}


} else {

    echo 'No files';

}
}

upload();

?>