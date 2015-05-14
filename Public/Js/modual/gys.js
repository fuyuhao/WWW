var $grid = $('#bt_user_grid'), viewDialog, $typeGrid;
context.ready = function() {
    $grid.datagrid({
        fit: true,
        idField: 'uid',
        url: _ROOT_ + '/gys/getData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'uname', title: '名字', width: 90, align: 'center'},
                {field: 'account', title: '账号', width: 130, align: 'center'},
                {field: 'mail', title: '邮箱', width: 130, align: 'center'},
                {field: 'ustatus', title: '审核状态', width: 70, align: 'center', formatter: function(value) {
                        if (value === '1') {
                            return '已审核';
                        }
                        return '<font color="red">未审核</font>';
                    }},
                {field: 'uid', title: '审核操作', width: 100, align: 'center', formatter: function(value) {
                        return '<span title="审核" class="img-btn icon-edit" uid=' + value + '></span>';
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
            $bodyView.find('span[uid]').click(function(e) {
                e.stopPropagation();
                var uid = $(this).attr('uid');
                updateView(uid);
            });
        }
    });
};

var addView = function() {

};
var updateView = function(uid) {
	
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

