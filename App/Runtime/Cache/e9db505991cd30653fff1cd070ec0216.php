<?php if (!defined('THINK_PATH')) exit();?>    <html>
    <head>
        <title>详细信息</title>
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
	
	<script>
	function clearForm(uid){
		var myurl='/gys/undocheck?uid='+ uid
		window.open(myurl);
		//alert("1111");
	}
	</script>
	
     <body>
	 <center>
	 <div class="easyui-panel" title="供应商详情" style="width:800px;padding:30px 60px">
	 
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm(<?php echo ($vo["uid"]); ?>)">弃审</a>
        <br>公司名称：<?php echo ($vo["uname"]); ?><br/>
		<br>账号：<?php echo ($vo["account"]); ?><br/>
		<br>邮箱：<?php echo ($vo["mail"]); ?><br/>
		<br>联系人：<?php echo ($vo["company"]); ?><br/>
		<br>联系电话：<?php echo ($vo["telephone"]); ?><br/>
		<br>公司地址：<?php echo ($vo["address"]); ?><br/>
		<br><br/>
		
		<img src=__UPLOADS__/<?php echo ($vo["imgfile1"]); ?> />
		<br/>
		<img src=__UPLOADS__/<?php echo ($vo["imgfile2"]); ?> />
		<br/>
		<img src=__UPLOADS__/<?php echo ($vo["imgfile3"]); ?> />
		<br/>
		<!--
		<img src=__UPLOADS__/<?php echo ($vo["imgfile4"]); ?> />
		--><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</center>		
     </body>

	

	    </html>