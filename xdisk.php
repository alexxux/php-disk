<?php
header("Content-type:text/html;charset=utf-8");
session_start();
if(@$_GET['type']=="file"){
	require_once("xdisk/down.php");
}else{
	if(@$_GET['type'] == "search"){
		require_once("xdisk/xsearch.php");
	}else{
		require_once("xdisk/xdisk.php");
	}
}
?>