<?php if (!defined('THINK_PATH')) exit();?>﻿<?php if($isAjax): ?><!DOCTYPE html>
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
<table id="bt_addproduct_grid"></table>
<script type="text/javascript"> NameSpace("BT.PRODUCT", function() { var context = this; ﻿var $grid = $('#bt_addproduct_grid'), viewDialog, $typeGrid;
context.ready = function() {
    $grid.datagrid({
        fit: true,
        idField: 'npid',
        url: _ROOT_ + '/news/getData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'pname', title: '产品名称', width: 200, align: 'center'},
                {field: 'punit', title: '产品单位', width: 130, align: 'center'},
				{field: 'npcount', title: '产品数量', width: 130, align: 'center'},
				{field: 'npdetail', title: '备注信息', width: 300, align: 'center'},
                {field: 'npid', title: '删除操作', width: 100, align: 'center', formatter: function(value) {
                        return '<span title="删除" class="img-btn icon-remove" pid=' + value + '></span>';
                    }}
            ]],
        toolbar: [{
                text: '添加产品',
                iconCls: 'icon-add',
                handler: addView
            }, {
                text: '新增产品单位',
                iconCls: 'icon-remove',
                handler: doDelete
            }, '-', {
                text: '新增产品信息',
                iconCls: 'icon-category',
                handler: typeView
            }],
        onLoadSuccess: function() {
            var $bodyView = $grid.data('datagrid').dc.view2;
            $bodyView.find('span[pid]').click(function(e) {
                e.stopPropagation();
                var uid = $(this).attr('pid');
                updateView(uid);
            });
        }
    });
};

var addView = function() {
    viewDialog = $.dialog({
        title: '产品添加',
        href: _ROOT_ + '/news/add',
        width: 300,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: doSubmit
            }]
    });
};


var updateView = function(uid) {
	
	$.confirm('确认删除?', function(r) {
        if (r) {
            $.get(_ROOT_ + '/news/donpdel?npid=' + uid, function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
            } else {
                $.alert(rsp.msg);
                }
            }, 'JSON');
            }
        });
	
};
var doDelete = function() {
    viewDialog = $.dialog({
        title: '单位添加',
        href: _ROOT_ + '/unittype/add',
        width: 300,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: doSubmit1
            }]
    });
};

var doSubmit1 = function() {
    $bt_unit_from = $('#bt_unit_from');
        $.post(_ROOT_ + '/unittype/doSave', $bt_unit_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
};


var doSubmit = function() {
    $bt_unit_from = $('#bt_unit_from');
        $.post(_ROOT_ + '/news/doSave', $bt_unit_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
};

var doSubmit2 = function() {
    $bt_unit_from = $('#bt_unit_from');
        $.post(_ROOT_ + '/product/doSave', $bt_unit_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
};

var typeView = function() {
    viewDialog = $.dialog({
        title: '产品添加',
        href: _ROOT_ + '/product/add',
        width: 300,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: doSubmit2
            }]
    });
};
var typeViewOnLoad = function() {

};
var toTypeAdd = function() {

};
var doTypeDelete = function() {

};
var doTypeSave = function() {

};

 }); </script>