<?php if (!defined('THINK_PATH')) exit();?><form id="bt_role_from" class="form">
    <table align="center">
        <tr>
            <td>名称：</td>
            <td><input name="text" class="easyui-validatebox" required="required" type="text" value="<?php echo ($data["text"]); ?>" style="width: 352px;"/></td>
        </tr>
        <tr>
            <td>状态：</td>
            <td><input name="status" type="radio" <?php if($data["status"] == 0): ?>checked="checked"<?php endif; ?> value="0"/>可用 <input name="status" type="radio" <?php if($data["status"] == 1): ?>checked="checked"<?php endif; ?> value="1"/>禁用 </td>
        </tr>
        <tr>
            <td>备注：</td>
            <td>
                <textarea name="remark" style="width: 348px;resize: none;height: 60px;"><?php echo ($data["remark"]); ?></textarea>
            </td>
        </tr>
    </table>
    <input type="hidden" name="rid" value="<?php echo ($data["rid"]); ?>">
</form>