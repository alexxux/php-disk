<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>三度文件管理器</title>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>

</head>

<body>
	<div class="header">
		<!--目录显示-->
		<div class="path">当前目录：<a href="javascript:;" class="folder" path="<?=base64_encode($root)?>" name="/">root</a>/
	<?php 
		$c_dir = $root;
		foreach($dir_arr as $v){ 
	?>
			<a href="javascript:;" class="folder" path="<?=base64_encode($c_dir)?>" name="<?=$v?>"><?= iconv("gbk","utf-8",$v)?></a>/
	<?php 
		$c_dir .= '/'.$v;
	}
	?>
		</div>
	</div>
	<div class="main-body">
		<?php if(!$dirs && !$files){?>
			<div class="no-result">文件夹为空，请<a href="javascript:;" onclick="history.go(-1)">返回</a></div>
		<?php }?>
		<?php foreach($dirs as $v){?>
			<a class="item_folder item" href="javascript:;" title="<?=$v?>"><?=$v?></a>
		<?php };?>
		<?php foreach($types as $v){
			foreach($__files[$v] as $vv){
		?>
				<a class="item_<?=$v?> item item_file" href="javascript:;" title="<?=$v?>"><?=$vv?></a>
		<?php };?>
		<?php };?>
		<?php foreach($__files['other'] as $v){?>
				<a class="item_other item item_file" href="javascript:;" title="<?=$v?>"><?=$v?></a>
		<?php }?>
		<div class="clear"></div>
	</div>
	<form action="/xdisk.php" id="form" method="get">
		<input type="hidden" name="type" value="">
		<input type="hidden" name="dir" value="">
		<input type="hidden" name="val" value="">
	</form>
<script>
		$(function(){
			var w = window.innerWidth;
			
			var current_dir = "<?=$dir?>";
			/*
			function refresh(){
				$.get('/xdisk.php',{type:"getdata",dir:current_dir},function(data){
					var _html = "";
					data = JSON.parse(data)
					if(data.isempty){
						_html += '<div class="no-result">文件夹为空，请<a href="javascript:;" onclick="history.go(-1)">返回</a></div>';
					}else{
						console.log(data.folders)
						for(var x in data.folders){
							_html += '<a class="item_folder item" href="javascript:;" title="'+data.folders[x]+'">'+data.folders[x]+'</a>';
						}
						for(var x in data.types){
							var type = data.types[x];
							for(var xx in data.files[type]){
								var file = data.files[type][xx];
								_html += '<a class="item_'+type+' item item_file" href="javascript:;" title="'+file+'">'+file+'</a>';
							}
						}
						for(var x in data.files['other']){
								var file = data.files['other'][x];
								_html += '<a class="item_other item item_file" href="javascript:;" title="'+file+'">'+file+'</a>';
							}
					}
					_html+='<div class="clear"></div>';
					$('.main-body').html(_html);
					click_event();
					
				})
			}
			refresh()*/
			function click_event(){
				$(".item_folder,.folder").click(function(){
					$("#form").attr("target","_self");
					$("[name=type]").val("folder");
					$("[name=dir]").val(current_dir);
					$("[name=val]").val($(this).text());
					$("#form").submit();
					
					console.log($(this).text());
					
				})	
				$('.item_file').click(function(){
					$("#form").attr("target","_blank");
					$("[name=type]").val("file") ;
					$("[name=dir]").val(current_dir) ;
					$("[name=val]").val( $(this).text());
					$("#form").submit();
				})
				$('.folder').click(function(){
					$("#form").attr("target","_self");
					$("[name=type]").val("folder");
					$("[name=dir]").val($(this).attr("path"));
					$("[name=val]").val($(this).attr("name"));
					$("#form").submit();
				})
			}
		    
			click_event();
			
			/*
			$('#upload').click(function(){
				$.ajax({  
				    url : "/xdisk.php",  
				    type : "POST",  
				    data : new FormData($("#uploadform")[0]), 
				    cache: false, 
				    processData: false,
    				    contentType: false,
				     success : function(data) {  
				          if(data == "success"){
					          	refresh();
						  	$('[name=file]').val("");
					          	alert("上传成功");
				          }else{
					           alert(data)
				          }
				     },  
				     error : function(data) {  
				         alert("upload err");
				     }  
				});  
			})	
			
			*/
		});
	</script>






</body>
</html>