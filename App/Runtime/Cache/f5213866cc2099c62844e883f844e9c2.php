<?php if (!defined('THINK_PATH')) exit();?><form id="bt_user_from" class="form">
    <table align="center">
        <tr>
            <td>账号：</td>
            <td><input name="account" type="text" value="<?php echo ($data["account"]); ?>" <?php echo ($data['uid']?'readonly="readonly"':''); ?>  class="easyui-validatebox" required="required" maxlength="20"/></td>
            <td>姓名：</td>
            <td><input name="uname" type="text" value="<?php echo ($data["uname"]); ?>" class="easyui-validatebox" required="required"  maxlength="16"/></td>
        </tr>
        <tr>
            <td>密码：</td>
            <td><input name="password" type="password" maxlength="16" class="<?php echo ($data['uid']?'':'easyui-validatebox'); ?>" required="required"/></td>
            <td>邮箱：</td>
            <td><input name="mail" type="text" class="easyui-validatebox" value="<?php echo ($data["mail"]); ?>" data-options="validType: 'email'" required="required" maxlength="30"/></td>
        </tr>
        <tr>
            <td>角色：</td>
            <td valign="middle" colspan="3"><input id="bt_user_roles_combo"  name='roles' class="easyui-combobox" style="width:330px;" data-options='data:<?php echo ($roles); ?>,valueField:"rid",multiple:true,value:[<?php echo ($data["roles"]); ?>]'> <img src="__ROOT____IMG__/clear.png" onclick="$('#bt_user_roles_combo').combobox('clear');" style="cursor: pointer;vertical-align:middle;"></td>
        </tr>
    </table>
    <input type="hidden" name="uid" value="<?php echo ($data["uid"]); ?>">
</form>