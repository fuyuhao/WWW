<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="width: 100%;height: 100%;">
    <head>
        <title>在线询价系统 注册</title>
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
	

	
	function PreviewImage(imgFile,mypreview)
	{
	document.getElementById(mypreview).style.display="";
	
    var filextension=imgFile.value.substring(imgFile.value.lastIndexOf("."),imgFile.value.length);
    filextension=filextension.toLowerCase();
    if ((filextension!='.jpg')&&(filextension!='.gif')&&(filextension!='.jpeg')&&(filextension!='.png')&&(filextension!='.bmp'))
    {
        alert("对不起，系统仅支持标准格式的照片，请您调整格式后重新上传，谢谢 !");
        imgFile.focus();
    }
    else
    {
        var path;
        if(document.all)//IE
        {
            imgFile.select();
            path = document.selection.createRange().text;
            document.getElementById(mypreview).innerHTML="";
            document.getElementById(mypreview).style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")";//使用滤镜效果      
        }
        else//FF
        {
            path=window.URL.createObjectURL(imgFile.files[0]);// FF 7.0以上
            //path = imgFile.files[0].getAsDataURL();// FF 3.0
            document.getElementById(mypreview).innerHTML = "<img id='img1' width='120px' height='100px' src='"+path+"'/>";
            //document.getElementById("img1").src = path;
        }
    }
	}
	
	
	
	
	
	
		function submitForm(){
		var userName= document.getElementById("account").value;
		var pwd = document.getElementById("password1").value;
		var repwd = document.getElementById("password2").value;
		if(userName==""||pwd==""||repwd==""){
		alert("请填写必填项！");
		return false;
		}
		if (pwd != repwd) {
		alert("两次密码输入不相同！");
		return false;
		}
			$('#ff').submit(); 
		}
		function clearForm(){
			$('#ff').form('clear');
		}
	</script>
	
	
<body>
<center>
	<h2>供应商注册</h2>
	<p></p>
	<form method="post" id="ff" action="reguser" enctype="multipart/form-data">  
	<div style="margin:20px 0;"></div>
	<div class="easyui-panel" title="填写注册信息" style="width:400px;padding:30px 60px">
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">用户名：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="account" style="width:100%" id="account" required="required">
		</div>
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">密码：</div>
			<input class="easyui-validatebox  password form-textbox" type="password" name="password" id="password1" style="width:100%" required="required">
		</div>
		
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">确认密码：</div>
			<input class="easyui-validatebox  password form-textbox" type="password" name="repassword" id="password2" style="width:100%" required="required">
		</div>
		
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">公司名称：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="company" id="company" style="width:100%" required="required">
		</div>
		
	<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">联系人：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="telname" id="telname" style="width:100%" required="required">
	</div>
		
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">电话号码：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="telephone" id="telephone" style="width:100%" required="required">
		</div>
		
	<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">公司地址：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="address" id="address" style="width:100%" required="required">
	</div>
	
	<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">电子邮箱：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="email" id="email" style="width:100%" required="required">
	</div>
	
	<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">供应商类型：</div>
		<select class="easyui-combobox" style="width:200px;" name="gyslx" id="gyslx">
		<option value="原料">原料</option>
		<option value="五金">五金</option>
		<option value="办公用品">办公用品</option>
		<option value="外协加工">外协加工</option>
	</select>
	</div>
	
	
		
	<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">营业执照：</div>
	<div style="margin-bottom:20px">
	<input type="file" onchange="PreviewImage(this,'imgPreview1')" name="image1"/>
	</div>
	<div id="imgPreview1" style='display:none;width:120px;height:100px;margin-bottom:20px;'>
    <img id="img1" src="__ROOT____CSS__/blank.gif" width="120" height="100" />
	</div>	
	
	<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">税务登记证：</div>
	<div style="margin-bottom:20px">
	<input type="file" onchange="PreviewImage(this,'imgPreview2')" name="image2"/>
	</div>
	<div id="imgPreview2" style='display:none;width:120px;height:100px;margin-bottom:20px;'>
    <img id="img2" src="__ROOT____CSS__/blank.gif" width="120" height="100" />
	</div>	
	
	<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">组织机构代码证：</div>
	<div style="margin-bottom:20px">
	<input type="file" onchange="PreviewImage(this,'imgPreview3')" name="image3"/>
	</div>
	<div id="imgPreview3" style='display:none;width:120px;height:100px;margin-bottom:20px;'>
    <img id="img3" src="__ROOT____CSS__/blank.gif" width="120" height="100" />
	</div>	
	
	<!-- 
	<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">法人身份证：</div>
	<div style="margin-bottom:20px">
	<input type="file" onchange="PreviewImage(this,'imgPreview4')" name="image4"/>
	</div>
	<div id="imgPreview4" style='display:none;width:120px;height:100px;margin-bottom:20px;'>
    <img id="img4" src="__ROOT____CSS__/blank.gif" width="120" height="100" />
	</div>	
	-->

		
		
		<div>
			<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">注册</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">清除</a> 
		</div>
	</div>
	</form>  
	</center>
</body>