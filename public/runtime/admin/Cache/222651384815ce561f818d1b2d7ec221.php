<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo conf("APP_NAME");?><?php echo l("CACHE_INDEX");?></title>
<script type="text/javascript" src="__ROOT__/public/runtime/admin/lang.js"></script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/style.css" />
<script type="text/javascript" src="__TMPL__Common/js/jquery.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/cache.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.bgiframe.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.weebox.js"></script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/weebox.css" />
</head>

<body>
	<div class="main">
	<div class="main_title"><?php echo L("CACHE_INDEX");?>	</div>
	<div class="blank5"></div>
	<table class="form" cellpadding=0 cellspacing=0>
		<tr>
			<td colspan=2 class="topTd"></td>
		</tr>
		
		<tr>
			<td class="item_title" style="width:200px;">
				<input type="button" class="button ajaxclear" value="清空图片缓存"  rel="<?php echo u("Cache/clear_image");?>"/>
			</td>
			<td class="item_input">
				清空前台图片的各种规格缓存
			</td>
		</tr>
		
		<tr>
			<td class="item_title" style="width:200px;">
				<input type="button" class="button ajaxclear" value="清空后台缓存" rel="<?php echo u("Cache/clear_admin");?>" />
			</td>
			<td class="item_input">
				清空程序的后台缓存
			</td>
		</tr>
		
		<tr>
			<td class="item_title" style="width:200px;">
				<input type="button" class="button ajaxclear" value="清空脚本样式缓存"  rel="<?php echo u("Cache/clear_parse_file");?>"/>
			</td>
			<td class="item_input">
				清空网站的javascript以及CSS样式缓存文件
			</td>
		</tr>		
		
		<tr>
			<td class="item_title" style="width:200px;">
				<input type="button" class="button ajaxclear" value="清空所有数据缓存"  rel="<?php echo u("Cache/clear_data",array("is_all"=>1));?>"/>
			</td>
			<td class="item_input">
				清空程序的所有数据缓存
			</td>
		</tr>

		<tr>
			<td colspan=2 class="bottomTd"></td>
		</tr>
	</table>	
	</div>
</body>
</html>