var $grid = $('#bt_addprice_grid'), viewDialog, $typeGrid;
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
                text: '导出',
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
	getFile('/news/myexport',$("#bt_addprice_grid").serialize());
};

function getFile(address,parameters){
	window.location='news/myexport';
}


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




