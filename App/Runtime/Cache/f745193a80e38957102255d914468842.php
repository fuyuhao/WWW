<?php if (!defined('THINK_PATH')) exit();?>﻿


	<script>

		function submitForm(){
		//var userName= document.getElementById("account").value;
		var pwd = document.getElementById("password").value;
		var repwd = document.getElementById("password2").value;
		if(pwd==""||repwd==""){
		alert("密码必须填写！");
		return false;
		}
		if (pwd != repwd) {
		alert("两次密码输入不相同！");
		return false;
		}
			$('#ff').submit(); 
			alert("修改成功！");
		}
		function clearForm(){
			$('#ff').form('clear');
		}
		
		function myimage(myid){
		viewDialog = $.dialog({
        title: '上传图片',
        href: _ROOT_ + '/grxx/upimage?id='+myid,
        width: 300,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: doSubmit
            }]
			});
		}
		
	function doSubmit() {
		$('#bt_upimage_from').submit();
		alert("上传成功！");
		viewDialog.dialog('close');
	}

		

		
		
	</script>
	
	<iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe> 

<center>
	<h2>修改个人信息</h2>
	<p></p>
	<form method="post" id="ff" action="/grxx/saveuser" target="id_iframe"  enctype="multipart/form-data">  
	<div style="margin:20px 0;"></div>
	<div class="easyui-panel" title="修改个人信息" style="width:400px;padding:30px 60px">
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">密码：</div>
			<input class="easyui-validatebox  password form-textbox" type="password" name="password" id="password" style="width:100%" >
		</div>
		
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">确认密码：</div>
			<input class="easyui-validatebox  password form-textbox" type="password" name="repassword" id="password2" style="width:100%" >
		</div>
	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">电子邮箱：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="mymail" style="width:100%" id="mymail" value=<?php echo ($vo["mail"]); ?> >
		</div>
		
				<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">公司名称：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="company" id="company" style="width:100%" required="required" value=<?php echo ($vo["uname"]); ?>>
		</div>
		
	<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">联系人：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="telname" id="telname" style="width:100%" value=<?php echo ($vo["company"]); ?>>
	</div>
		
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">电话号码：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="telephone" id="telephone" style="width:100%" required="required" value=<?php echo ($vo["telephone"]); ?>>
		</div>
		
	<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">公司地址：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="address" id="address" style="width:100%" required="required" value=<?php echo ($vo["address"]); ?>>
	</div>
	
	

	<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">营业执照：</div>
	<div style="margin-bottom:20px">
		<a href=__UPLOADS__/<?php echo ($vo["imgfile1"]); ?> target="_blank" >查看图片</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="myimage(1)">上传图片</a>
	</div>
	
	<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">税务登记证：</div>
	<div style="margin-bottom:20px">
		<a href=__UPLOADS__/<?php echo ($vo["imgfile2"]); ?> target="_blank" >查看图片</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="myimage(2)">上传图片</a>
	</div>
	
		<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">组织机构代码证：</div>
	<div style="margin-bottom:20px">
		<a href=__UPLOADS__/<?php echo ($vo["imgfile3"]); ?> target="_blank" >查看图片</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="myimage(3)">上传图片</a>
	</div>
	
	<!--
	<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">法人身份证：</div>
	<div style="margin-bottom:20px">
		<a href=__UPLOADS__/<?php echo ($vo["imgfile4"]); ?> target="_blank" >查看图片</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="myimage(4)">上传图片</a>
	</div>
	--><?php endforeach; endif; else: echo "" ;endif; ?>

	
	
		
		
		<div>
			<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">保存</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">清除</a>
			
		</div>
	</div>
	</form>  
	</center>