<?php
//关闭错误提醒
error_reporting(0) ;
//默认的目录
$root = "../WWW";

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
	    //$fileArray[]=NULL;
	    if (false != ($handle = opendir ( $this->dir ))  && $this->dir ) {
	        $i=0;
	        while ( false !== ($file = readdir ( $handle )) ) {
	            if ($file != "." && $file != ".."&&strpos($file,".")) {
	                $fileArray[$i]=iconv("gbk","utf-8",$file);
					
	                if($i==1000){
	                    break;
	                }
					
	                $i++;
	            }
	        }
	        closedir($handle);
	    }
	    $this->files = $fileArray;
	    return $fileArray;
	}	
}//class xdisk end



//获取文件列表
$xdisk= new xdisk();
if($_GET['type'] == "folder" || $_GET['type'] == "getdata"){
	//路径 将utf-8转为gbk
	$dir=iconv("utf-8","gbk", $_GET['dir']);
	
	$dir = base64_decode($dir);
	
	if(substr($dir,-1) != "/") $dir.="/";
	
	//文件夹名
	$folder = iconv("utf-8","gbk", $_GET['val']);
	
	echo  iconv("gbk","utf-8",$folder);
	
	
	if(!$dir) die("参数错误");
	$xdisk->find($dir.$folder);
}else{
	$xdisk->find(iconv("utf-8","gbk",$root));
}
$files = $xdisk->getFiles();
	
	
	
?>
