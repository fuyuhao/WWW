var $grid = $('#bt_unittype_grid'), viewDialog, $typeGrid;
context.ready = function() {
    $grid.datagrid({
        fit: true,
        idField: 'id',
        url: _ROOT_ + '/unittype/getData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'unitname', title: '单位名称', width: 90, align: 'center'},
                {field: 'id', title: '删除操作', width: 100, align: 'center', formatter: function(value) {
                        return '<span title="删除" class="img-btn icon-remove" pid=' + value + '></span>';
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
                var uid = $(this).attr('pid');
                updateView(uid);
            });
        }
    });
};

var addView = function() {
    viewDialog = $.dialog({
        title: '单位添加',
        href: _ROOT_ + '/unittype/add',
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
            $.get(_ROOT_ + '/unittype/doupdate?uid=' + uid, function(rsp) {
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

};

var doSubmit = function() {
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

