<?php if (!defined('THINK_PATH')) exit();?>﻿<form id="bt_price_from" class="form">
    <table align="center">
	

		
		
		<tr>
		<td>发票类型：</td>
		<td valign="middle">
		<select class="easyui-combobox" style="width:200px;" name="fapiao" id="fapiao">
		<option value="17%增值税专用发票">17%增值税专用发票</option>
		<option value="13%增值税专用发票">13%增值税专用发票</option>
		<option value="3%增值税专用发票">3%增值税专用发票</option>
		<option value="普通发票">普通发票</option>
	</select>
		</td>
		</tr>
		
		
		<tr>
		<td>输入账期：</td>
		<td valign="middle"><input class="easyui-validatebox form-textbox" type="text"  name="zhangqi" style="width:100%" id="zhangqi"></td>
		</tr>
		
				<tr>
		<td>输入报价：</td>
		<td valign="middle"><input class="easyui-validatebox form-textbox" type="text"  name="prate" style="width:100%" id="prate" ></td>
		</tr>


    </table>
   <input type="hidden" name="myid" value="<?php echo ($myid); ?>">
   <input type="hidden" name="nid" value="<?php echo ($nid); ?>">
   <input type="hidden" name="uid" value="<?php echo ($uid); ?>">
   <input type="hidden" name="pround" value="<?php echo ($pround); ?>">
   <input type="hidden" name="npcount" value="<?php echo ($npcount); ?>">
</form>