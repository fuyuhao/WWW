var $grid = $('#bt_userfilter_grid'), viewDialog, $typeGrid;
context.ready = function() {
    $grid.datagrid({
        fit: true,
        idField: 'uid',
        url: _ROOT_ + '/news/getuserData',
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
						var ctrs = ['<span title="删除" class="img-btn icon-remove" type="check" uid=' + value + '></span>'];
                        return ctrs.join(' ');
						
                    }}
            ]],
        toolbar: [{
                text: '所有报价',
                iconCls: 'icon-add',
                handler: addView
            }, {
                text: '删除中标',
                iconCls: 'icon-remove',
                handler: doDelete
			}, {
                text: '添加竞价人',
                iconCls: 'icon-add',
                handler: adduser
            }, '-', {
                text: '删除竞价',
                iconCls: 'icon-remove',
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
				alert("用户已过滤！该用户无权参与本次竞标！");
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
	$.confirm('确认删除？', function(r) {
        if (r) {
            $.get(_ROOT_ + '/news/delwin', function(rsp) {
            if (rsp.status) {
				alert("可以重新选择中标人！");
                $grid.datagrid('reload');
            } else {
                $.alert(rsp.msg);
                }
            }, 'JSON');
            }
        });
};

var doSubmit = function() {
    $bt_unit_from = $('#bt_unit_from');
        $.post(_ROOT_ + '/news/saveuser', $bt_unit_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
};

var adduser = function() {
    viewDialog = $.dialog({
        title: '添加竞价人',
        href: _ROOT_ + '/news/adduser',
        width: 300,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: doSubmit
            }]
    });
};

var typeView = function() {
	$.confirm('确认删除？', function(r) {
        if (r) {
            $.get(_ROOT_ + '/news/delnews', function(rsp) {
            if (rsp.status) {
				alert("竞标项目已删除！");
                //$grid.datagrid('reload');
				 window.location.href = "/"; 
            } else {
                $.alert(rsp.msg);
                }
            }, 'JSON');
            }
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

