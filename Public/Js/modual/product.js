var $grid = $('#bt_product_grid'), viewDialog, $typeGrid;
context.ready = function() {
    $grid.datagrid({
        fit: true,
        idField: 'pid',
        url: _ROOT_ + '/product/getData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'pname', title: '产品名称', width: 90, align: 'center'},
                {field: 'punit', title: '产品单位', width: 130, align: 'center'},
                {field: 'pid', title: '删除操作', width: 100, align: 'center', formatter: function(value) {
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

};
var updateView = function(uid) {
	
	$.confirm('确认删除?', function(r) {
        if (r) {
            $.get(_ROOT_ + '/product/doupdate?uid=' + uid, function(rsp) {
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

