<?php
error_reporting(0);
//设置脚本时间 下载大文件
set_time_limit(0);
$support_type=["rar","zip","7z","sql","doc","docx","ppt","pptx","pdf","txt","exe","pkg","jpg","png"];
if($_GET['type']=="file"){
	$dir=base64_decode($_GET['dir']);
	$file = iconv("utf-8","gbk", $_GET['val']);
		if(!$dir || !$file) die("参数错误");
		$exp = end(explode('.',$file));
		if(!in_array(strtolower($exp),$support_type)) {
		echo "<script>alert(\"禁止下载此类型\");</script>";
		echo "<script>window.open(\" \", '_self'); window.close();</script>";
		exit;
		}
		
		$__file = $dir.'/'.$file;
		if(($__file)){
			header('content-type:application/octet-stream'); 
			header('Accept-Ranges:bytes');
			$filesize=filesize($__file);
			console.log($filesize);
			header("Content-Length: ".$filesize);
			//告诉浏览器保存的文件名称
			header("content-disposition:attachment;filename=".$file);
			
			//设置缓冲区
			$read_buffer=2048;
			//打开二进制文件
			$handle=fopen($__file,'rb');
			//总缓冲区
			$sum_buffer=0;
			//当到达文件末尾或总缓冲区小于文件大小
			while(!feof($handle)&&$sum_buffer<$filesize){
				//每次以4096读取输出文件
				echo fread($handle,$read_buffer);
				$sum_buffer+=$read_buffer;
			}
			fclose($handle);
			exit;
			
		}
}
?>