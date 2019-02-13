<?php
//关闭错误提醒
error_reporting(0) ;
//默认的目录
//$root = "../FTP";
$root = "C:/FTP";	//演示环境
//读取文件时间
date_default_timezone_set("PRC");


class xdisk{
	public $dirs=[];
	public $files=[];
	public $dir="";
	public function find($dir){
		if(!$dir||!is_dir($dir)) return;	
		
		//$this->dir= iconv("gbk","utf-8",$dir);
		//$dir是gbk编码
		$this->dir=$dir;
		return this;
	}

	public function getDirs(){
		if(false!=($handle=opendir($this->dir))&&$this->dir){
			$i=0;
			while(false!==($file=readdir($handle))){
				if($file!="." && $file!=".."&&!strpos($file,".")){
					//html显示使用utf-8编码
					$dirArray[$i]=iconv("gbk","utf-8",$file);
					$i++;
				}		
			}
			closedir($handle);
		}
		 $this->files = $dirArray;
		 return $dirArray;
	}
	
	
	
		public function getFiles() {
	    if (false != ($handle = opendir ( $this->dir ))  && $this->dir ) {
	        $i=0;
	        while ( false !== ($file = readdir ( $handle )) ) {
	            if ($file != "." && $file != ".."&&strpos($file,".")) {
	                $fileArr[$i]=iconv("gbk","utf-8",$file);
					$filepath=$this->dir .'/'. $file;
					//$fmtime=date("Y-m-d H:i:s",filemtime($filepath));
					//$fmtime=date("Y-m-d H:i",filemtime($filepath));
					$fmtime=date("Y-m-d",filemtime($filepath));
					$fileArrm[$fileArr[$i]]=$fmtime;
	                if($i==1000){
	                    break;
	                }
					
	                $i++;
	            }
	        }
	        closedir($handle);
	    }
	    $this->files = fileArrm;

	    //return $fileArray;
		return $fileArrm;

	}	
}//class xdisk end





//获取文件列表
$xdisk= new xdisk();
$ultra="JXU2NThD";
if($_GET['type'] == "folder" || $_GET['type'] == "getdata"){
	//路径 将utf-8转为gbk
	$dir=iconv("utf-8","gbk", $_GET['dir']);
	$dir = base64_decode($dir);
	if(substr($dir,-1) != "/") $dir.="/";

	$folder = iconv("utf-8","gbk", $_GET['val']);
	Console.log($folder);
	
	if(!$dir) die("参数错误");
	$xdisk->find($dir.$folder);
}else{
	$xdisk->find(iconv("utf-8","gbk",$root));
}
$files = $xdisk->getFiles();
	
	

//文件分类
//$types=["php","js","css","txt","html"];
$types=["rar","zip","7z","sql","doc","docx","ppt","pptx","pdf","txt","exe","pkg","jpg","png","apk"];
$__files=[];
$__files['other']=[];
foreach($types as $v){
	$__files[$v]=[];
}
	
foreach($files as $k=>$v){
	$exp=end(explode(".",$k)); //扩展名
	if(in_array($exp,$types)){
		$__files[$exp][$k]=$v;
	}else{
		$__files["other"][$k]=$v;
	} 
}

$dirs = $xdisk->getDirs();
array_filter($dirs);
array_filter($__files);

$real_dir=$xdisk->dir;
$show_dir=str_replace($root,'',$real_dir);	//root从路径删除
$dir_arr = explode('/',$show_dir);
$dir_arr = array_filter($dir_arr);
$dir=base64_encode(($xdisk->dir));

if($_GET['type']=="getdata"){
	$isempty = 0;
	if(!$files && !$dirs) $isempty = 1;
	$data = array(
		"folders"=>$dirs,
		"types"=>$types,
		"files"=>$__files,
		"isempty"=>$isempty,
	);
	echo $data;
	Console.log($data);
	echo json_encode($data);
}else{
	require_once("xhtml.php");
}

	
?>
