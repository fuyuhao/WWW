<?php if (!defined('THINK_PATH')) exit();?>﻿<form id="bt_price_from" class="form">
    <table align="center">
	

		
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