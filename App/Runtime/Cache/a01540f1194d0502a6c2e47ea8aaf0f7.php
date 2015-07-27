<?php if (!defined('THINK_PATH')) exit();?>﻿
<head>
        <title>公告详情</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="generator" content="anticode" />
        <meta name="author" content="anticode"/>
        <link rel="stylesheet" href="__ROOT____THM__/bootstrap/easyui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="__ROOT____THM__/icon.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="__ROOT____CSS__/login.css" type="text/css" media="screen" />
        <script type="text/javascript" src="__ROOT____JS__/core/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="__ROOT____JS__/core/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="__ROOT____JS__/locale/easyui-lang-zh_CN.js"></script>

    </head>
<center>
 <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h2>公告标题：<?php echo ($vo["ntitle"]); ?></h2>
	<p></p>
<div class="easyui-panel" title="公告详情" style="width:800px;padding:30px 60px">

	<h2>公告内容：</h2></br><?php echo ($vo["htext"]); ?>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
</center>