<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="Alex Xu"/>
        <title>三度云盘搜索</title>
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
		 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="xdisk/style.css"/>
	</head>

	<body>
	<div class="box">
		<div class="top">
			<div class="header">
				<div class="logo">
					<!--<a href="xdisk.php" style="text-decoration:none;">三度云盘搜索</a>-->
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
		</div>


			<div class="search_main">
				<?php 
					foreach($hfind_result as $k=>$v){
				?>
					<div class="item_other item">
						<a href="javascript:;" title="<?=$k?>" value="<?=$v?>"><?=$k?></a>
					</div>
				<?php		
					}
				?>
				<?php
					if(empty($hfind_result)){
				?>
					<div  class="item">
						<a href="javascript:;">没有搜索结果</a>
					</div>
				<?php
					}
				?>
			</div>

			<form action="/xdisk.php" id="form" method="get">
				<input type="hidden" name="type" value="">
				<input type="hidden" name="dir" value="">
				<input type="hidden" name="val" value="">
			</form>




		</div>
	</body>
	<script>
		
		$(".item_other").click(function(){
					$("#form").attr("target","_blank");
					$("#form [name=type]").val("file") ;
					$("#form [name=dir]").val($(this).find("a").attr("value"));
					$("#form [name=val]").val($(this).find("a").text());
					$("#form").submit();
					console.log($(this).find("a").attr("value"));
					console.log($(this).text());
				})
	</script>
</html>
