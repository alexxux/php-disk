<?php
header("Content-type:text/html;charset=utf-8");
session_start();
if(@$_GET['type']=='file'){
	require_once("xdisk/downfile.php");
}else{
	require_once("xdisk/xdisk.php");
}




?>