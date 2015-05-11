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
<table id="bt_menu"></table>
<script type="text/javascript"> NameSpace("BT.menu", function() { var context = this; var $grid = $('#bt_menu');

context.ready = function() {
    $grid.treegrid({
        fit: true,
        url: _ROOT_ + '/menu/getData',
        idField: 'mid',
        treeField: 'text',
        columns: [[
                {field: 'text', title: '名称', width: 200},
                {field: 'href', title: '链接', width: 200},
                {field: 'status', title: '状态', width: 100, align: 'center', formatter: function(value) {
                        if (value === '0') {
                            return '可用';
                        }
                        return '<font color="red">禁用</font>';
                    }},
                {field: 'seq', title: '序号', width: 50, align: 'center'},
                {field: 'mid', title: '操作', width: 100, align: 'center', formatter: function(value) {
                        var ctrs = ['<span  title="编辑" class="img-btn icon-edit" type="update" mid=' + value + '></span>', '<span title="删除" class="img-btn icon-remove" type="delete" mid=' + value + '></span>'];
                        return ctrs.join(' ');
                    }}
            ]],
        toolbar: [{
                text: '新增',
                iconCls: 'icon-add',
                handler: context.addView
            }],
        onLoadSuccess: function() {
            var $bodyView = $grid.data('datagrid').dc.view2;
            $bodyView.find('span[mid]').click(function(e) {
                var type = $(this).attr('type');
                var mid = $(this).attr('mid');
                var data = $grid.treegrid('find', mid);
                if (type === 'update') {
                    context.updateView(mid);
                } else {
                    context.deleted(mid, data.path);
                }
                e.stopPropagation();
            });
        }
    });
};
var viewDialog;
context.addView = function() {
    viewDialog = $.dialog({
        title: '新增菜单',
        href: _ROOT_ + '/menu/toadd',
        width: 450,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: context.doAdd
            }]
    });
};

context.deleted = function(mid, path) {
    $.messager.confirm('提示', '确认删除？', function(r) {
        if (r) {
            $.post(_ROOT_ + '/menu/delete', {path: path}, function(rsp) {
                if (rsp.status) {
                    $grid.treegrid('remove', mid);
                } else {
                    $.alert(rsp.msg);
                }
            });
        }
    });
};

context.doAdd = function() {
    $bt_menu_from = $('#bt_menu_from');
    if ($bt_menu_from.form('validate')) {
        $.post(_ROOT_ + '/menu/addMenu', $bt_menu_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.treegrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        });
    }
};

context.updateView = function(mid) {
    viewDialog = $.dialog({
        title: '更新菜单',
        href: _ROOT_ + '/menu/toUpdate?mid=' + mid,
        width: 430,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: context.doAdd
            }]
    });
};

 }); </script>