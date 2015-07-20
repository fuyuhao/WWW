var $grid = $('#bt_addproduct_grid'), viewDialog, $typeGrid;
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
                iconCls: 'icon-add',
                handler: doDelete
            }, '-', {
                text: '新增产品信息',
                iconCls: 'icon-add',
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

