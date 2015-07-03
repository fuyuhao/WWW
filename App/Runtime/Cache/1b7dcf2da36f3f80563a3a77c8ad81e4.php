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
<table id="bt_addprice_grid"></table>
<script type="text/javascript"> NameSpace("BT.PRICE", function() { var context = this; ﻿var $grid = $('#bt_addprice_grid'), viewDialog, $typeGrid;
context.ready = function() {
    $grid.datagrid({
        fit: true,
        idField: 'pid',
        url: _ROOT_ + '/news/getPriceData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'pname', title: '产品名称', width: 130, align: 'center'},
                {field: 'punit', title: '产品单位', width: 130, align: 'center'},
				{field: 'npcount', title: '产品数量', width: 130, align: 'center'},
				{field: 'npdetail', title: '备注信息', width: 200, align: 'center'},
				{field: 'prate', title: '产品单价', width: 130, align: 'center'},
				{field: 'sumrate', title: '产品金额', width: 130, align: 'center'},
                {field: 'pid', title: '报价操作', width: 100, align: 'center', formatter: function(value) {
                        return '<span title="报价" class="img-btn icon-edit" pid=' + value + '></span>';
                    }}
            ]],
        toolbar: [{
                text: '新增',
                iconCls: 'icon-add',
                handler: addView
            }, {
                text: '删除',
                iconCls: 'icon-remove',
                handler: doDelete
            }, '-', {
                text: '类别管理',
                iconCls: 'icon-category',
                handler: typeView
            }],
        onLoadSuccess: function() {
            var $bodyView = $grid.data('datagrid').dc.view2;
            $bodyView.find('span[pid]').click(function(e) {
                e.stopPropagation();
                var pid = $(this).attr('pid');
                updateView(pid);
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


var updateView = function(pid) {
	
    viewDialog = $.dialog({
        title: '产品报价',
        href: _ROOT_ + '/news/dialogprice?pid=' + pid,
        width: 300,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: doSubmit
            }]
    });
	
};
var doDelete = function() {

};

var doSubmit = function() {
    $bt_unit_from = $('#bt_price_from');
        $.post(_ROOT_ + '/news/saveprice', $bt_unit_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
};
var typeView = function() {

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