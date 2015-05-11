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
<div class="easyui-layout" fit="true" id='bt_org_layout'>
    <div region="center" style="border-bottom: none;">
        <table id="bt_org"></table>
    </div>
    <div region="east" style="width: 430px;padding: 2px;" title="部门成员" collapsed="true" split='true'>
        <table id="bt_org_user_grid"></table>
    </div>
</div>

<script type="text/javascript"> NameSpace("BT.org", function() { var context = this; var $grid = $('#bt_org'), oid = 0, $userGrid = $('#bt_org_user_grid'), viewDialog, $chooseuserGrid;

context.ready = function() {
    $grid.treegrid({
        fit: true,
        border:false,
        url: _ROOT_ + '/org/getData',
        idField: 'oid',
        treeField: 'oname',
        columns: [[
                {field: 'oname', title: '名称', width: 200},
                {field: 'manager', title: '主管', width: 200},
                {field: 'description', title: '描述', width: 100},
                {field: 'seq', title: '序号', width: 50, align: 'center'},
                {field: 'oid', title: '操作', width: 100, align: 'center', formatter: function(value) {
                        var ctrs = ['<span  title="编辑" class="img-btn icon-edit" type="update" oid=' + value + '></span>', '<span title="删除" class="img-btn icon-remove" type="delete" oid=' + value + '></span>'];
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
            $bodyView.find('span[oid]').click(function(e) {
                var type = $(this).attr('type');
                var oid = $(this).attr('oid');
                if (type === 'update') {
                    context.updateView(oid);
                } else {
                    context.deleted(oid);
                }
                e.stopPropagation();
            });
        },
        onSelect: function(node) {
            if (oid && oid === node.oid) {
                return;
            }
            var $layout = $('#bt_org_layout');
            var east = $layout.layout('panel', 'east');
            if (east.panel('options').collapsed) {
                $layout.layout('expand', 'east');
            }

            east.panel("setTitle", node.oname + " 成员");

            oid = node.oid;

            if (!$userGrid.data('datagrid')) {
                $userGrid.datagrid({
                    fit: true,
                    fitColumns: true,
                    border: false,
                    url: _ROOT_ + '/org/getUserData',
                    pagination: true,
                    queryParams: {oid: oid},
                    columns: [[
                            {checkbox: true},
                            {field: 'uname', title: '姓名', width: 150},
                            {field: 'account', title: '账号', width: 150},
                            {field: 'mail', title: '邮箱', width: 150}
                        ]],
                    toolbar: [{
                            text: '新增',
                            iconCls: 'icon-add',
                            handler: context.addOrgUserView
                        }, {
                            text: '删除',
                            iconCls: 'icon-remove',
                            handler: context.doDeleteUser
                        }]
                });
            } else {
                $userGrid.datagrid({
                    url: _ROOT_ + '/org/getUserData',
                    queryParams: {oid: oid}
                });
            }
        }
    });
};
var viewDialog;
context.addView = function() {
    viewDialog = $.dialog({
        title: '新增菜单',
        href: _ROOT_ + '/org/toadd',
        width: 450,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: context.doSubmit
            }]
    });
};

context.deleted = function(oid) {
    $.messager.confirm('提示', '确认删除？', function(r) {
        if (r) {
            $.post(_ROOT_ + '/org/doDelete', {oid: oid}, function(rsp) {
                if (rsp.status) {
                    $grid.treegrid('remove', oid);
                } else {
                    $.alert(rsp.msg);
                }
            });
        }
    });
};

context.doSubmit = function() {
    $bt_org_from = $('#bt_org_from');
    if ($bt_org_from.form('validate')) {
        $.post(_ROOT_ + '/org/doSave', $bt_org_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.treegrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        });
    }
};

context.updateView = function(oid) {
    viewDialog = $.dialog({
        title: '更新菜单',
        href: _ROOT_ + '/org/toUpdate?oid=' + oid,
        width: 430,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: context.doSubmit
            }]
    });
};


context.addOrgUserView = function() {
    viewDialog = $.dialog({
        title: '添加成员',
        href: _ROOT_ + '/common/chooseUser',
        width: 550,
        bodyStyle: {overflow: 'hidden'},
        height: 300,
        buttons: [{
                text: '确认添加',
                handler: context.doAddUserSubmit
            }],
        onLoad: function() {
            setTimeout(function() {
                $chooseuserGrid = BT.common.chooseuser.chooseuserGrid;
                $chooseuserGrid.datagrid({url: _ROOT_ + '/org/getAddUserData?oid=' + oid});
            }, 100);
        }
    });
};

context.doAddUserSubmit = function() {
    var checked = $chooseuserGrid.datagrid('getChecked');
    if (checked && checked.length > 0) {
        var ids = [];
        $.each(checked, function() {
            ids.push(this.uid);
        });
        $.post(_ROOT_ + '/org/doAddOrgUser', {oid: oid, uids: ids.join(',')}, function(rsp) {
            if (rsp.status) {
                $userGrid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, 'JSON');
    } else {
        $.alert('没有选择任何用户！');
    }
};

context.doDeleteUser = function() {
    var checked = $userGrid.datagrid('getChecked');
    if (checked && checked.length > 0) {
        $.confirm('确认删除？', function(r) {
            if (r) {
                var ids = [];
                $.each(checked, function() {
                    ids.push(this.id);
                });
                $.post(_ROOT_ + '/org/doDeleteOrgUser', {oid: oid, ids: ids.join(',')}, function(rsp) {
                    if (rsp.status) {
                        $userGrid.datagrid('reload');
                    } else {
                        $.alert(rsp.msg);
                    }
                }, 'JSON');
            }
        });
    }
}; }); </script>