<?php if (!defined('THINK_PATH')) exit();?>    <html>
     <head>
       <title>Select Data</title>
     </head>
     <body>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><br>公司名称：<?php echo ($vo["uname"]); ?><br/>
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
		<img src=__UPLOADS__/<?php echo ($vo["imgfile4"]); ?> /><?php endforeach; endif; else: echo "" ;endif; ?>
     </body>
    </html>