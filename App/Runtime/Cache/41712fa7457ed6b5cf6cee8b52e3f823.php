<?php if (!defined('THINK_PATH')) exit();?><form id="bt_menu_from" class="form">
    <table align="center">
        <tr>
            <td>父项：</td>
            <td valign="middle"><input id="bt_menu_comboTree"  name='pid' class="easyui-combotree" style="width:130px;" data-options="url:'__ROOT__/menu/comboData?path=<?php echo ($data["path"]); ?>',valueField:'mid'" value="<?php echo ($data['pid']<0?'':$data['pid']); ?>"> <img src="__ROOT____IMG__/clear.png" onclick="$('#bt_menu_comboTree').combotree('clear');" style="cursor: pointer;vertical-align:middle;"></td>
            <td>名称：</td>
            <td><input name="text" type="text" value="<?php echo ($data["text"]); ?>" class="easyui-validatebox" required="required"/></td>
        </tr>
        <tr>
            <td>链接：</td>
            <td colspan="3"><input name="href" type="text" value="<?php echo ($data["href"]); ?>" style="width: 352px;"/></td>
        </tr>
        <tr>
            <td>图标：</td>
            <td><input name="iconCls" type="text" value="<?php echo ($data["iconCls"]); ?>"/></td>
            <td>排序：</td>
            <td><input name="seq" type="text" class="easyui-numberbox" value="<?php echo (($data["seq"])?($data["seq"]):0); ?>" data-options="min:0,precision:0"/></td>
        </tr>
        <tr>
            <td>状态：</td>
            <td><input name="status" type="radio" <?php if($data["status"] == 0): ?>checked="checked"<?php endif; ?> value="0"/>可用 <input name="status" type="radio" <?php if($data["status"] == 1): ?>checked="checked"<?php endif; ?> value="1"/>禁用 </td>
            <td>分类：</td>
            <td><input name="issort" type="radio" <?php if($data["issort"] == 0): ?>checked="checked"<?php endif; ?> value="0"/>否 <input name="issort" type="radio" <?php if($data["issort"] == 1): ?>checked="checked"<?php endif; ?> value="1"/>是 </td>
        </tr>
    </table>
    <input type="hidden" name="mid" value="<?php echo ($data["mid"]); ?>">
    <input type="hidden" name="path" value="<?php echo ($data["path"]); ?>">
</form>