<?php if (!defined('THINK_PATH')) exit(); if($isAjax): ?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo ($title); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="generator" content="anticode" />
        <meta name="author" content="anticode"/>
        <link rel="stylesheet" href="__ROOT____THM__/bootstrap/easyui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="__ROOT____THM__/icon.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="__ROOT____CSS__/css.css" type="text/css" media="screen" />
        <script type="text/javascript" src="__ROOT____JS__/core/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="__ROOT____JS__/core/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="__ROOT____JS__/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="__ROOT____JS__/core/btutil.js"></script>
        <script type="text/javascript" src="__ROOT____JS__/My97DatePicker/WdatePicker.js"></script>
        <script>
            var _ROOT_ = '__ROOT__';
        </script>
    </head>
    <body>
        <div id="bt_loading" class="loading"></div>
        <div id="bt_loading_progress" class="progress">执行中...</div><?php endif; ?>
<div class="easyui-layout" fit="true">
    <div region="north" style="height: 70px;border-bottom: none;">
        <form id="bt_user_search_from">
            <table style="height: 100%;">
                <tr>
                    <td><select class="easyui-combobox" data-options="panelHeight:'auto',editable:false,onChange:function(o,n){
                                if(o == '姓名'){$('#bt_user_input_name').attr('name','Q_uname_like')}else{
                                $('#bt_user_input_name').attr('name','Q_account_like')
                                }
                                }"><option>账号</option><option>姓名</option></select></td>
                    <td><input  type="text" name="Q_account_like" id="bt_user_input_name"></td>
                    <td>邮箱</td>
                    <td><input  type="text" name="Q_mail_like"></td>
                    <td rowspan="2"><a href="javascript:void(0)" class="easyui-linkbutton" id="bt_user_search_btn">查询</a> <a href="javascript:$('#bt_user_search_from').form('clear');" class="easyui-linkbutton">清空</a> </td>
                </tr>
                <tr>
                    <td>创建时间</td>
                    <td><input  class="easyui-my97" type="text" name="Q_createTime_EGT" maxDate="#F{ $dp.$D('bt_user_input_createTime_ed')||'2020-10-01'}" id="bt_user_input_createTime_st"></td>
                    <td align="center">-</td>
                    <td><input class="easyui-my97" type="text" name="Q_createTime_LT" minDate="#F{ $dp.$D('bt_user_input_createTime_st')}" id="bt_user_input_createTime_ed"></td>
                </tr>
            </table>
        </form>
    </div>
    <div region="center"><table id="bt_user_grid"></table></div>
</div>
<script type="text/javascript"> NameSpace("BT.user", function() { var context = this; var $grid = $('#bt_user_grid');
var viewDialog;

context.ready = function() {
    $grid.datagrid({
        fit: true,
        border: false,
        url: _ROOT_ + '/user/getData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'account', title: '账号', width: 100, align: 'center'},
                {field: 'uname', title: '姓名', width: 100, align: 'center'},
                {field: 'mail', title: '邮箱', width: 200, align: 'center'},
                {field: 'createTime', title: '创建时间', width: 150, align: 'center', sortable: true},
                {field: 'updateTime', title: '更新时间', width: 150, align: 'center', sortable: true},
                {field: 'uid', title: '操作', width: 100, align: 'center', formatter: function(value) {
                        return '<span title="编辑" class="img-btn icon-edit" kid=' + value + '></span>';
                    }}
            ]],
        toolbar: [{
                text: '新增',
                iconCls: 'icon-add',
                handler: context.addView
            }, {
                text: '删除',
                iconCls: 'icon-remove',
                handler: context.doDelete
            }],
        onLoadSuccess: function() {
            var $bodyView = $grid.data('datagrid').dc.view2;
            $bodyView.find('span[kid]').click(function(e) {
                e.stopPropagation();
                var uid = $(this).attr('kid');
                context.updateView(uid);
            });
        }
    });

    $('#bt_user_search_btn').click(function() {
        $grid.datagrid('load', $('#bt_user_search_from').toJson());
    });
};

context.addView = function() {
    viewDialog = $.dialog({
        title: '新增用户',
        href: _ROOT_ + '/user/toadd',
        width: 450,
        height: 170,
        bodyStyle: {overflow: 'hidden'},
        buttons: [{
                text: '提交',
                handler: context.doSubmit
            }]
    });
};

context.updateView = function(uid) {
    viewDialog = $.dialog({
        title: '编辑用户',
        href: _ROOT_ + '/user/toUpdate?uid=' + uid,
        width: 450,
        height: 170,
        bodyStyle: {overflow: 'hidden'},
        buttons: [{
                text: '提交',
                handler: context.doSubmit
            }]
    });
};

context.doDelete = function() {
    var checked = $grid.datagrid('getChecked');
    if (checked && checked.length > 0) {
        $.confirm('确认删除？', function(r) {
            if (r) {
                var ids = [];
                $.each(checked, function() {
                    ids.push(this.uid);
                });
                $.post(_ROOT_ + '/user/doDelete', {ids: ids.join(',')}, function(rsp) {
                    if (rsp.status) {
                        $grid.datagrid('reload');
                    } else {
                        $.alert(rsp.msg);
                    }
                }, 'JSON');
            }
        });
    }
};

context.doSubmit = function() {
    $bt_user_from = $('#bt_user_from');
    if ($bt_user_from.form('validate')) {
        $.post(_ROOT_ + '/user/doSave', $bt_user_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
    }
}; }); </script>