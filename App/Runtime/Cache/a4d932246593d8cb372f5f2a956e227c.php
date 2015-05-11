<?php if (!defined('THINK_PATH')) exit();?><form id="bt_dict_from" class="form">
    <table align="center">
        <tr>
            <td>类型：</td>
            <td valign="middle"><input id="bt_dict_combobox"  name='typeid' class="easyui-combobox" style="width:153px;" data-options="required:true,url:'__ROOT__/dict/comboData',valueField:'id',textField:'dtName',editable:false" value="<?php echo ($data['typeid']?$data['typeid']:''); ?>"></td>  
        </tr>
        <tr>
            <td>显示值：</td>
            <td><input name="dtText" type="text" value="<?php echo ($data["dtText"]); ?>" class="easyui-validatebox" required="required"/></td>
        </tr>
         <tr>
            <td>实际值：</td>
            <td><input name="dtValue" type="text" value="<?php echo ($data["dtValue"]); ?>" class="easyui-validatebox" required="required"/></td>
        </tr>
        <tr>
            <td>是否默认：</td>
            <td><input name="isdefault" type="radio" <?php if($data["isdefault"] == 0): ?>checked="checked"<?php endif; ?> value="0"/>否 <input name="isdefault" type="radio" <?php if($data["isdefault"] == 1): ?>checked="checked"<?php endif; ?> value="1"/>是 </td>
        </tr>
    </table>
    <input type="hidden" name="did" value="<?php echo ($data["did"]); ?>">
</form>