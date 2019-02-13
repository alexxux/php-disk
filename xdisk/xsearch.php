		<?php 
		@$search_file=$_GET["search_file"];
		//$root = "../FTP";
		$root = "C:/FTP";		//演示环境
		
		$find_result=[];
		class search{
			function getAll($dir){
				$dir=iconv('utf-8','gbk',$dir);
				$fileArr=[];
				global $root;
				if(false!=$handle=opendir($dir)){
					while(false!=$file=readdir($handle)){
						if($file!='.'&& $file!='..'){
							$fullfile=$dir .'/' . $file;
							if(is_dir($fullfile)){
								$fullfile=iconv('gbk','utf-8',$fullfile);
								$file=iconv('gbk','utf-8',$file);
								$fileArr[$file]=$this->getAll($fullfile);
							}else{
								$file=iconv('gbk','utf-8',$file);
								//$fullfile=iconv('gbk','utf-8',$fullfile);
								if($dir==$root){
									//文件在根目录时
									$fileArr['root'][$file]=iconv('gbk','utf-8',$dir);
								}else{
									$fileArr[$file]=iconv('gbk','utf-8',$dir);
								}
							}
						}
					}
				}
				closedir($handle);
				return $fileArr;
			}//f getAll end
			
			/*
			//直接输出搜索结果
			function find($fileArr,$file){
					$s_result=false;
					echo "<div class='search_main'>";
					foreach($fileArr as $d){
						foreach($d as $k=>$v){
							if(strpos($k,$file)!==false && is_array($v)!=true){
								echo "<a href='javascript:;' class='item_file item' value='" . base64_encode($v) ."'>". $k . "</a><br/>";
								$s_result=true;
						}
					}
				}
				if(false==$s_result){
					echo "<a href='javascript:;' class='item'>没有搜索结果</a><br/>";
				}
					echo "</div>";
			}
			*/
			

			function find($fileArr,$file){
				global $find_result;
				if(empty($file)){
					return $find_result;
				}
				foreach($fileArr as $k=>$v){
					//如果是数组，递归
					if(is_array($v)){
						$this->find($v,$file);
					}else if(strpos($k,$file)!==false && is_array($v)!=true){
						$find_result[$k]=base64_encode(iconv("utf-8","gbk",$v));	
					}
				}
				return $find_result;
			}// f find end
			
			
			
		}//class search end
		
		$temp=new search();
		
		if(empty($_SESSION['fileArr'])){
					$_SESSION['fileArr']=$temp->getAll($root);
					$hfind_result=$temp->find($_SESSION['fileArr'],$search_file);
		}else{
					$hfind_result=$temp->find($_SESSION['fileArr'],$search_file);
					echo "<script>console.log('fileTemp')</script>";
					//echo "filetemp";
			
		}
	

		
		//清空服务器缓存
		if($search_file=="cleanfiletemp"){
			session_destroy();
		}

		/*
		echo "<pre>";
		print_r($_SESSION['fileArr']);
		echo "</pre>";
		*/

		require_once("search.php");

		?>