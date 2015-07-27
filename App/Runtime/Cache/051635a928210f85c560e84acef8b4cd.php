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
<table id="bt_sumprice_grid"></table>
<script type="text/javascript"> NameSpace("BT.PRICE", function() { var context = this; ﻿var $grid = $('#bt_sumprice_grid'), viewDialog, $typeGrid;
context.ready = function() {
    $grid.datagrid({
        fit: true,
        idField: 'uid',
        url: _ROOT_ + '/bossview/getsumPrice',
        pagination: true,
        columns: [[
                {checkbox: true},
				{field: 'uname', title: '供应商名称', width: 130, align: 'center'},
				{field: 'sumrate', title: '金额合计', width: 130, align: 'center'}
               // {field: 'uid', title: '中标操作', width: 100, align: 'center', formatter: function(value) {
               //         return '<span title="中标" class="img-btn icon-edit" pid=' + value + '></span>';
              //      }}
            ]],
        toolbar: [{
                text: '报价明细',
                iconCls: 'icon-add',
               handler: addView
     //      }, {
      //          text: '删除',
     //           iconCls: 'icon-remove',
     //           handler: doDelete
     //      }, '-', {
   //             text: '类别管理',
  //              iconCls: 'icon-category',
 //               handler: typeView
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
	//var myurl=_ROOT_ + '/news/sumprice'
    //window.open(myurl);   
	$('#bt_index_layout_center').panel('open').panel('refresh',_ROOT_ +'/bossview/allprice');
};

function getFile(address,parameters){
	window.location='news/myexport';
}


var updateView = function(pid) {
	
	$.confirm('确认中标？', function(r) {
        if (r) {
            $.get(_ROOT_ + '/news/newssumwin?uid=' + pid, function(rsp) {
            if (rsp.status) {
				alert("中标已选！请到中标项目中查看！");
                $grid.datagrid('reload');
            } else {
                $.alert(rsp.msg);
                }
            }, 'JSON');
            }
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