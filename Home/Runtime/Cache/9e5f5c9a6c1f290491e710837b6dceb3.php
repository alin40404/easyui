<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" charset="utf-8">
	function logoutFun(b) {
		$.getJSON('__APP__/Public/logout', function(result) {
			if (b) {
				location.replace('__APP__/Index');
			} else {
				$('#sessionInfoDiv').html('');
				$('#user_login_loginDialog').dialog('open');
				$('#layout_east_onlineDatagrid').datagrid('load', {});
			}
		});
	}
	function userInfoFun() {
		$('<div/>').dialog({
			href : '__APP__/Layout/userInfo',
			width : 550,
			height :450,
			modal : true,
			title : '用户信息',
			buttons : [ {
				text : '修改密码',
				iconCls : 'icon-edit',
				handler : function() {
					var d = $(this).closest('.window-body');
					$('#user_userInfo_form').form('submit', {
						url : '__APP__/User/editPwd',
						success : function(result) {
							try {
								var r = $.parseJSON(result);
								if (r.status) {
									d.dialog('destroy');
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
			}
		});
	}
	function sysInfoFun() {
		$('<div/>').dialog({
			href : '__APP__/Layout/main',
			width : 490,
			height :380,
			modal : true,
			title : '系统信息',
			onClose : function() {
				$(this).dialog('destroy');
			},
			onLoad : function() {
			}
		});
	}
	function changeMenu(opts,title){
		alert('nihao');
		console.info($('#layoutMenu'));
		$('#layoutMenu').href=opts;
	}
	function north_addTab(opts,title){
		layout_center_addTabFun({
			title : title,
			closable : true,
			content : '<iframe src="'+opts+'" frameborder="0" style="border:0;width:100%;height:99%;"></iframe>'
		});
	}
</script>
<div id="sessionInfoDiv" style="position:absolute;right:260px;top:6px;">
	<span><c:if test="${sessionInfo.userId != null}">[<strong><?php echo ($_SESSION['nickname']); ?></strong>]，欢迎你！您使用[<strong><?php echo ($_SESSION['last_login_ip']); ?></strong>]IP登录！</c:if></span>
</div>
<div style="position: absolute; right: 0px;top:0px; bottom: 0px; ">
	 <a href="javascript:void(0);" class="easyui-menubutton" data-options="menu:'#layout_north_cjMenu',iconCls:'icon-ok'">实用插件</a>
	 <a href="javascript:void(0);" class="easyui-menubutton" data-options="menu:'#layout_north_kzmbMenu',iconCls:'icon-help'">控制面板</a> 
	 <a href="javascript:void(0);" class="easyui-menubutton" data-options="menu:'#layout_north_zxMenu',iconCls:'icon-back'">注销</a>
</div>
<div style="position: absolute; right: 0px;bottom: 0px; ">
	 <a href="javascript:void(0);" class="easyui-linkbutton" onclick="changeMenu('__TMPL__/Layout/1west.html','在线电视');">机器管理</a>
	 <a href="javascript:void(0);" class="easyui-linkbutton" data-options="menu:'#layout_north_kzmbMenu'">模块二管理</a> 
	 <a href="javascript:void(0);" class="easyui-linkbutton" data-options="menu:'#layout_north_zxMenu'">系统管理</a>
</div>
<div id="layout_north_cjMenu" style="width: 120px; display: none;">
	<div onclick="north_addTab('__TMPL__/Layout/dianshi.html','在线电视');">在线电视</div>
	<div onclick="north_addTab('http://123.sogou.com/sub/tianqi.html?d=7','天气预报');">天气预报</div>
	<div onclick="north_addTab('http://baidu.kuaidi100.com/','快递查询');">快递查询</div>
	<div onclick="north_addTab('http://dynamic.12306.cn/otsquery/query/queryRemanentTicketAction.do?method=init','火车余票查询');">火车余票查询</div>
	<div onclick="north_addTab('http://site.baidu.com/list/wannianli.htm','万年历');">万年历</div>
	<div onclick="north_addTab('http://123.sogou.com/shenghuo/shouji.html','花费充值');">花费充值</div>
	<div onclick="north_addTab('http://chaxun.1616.net/wangsu.htm','网络测速');">网络测速</div>
</div>
<div id="layout_north_kzmbMenu" style="width: 100px; display: none;">
	<div onclick="userInfoFun();">个人信息</div>
	<div class="menu-sep"></div>
	<div>
		<span>更换主题</span>
		<div style="width: 120px;">
			<div onclick="changeTheme('default');">default</div>
			<div onclick="changeTheme('gray');">gray</div>
			<div onclick="changeTheme('metro');">metro</div>
			<div onclick="changeTheme('cupertino');">cupertino</div>
			<div onclick="changeTheme('dark-hive');">dark-hive</div>
			<div onclick="changeTheme('pepper-grinder');">pepper-grinder</div>
			<div onclick="changeTheme('sunny');">sunny</div>
		</div>
	</div>
</div>

<div id="layout_north_zxMenu" style="width: 100px; display: none;">
	<div onclick="sysInfoFun();">系统信息</div>
	<div class="menu-sep"></div>
	<div onclick="logoutFun(true);">退出系统</div>
</div>