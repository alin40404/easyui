<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	$(function() {
		$('#admin_zygl_treegrid').treegrid({
			url : APP+'/Node/getAllNode',
			idField : 'id',
			treeField : 'title',
			parentField : 'pid',
			fit : true,
			fitColumns : true,
			border : false,
			singleSelect:true,
			frozenColumns : [ [ {
				title : '编号',
				field : 'id',
				width : 150,
				hidden : true,
			}, {
				field : 'title',
				title : '节点名称',
				width : 200
			}, {
				field : 'name',
				title : '对应Action名称',
				width : 120
			} ] ],
			columns : [ [ {
				field : 'attributes',
				title : '节点路径',
				width : 100
			}, {
				field : 'sort',
				title : '排序',
				width : 50
			}, {
				field : 'pid',
				title : '上级ID',
				width : 50,
				hidden : true,
			}, {
				field : 'iconCls',
				title : '图标',
				width : 80
			}, {
				field : 'level',
				title : '等级',
				width : 50,
				formatter: function(value,row,index){
						if (value==1){
							return '<font color=blue>应用</font>';
						}else if (value==2){
							return '<font color=gray>模块</font>';
						}else {
							return '<font color=green>操作</font>';
						}
						}	
			}, {
				field : 'status',
				title : '状态',
				width : 50,
				formatter: function(value,row,index){
						if (value==1){
							return '可用';
						} else {
							return '<font color=red>禁用</font>';
						}
						}		
			},{
				field : 'ismenu',
				title : '是否菜单',
				width : 50,
				formatter: function(value,row,index){
						if (value==1){
							return '是';
						} else {
							return '<font color=red>否</font>';
						}
						}		
			}, {
				field : 'remark',
				title : '描述',
				width :200
			}] ],
			toolbar : [ {
				text : '增加',
				iconCls : 'icon-add',
				handler : function() {
					admin_zygl_appendFun();
				}
			}, '-',{
				text : '删除',
				iconCls : 'icon-remove',
				handler : function() {
					admin_zygl_deleteFun();
				}
			}, '-',{
				text : '编辑',
				iconCls : 'icon-edit',
				handler : function() {
					admin_zygl_editFun();
				}
			}, '-', {
				text : '展开',
				iconCls : 'icon-redo',
				handler : function() {
					var node = $('#admin_zygl_treegrid').treegrid('getSelected');
					if (node) {
						$('#admin_zygl_treegrid').treegrid('expandAll', node.cid);
					} else {
						$('#admin_zygl_treegrid').treegrid('expandAll');
					}
				}
			}, '-', {
				text : '折叠',
				iconCls : 'icon-undo',
				handler : function() {
					var node = $('#admin_zygl_treegrid').treegrid('getSelected');
					if (node) {
						$('#admin_zygl_treegrid').treegrid('collapseAll', node.cid);
					} else {
						$('#admin_zygl_treegrid').treegrid('collapseAll');
					}
				}
			}, '-', {
				text : '刷新',
				iconCls : 'icon-reload',
				handler : function() {
					$('#admin_zygl_treegrid').treegrid('reload');
				}
			} ],
			onContextMenu : function(e, row) {
				e.preventDefault();
				$(this).treegrid('unselectAll');
				$(this).treegrid('select', row.id);
				$('#admin_zygl_menu').menu('show', {
					left : e.pageX,
					top : e.pageY
				});
			}
		});
	});

	function admin_zygl_appendFun() {
		$('<div/>').dialog({
			href :TMPL+'/Node/add.html',
			width : 550,
			height :350,
			modal : true,
			title : '资源添加',
			buttons : [ {
				text : '增加',
				iconCls : 'icon-add',
				handler : function() {
					var d = $(this).closest('.window-body');
					$('#admin_zyglAdd_addForm').form('submit', {
						url : APP+'/Node/add',
						success : function(result) {
							try {
								var r = $.parseJSON(result);
								if (r.status==1) {
									$('#admin_zygl_treegrid').treegrid('reload');
									$('#layout_west_tree').tree('reload');
									d.dialog('destroy');
									$.messager.show({
									title : '提示',
									msg :r.info,
									});
								}else{
									$.messager.show({
									title : '提示',
									msg :r.info,
									});
								}
							} catch (e) {
								$.messager.alert('提示', result);
							}
						}
					});
				}
			} ],
			onClose : function() {
				$(this).dialog('destroy');
			}
		});
	}
	function admin_zygl_editFun(id) {
		if (id != undefined) {
			$('#admin_zygl_treegrid').treegrid('select', id);
		}
		var node = $('#admin_zygl_treegrid').treegrid('getSelected');
		console.info(node);
		$('<div/>').dialog({
			href :TMPL+'/Node/edit.html',
			width : 550,
			height : 350,
			modal : true,
			title : '资源编辑',
			buttons : [ {
				text : '编辑',
				iconCls : 'icon-edit',
				handler : function() {
					var d = $(this).closest('.window-body');
					$('#admin_zyglEdit_editForm').form('submit', {
						url : APP+'/Node/edit',
						success : function(result) {
							try {
								var r = $.parseJSON(result);
								if (r.status) {
									$('#admin_zygl_treegrid').treegrid('reload');
									d.dialog('destroy');
									$('#layout_west_tree').tree('reload');
								}
								$.messager.show({
									title : '提示',
									msg : r.info
								});
							} catch (e) {
								$.messager.alert('提示', result);
							}
						}
					});
				}
			} ],
			onClose : function() {
				$(this).dialog('destroy');
			},
			onLoad : function() {
				$('#admin_zyglEdit_editForm').form('load', node);
			}
		});
	}
	function admin_zygl_deleteFun(id) {
		if (id != undefined) {
			$('#admin_zygl_treegrid').treegrid('select', id);
		}
		var node = $('#admin_zygl_treegrid').treegrid('getSelected');
		if (node) {
			$.messager.confirm('询问', '您确定要删除【' + node.title + '】？', function(b) {
				if (b) {
					$.ajax({
						url :APP+'/Node/delete',
						data : {
							id : node.id
						},
						cache : false,
						dataType : 'JSON',
						success : function(r) {
							if (r.status) {
								$('#admin_zygl_treegrid').treegrid('remove', r.data.id);
								$('#layout_west_tree').tree('reload');
								//$('#admin_zygl_treegrid').treegrid('reload');这里的reload是重新加载所有数据，而remove是根据id移除一条数据
							}
							$.messager.show({
								msg : r.info,
								title : '提示'
							});
						}
					});
				}
			});
		}
	}
</script>
<table id="admin_zygl_treegrid"></table>
<div id="admin_zygl_menu" class="easyui-menu" style="width:120px;display: none;">
	<div onclick="admin_zygl_appendFun();" data-options="iconCls:'icon-add'">增加</div>
	<div onclick="admin_zygl_deleteFun();" data-options="iconCls:'icon-remove'">删除</div>
	<div onclick="admin_zygl_editFun();" data-options="iconCls:'icon-edit'">编辑</div>
</div>