﻿var $grid = $('#bt_userfilter_grid'), viewDialog, $typeGrid;
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
                {field: 'uid', title: '操作', width: 100, align: 'center', formatter: function(value) {
						var ctrs = ['<span  title="中标" class="img-btn icon-tip" type="detail" uid=' + value + '></span>', '<span title="删除" class="img-btn icon-remove" type="check" uid=' + value + '></span>'];
                        return ctrs.join(' ');
						
                    }}
            ]],
        toolbar: [{
                text: '所有报价',
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
	var myurl=_ROOT_ + '/news/allprice'
    window.open(myurl);        
};
context.updateView = function(uid) {
	
	$.confirm('确认删除？', function(r) {
        if (r) {
            $.get(_ROOT_ + '/news/addfilter?uid=' + uid, function(rsp) {
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
	
	$.confirm('确认中标？', function(r) {
        if (r) {
            $.get(_ROOT_ + '/news/newswin?uid=' + uid, function(rsp) {
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

