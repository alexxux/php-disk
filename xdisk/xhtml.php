<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Alex Xu"/>
<title>三度云盘</title>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<!--[if IE 8]>
<script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.1/jquery.js"></script>
<![endif]-->
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="xdisk/style.css"/>
</head>

<body>
	<div class="box">
		<div class="top">
			<div class="header">
				<div class="logo">
					<a href="xdisk.php"><img src="xdisk/img/sumdoo.png" width=auto height="35px"/></a>
					
				</div>
			<div class="search">
				<form class="search_bar form-inline" action="/xdisk.php" method="get">
					<input type="hidden" name="type" value="search"/>
					<input type="text"  class="search_text form-control" name="search_file"/>
					<input type="submit"  class="search_sub btn" value="搜索"/>
				</form>
			</div>
		</div>
	
		<div class="path">当前目录：<a href="javascript:;" class="folder"  path="<?=base64_encode($root)?>" name="/">SUMDOO</a>>
			<?php 
				$c_dir = $root;
				foreach($dir_arr as $v){ 
			?>
					<a href="javascript:;" class="folder" path="<?=base64_encode($c_dir)?>" name="<?= iconv("gbk","utf-8",$v)?>"><?= iconv("gbk","utf-8",$v)?></a>>
			<?php 
				$c_dir .= '/'.$v;
			}
			?>
		</div>
	</div>
	<div class="main">
		<?php if(!$dirs && !$files){?>
			<div class="no-result">文件夹为空，请<a href="javascript:;" onclick="history.go(-1)">返回</a></div>
		<?php }?>
	
		
		<?php foreach($dirs as $v){?>
			<div class="item_folder item">
				<a href="javascript:;" title="<?=$v?>"><?=$v?></a>
			</div>
		<?php };?>
		
		<?php foreach($types as $v){
			foreach($__files[$v] as $fk=>$fv){
		?>
			<div class="item_<?=$v?> item item_file">
				<a href="javascript:;" title="<?=$fk?>"><?=$fk?></a>
				<span><?=$fv ?></span>
			</div>
		<?php };?>
		<?php };?>
		
		<?php foreach($__files['other'] as $fk=>$fv){?>
			<div class="item_other item item_file">
				<a href="javascript:;" title="<?=$fk?>"><?=$fk?></a>
				<span><?=$fv ?></span>
			</div>
				
		<?php }?>
		<div class="clear"></div>
	</div>
	<form action="/xdisk.php" id="form" method="get">
		<input type="hidden" name="type" value="">
		<input type="hidden" name="dir" value="">
		<input type="hidden" name="val" value="">
	</form>
	
</div>

</body>

<script type="text/javascript">
	$(function(){
		
			var current_dir="<?=$dir?>";
			function click_event(){
				$(".item_folder").click(function(){
					$("#form").attr("target","_self");
					$("#form [name=type]").val("folder");
					$("#form [name=dir]").val(current_dir);
					$("#form [name=val]").val($(this).find("a").text());
					$("#form").submit();
					//console.log($(this).text());
					
				})	
				
				$('.item_file').click(function(){
					$("#form").attr("target","_blank");
					$("#form [name=type]").val("file") ;
					$("#form [name=dir]").val(current_dir) ;
					$("#form [name=val]").val($(this).find("a").text());
					$("#form").submit();
					//console.log($(this).text());
				})
				$('.folder').click(function(){
					$("#form").attr("target","_self");
					$("#form [name=type]").val("folder");
					$("#form [name=dir]").val($(this).attr("path"));
					$("#form [name=val]").val($(this).attr("name"));
					$("#form").submit();
				})
			}
		    
			click_event();
		});
</script>
</html>