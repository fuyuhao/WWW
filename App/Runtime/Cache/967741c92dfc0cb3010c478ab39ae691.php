<?php if (!defined('THINK_PATH')) exit();?>﻿<form id="bt_unit_from" class="form">
    <table align="center">
	
	    <tr>
            <td>产品名称：</td>
            <td valign="middle"><input id="bt_product_combobox"  name='punit' class="easyui-combobox" style="width:153px;" data-options="required:true,url:'__ROOT__/news/comboData2',valueField:'pid',textField:'pname',editable:false" value=""></td>  
        </tr>
	
        <tr>
            <td>产品单位：</td>
            <td valign="middle"><input id="bt_unit_combobox"  name='punit' class="easyui-combobox" style="width:153px;" data-options="required:true,url:'__ROOT__/news/comboData1',valueField:'punit',textField:'punit',editable:false" value=""></td>  
        </tr>


    </table>
   
</form>

<script>
 $(document).ready(function () {
 
            var _mkid = $('#bt_product_combobox').combobox({
                url: '__ROOT__/news/comboData2',
                editable: false,
                valueField: 'pid',
                textField: 'pname',
                onSelect: function (record) {
                    _zhbid.combobox({
                        disabled: false,
                        url: '__ROOT__/news/comboData1?pid=' + record.pid,
                        valueField: 'punit',
                        textField: 'punit'
                    }).combobox('clear');
                }
            });
            var _zhbid = $('#bt_unit_combobox').combobox({
                disabled: true,
                valueField: 'punit',
                textField: 'punit'
            });

}); 
</script>