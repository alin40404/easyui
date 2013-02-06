<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"

        "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>easyui app</title>
	<link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/js/jquery-easyui-1.3.1/themes/<?php echo (($_COOKIE["easyuiThemeName"])?($_COOKIE["easyuiThemeName"]):"sunny"); ?>/easyui.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/jquery-easyui-1.3.1/themes/windows/app.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/jquery-easyui-1.3.1/themes/icon.css">
	<script type="text/javascript" src="__PUBLIC__/js/jquery-easyui-1.3.1/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/jquery-easyui-1.3.1/jquery.easyui.min.js"></script>
		

    <script type="text/javascript" src="__PUBLIC__/js/jquery-easyui-1.3.1/jquery.app.js" charset="utf-8"></script>
	<script type="text/javascript">
    $(function(){
       if($.browser.msie && parseInt($.browser.version) < 8){ 
          $.messager.alert("温馨提示","您当前正在使用的是IE"+$.browser.version+"。该程序支持<a style='color:green' target='_blank' href='http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home'>IE8.0</a>以上版本及谷歌，火狐..");
	}
	});
  </script>
    <script type="text/javascript" src="__TMPL__/Index/initApp.js" charset="utf-8"></script>
</head>
<body>

</body>
</html>