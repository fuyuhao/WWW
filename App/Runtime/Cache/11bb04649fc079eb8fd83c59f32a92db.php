<?php if (!defined('THINK_PATH')) exit();?>﻿		<link rel="stylesheet" href="/public/KindEditor/themes/default/default.css" />
		<script charset="utf-8" src="/public/KindEditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="/public/KindEditor/lang/zh_CN.js"></script>
		
	<script>

		function submitForm(){
		//var userName= document.getElementById("account").value;
		//var pwd = document.getElementById("password1").value;
		//var repwd = document.getElementById("password2").value;
		//if(userName==""||pwd==""||repwd==""){
		//alert("请填写必填项！");
		//return false;
		//}
		//if (pwd != repwd) {
		//alert("两次密码输入不相同！");
		//return false;
		//}
		$('#ff').submit(); 
		alert("新增公告成功，请继续添加需要竞价的产品！");
		$('#bt_index_layout_center').panel('open').panel('refresh',_ROOT_ +'/news/addproduct');
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
		viewDialog.dialog('close');
	}
	
	
	
	
	(function ($, K) {
	if (!K)
		throw "KindEditor未定义!";

	function create(target) {
		var opts = $.data(target, 'kindeditor').options;
		var editor = K.create(target, opts);
		$.data(target, 'kindeditor').options.editor = editor;
	}

	$.fn.kindeditor = function (options, param) {
		if (typeof options == 'string') {
			var method = $.fn.kindeditor.methods[options];
			if (method) {
				return method(this, param);
			}
		}
		options = options || {};
		return this.each(function () {
			var state = $.data(this, 'kindeditor');
			if (state) {
				$.extend(state.options, options);
			} else {
				state = $.data(this, 'kindeditor', {
						options : $.extend({}, $.fn.kindeditor.defaults, $.fn.kindeditor.parseOptions(this), options)
					});
			}
			create(this);
		});
	}

	$.fn.kindeditor.parseOptions = function (target) {
		return $.extend({}, $.parser.parseOptions(target, []));
	};

	$.fn.kindeditor.methods = {
		editor : function (jq) {
			return $.data(jq[0], 'kindeditor').options.editor;
		}
	};

	$.fn.kindeditor.defaults = {
		resizeType : 1,
		allowPreviewEmoticons : false,
		allowImageUpload : true,
		basePath: '/public/kindeditor/',
		items : [
			'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link'],
		afterChange:function(){
			this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
		}
	};
	$.parser.plugins.push("kindeditor");
})(jQuery, KindEditor);
	
	
	
	</script>
	

	
<iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe> 

<center>
	<h2>发布竞价公告</h2>
	<p></p>
	<form method="post" id="ff" action="/news/save"  target="id_iframe"   enctype="multipart/form-data">  
	<div style="margin:20px 0;"></div>
	<div class="easyui-panel" title="发布竞价公告" style="width:400px;padding:30px 60px">
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">竞价标题：</div>
			<input class="easyui-validatebox form-textbox" type="text" name="mydetail" style="width:100%" id="mydetail" >
		</div>
		
		<div style="margin-bottom:20px">
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">竞价公告：</div>
			<textarea class="easyui-kindeditor" style="width:100%;height:200px;visibility:hidden;" name="newscontent" id="newscontent"></textarea>
		</div>
	
	<div style="margin:20px 0;"></div>
  <div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">竞价开始时间：</div>	
  <input class="easyui-datetimebox"  style="width:200px;" name="newsstart" id="newsstart"> </input>
  <div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">竞价结束时间：</div>	
    <input class="easyui-datetimebox"  style="width:200px;" name="newsend" id="newssend"> </input>
	<div style="margin:20px 0;"></div>
		
		<div>
			<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">保存</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">清除</a>
		</div>
	</div>
	</form>  
	</center>