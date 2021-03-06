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
<table id="bt_user_grid"></table>
<script type="text/javascript"> NameSpace("BT.USER", function() { var context = this; var $grid = $('#bt_user_grid'), viewDialog, $typeGrid;
context.ready = function() {
    $grid.datagrid({
        fit: true,
        idField: 'uid',
        url: _ROOT_ + '/gys/getData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'uname', title: '公司名称', width: 90, align: 'center'},
                {field: 'company', title: '联系人', width: 130, align: 'center'},
                {field: 'telephone', title: '电话', width: 130, align: 'center'},
				{field: 'gyslx', title: '供应商类型', width: 130, align: 'center'},
                {field: 'ustatus', title: '审核状态', width: 70, align: 'center', formatter: function(value) {
                        if (value === '1') {
                            return '已审核';
                        }
                        return '<font color="red">未审核</font>';
                    }},
                {field: 'uid', title: '操作', width: 100, align: 'center', formatter: function(value) {
						var ctrs = ['<span  title="详情" class="img-btn icon-tip" type="detail" uid=' + value + '></span>', '<span title="审核" class="img-btn icon-ok" type="check" uid=' + value + '></span>'];
                        return ctrs.join(' ');
						
                    }}
            ]],
    //   toolbar: [{
   //             text: '新增',
    //            iconCls: 'icon-add',
   //             handler: addView
   //         }, {
   //             text: '删除',
   //             iconCls: 'icon-remove',
    //            handler: doDelete
   //         }, '-', {
    //            text: '类别管理',
   //             iconCls: 'icon-category',
   //             handler: typeView
  //          }],
        onLoadSuccess: function() {
            var $bodyView = $grid.data('datagrid').dc.view2;
			
            $bodyView.find('span[uid]').click(function(e) {
				var type = $(this).attr('type');
                e.stopPropagation();
                var uid = $(this).attr('uid');
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

};
context.updateView = function(uid) {
	
	$.confirm('确认审核？', function(r) {
        if (r) {
            $.get(_ROOT_ + '/gys/doupdate?uid=' + uid, function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
            } else {
                $.alert(rsp.msg);
                }
            }, 'JSON');
            }
        });
	
};

context.mydetail = function(uid) {
	
	var myurl=_ROOT_ + '/gys/getdetail?uid=' + uid
    window.open(myurl);    
	
};



var doDelete = function() {

};

var doSubmit = function() {

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