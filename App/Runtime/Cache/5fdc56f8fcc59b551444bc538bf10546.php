<?php if (!defined('THINK_PATH')) exit();?>﻿
<?php if($isAjax): ?><!DOCTYPE html>
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
<table id="bt_newsfilter_grid"></table>
<script type="text/javascript"> NameSpace("BT.NEWS", function() { var context = this; ﻿var $grid = $('#bt_newsfilter_grid'), viewDialog, $typeGrid;
context.ready = function() {
    $grid.datagrid({
        fit: true,
        idField: 'nid',
        url: _ROOT_ + '/bossview/getfilterData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'ntitle', title: '公告标题', width: 130, align: 'center'},
                {field: 'ntext', title: '公告内容', width: 130, align: 'center'},
				{field: 'nstart', title: '开始时间', width: 130, align: 'center'},
				{field: 'nend', title: '结束时间', width: 130, align: 'center'},
				{field: 'nround', title: '竞价轮次', width: 130, align: 'center'},
                {field: 'nid', title: '操作', width: 100, align: 'center', formatter: function(value) {
						var ctrs = ['<span  title="详情" class="img-btn icon-tip" type="detail" nid=' + value + '></span>', '<span title="竞价" class="img-btn icon-ok" type="check" nid=' + value + '></span>'];
                        return ctrs.join(' ');
                    }}
            ]],
//        toolbar: [{
//                text: '新增',
 //               iconCls: 'icon-add',
//                handler: addView
//            }, {
 //               text: '删除',
//                iconCls: 'icon-remove',
 //               handler: doDelete
 //           }, '-', {
 //               text: '类别管理',
 //               iconCls: 'icon-category',
  //              handler: typeView
  //          }],
        onLoadSuccess: function() {
            var $bodyView = $grid.data('datagrid').dc.view2;
            $bodyView.find('span[nid]').click(function(e) {
				var type = $(this).attr('type');
                e.stopPropagation();
                var uid = $(this).attr('nid');
                if (type === 'check') {
                    context.updateView(uid);
                } else {
                    context.mydetail(uid);
                }
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


context.updateView = function(uid) {

	//$('#bt_index_layout_center').panel('open').panel('refresh',_ROOT_ +'/news/userfilter?nid=' + uid);
	$('#bt_index_layout_center').panel('open').panel('refresh',_ROOT_ +'/bossview/sumprice?nid=' + uid);
	
};

context.mydetail = function(uid) {
	
	var myurl=_ROOT_ + '/news/getdetail?nid=' + uid
    window.open(myurl);    
	
};



var doDelete = function() {

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