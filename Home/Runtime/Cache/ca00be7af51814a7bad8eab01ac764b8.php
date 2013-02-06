<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
    
    $(function(){	
        checkData = function(){
            var checktime = $("#weat_xxForm input[name=checktime]").val();
            /*$('#weat_xxTree').tree({
                url: '__APP__/Patrol/checkDataMenu',
                data: 'checktime&' + checktime,
                parentField: 'pid',
                lines: true,
                onLoadSuccess: function(node, data){
                    $('#xtTree').tree('collapseAll');
                },
                onLoadError: function(error){
                    $.messager.show({
                        title: '提示',
                        msg: "数据加载出错",
                        showType: 'slide',
                    });
                }
            });
            layout_center_addTabFun({
                title: '谷歌地图',
                closable: true,
                content: '<iframe src="__APP__/Patrol/google" frameborder="0" style="border:0;width:100%;height:99%;"></iframe>'
            });*/
            layout_center_addTabFun({
                title: '搜狗地图',
                closable: true,
                //content: '<iframe src="__APP__/Patrol/sogou" frameborder="0" style="border:0;width:100%;height:99%;"></iframe>'
            	href:'__TMPL__/Patrol/sogou.html',
			});
        }
        $('#xtTree').tree({
            url: '__APP__/Layout/menu',
            parentField: 'pid',
            lines: true,
            onLoadSuccess: function(node, data){
                $('#xtTree').tree('collapseAll');
            }
        });
        $('#layout_west_tree').tree({
            url: '__APP__/Layout/menu',
            parentField: 'pid',
            lines: true,
            onClick: function(node){
                var url;
                //console.info(node.attributes);
                if (node.attributes) {
                    url = APP + node.attributes;
                }
                else {
                    url = '__APP__' + url;
                }
                if (url.indexOf('druidController') > -1) {/*要查看连接池监控页面*/
                    layout_center_addTabFun({
                        title: node.text,
                        closable: true,
                        iconCls: node.iconCls,
                        content: '<iframe src="' + url + '" frameborder="0" style="border:0;width:100%;height:99%;"></iframe>'
                    });
                }
                else {
                    layout_center_addTabFun({
                        title: node.text,
                        closable: true,
                        iconCls: node.iconCls,
                        href: url
                    });
                }
            }
        });
        $('#tt').tree({ //已经删除  
            url: '__APP__/Layout/menu',
            parentField: 'pid',
            lines: true,
        });
        
    });
    function layout_center_addTab(url, title){
        layout_center_addTabFun({
            title: title,
            closable: true,
            href: url,
        });
    }
</script>
<div class="easyui-accordion" data-options="fit:true,border:false">
    <div title="巡线查询" data-options="iconCls:'icon-house'" style="padding:5px;">
        <div id="west_info" style="display:none;background:red;width:190px;height:40px;line-height:40px;color:#fff;font-size:20px;padding:10px;">
            昨天有<strong>25</strong>台设备未执行巡检
        </div>
        <form id="weat_xxForm" action="" method="" accept-charset="utf-8">
            <input type="text" name="checktime" class="easyui-datebox" data-options="" required="required"><input type="button" class="easyui-linkbutton" value="查询" onclick="checkData();">
        </form>
        <div id="weat_xxTree">
        </div>
    </div>
    <div title="巡线管理" data-options="iconCls:'icon-house'" class="left_menu">
		 <ul>
            <li>
                <div onclick="layout_center_addTab('__APP__/User/index','巡线仪管理');"><img src="__PUBLIC__/images/patrol/Instrument.jpg" width="16" height="16"/>巡线仪管理</div>
            </li>
            <li>
                <div onclick="layout_center_addTab('__APP__/User/index','巡线员管理');"><img src="__PUBLIC__/images/patrol/Employee.jpg" width="16" height="16"/>巡线员管理 </div>
            </li>
            <li>
                <div onclick="layout_center_addTab('__APP__/User/index','巡线缺陷管理');"><img src="__PUBLIC__/images/patrol/DefectEvent.jpg" width="16" height="16"/>巡线缺陷管理</div>
            </li>
			<li>
                <div onclick="layout_center_addTab('__APP__/User/index','巡线仪消息发送');"><img src="__PUBLIC__/images/patrol/Message.jpg" width="16" height="16"/>巡线仪消息发送</div>
            </li>
			<li>
                <div onclick="layout_center_addTab('__APP__/User/index','关键点审核');"><img src="__PUBLIC__/images/patrol/Payment.jpg" width="16" height="16"/>关键点审核</div>
            </li>
			<li>
                <div onclick="layout_center_addTab('__APP__/User/index','电力对象管理');"><img src="__PUBLIC__/images/patrol/EPObject.jpg" width="16" height="16"/>电力对象管理</div>
            </li>
			<li>
                <div onclick="layout_center_addTab('__APP__/User/index','数据查看');"><img src="__PUBLIC__/images/patrol/Instrument.jpg" width="16" height="16"/>数据查看</div>
            </li>
        </ul>
    </div>
    <div title="巡线报表" data-options="iconCls:'icon-house'" class="left_menu">
         <ul>
            <li>
                <div onclick="layout_center_addTab('__APP__/User/index','巡检月报表');"><img src="__PUBLIC__/images/DataAnaly.jpg" width="16" height="16"/>巡检月报表</div>
            </li>
            <li>
                <div onclick="layout_center_addTab('__APP__/User/index','巡检个人报表');"><img src="__PUBLIC__/images/DataAnaly.jpg" width="16" height="16"/>巡检个人报表 </div>
            </li>
            <li>
                <div onclick="layout_center_addTab('__APP__/User/index','巡检部门报表');"><img src="__PUBLIC__/images/DataAnaly.jpg" width="16" height="16"/>巡检部门报表</div>
            </li>
        </ul>
    </div>
	<!--<div title="业务办理" iconCls="icon-add"  class="left_menu">
            <ul>
                <li>
                    <div onclick="layout_center_addTab('__APP__/User/index','巡检部门报表');"><img src="__PUBLIC__/images/DataAnaly.jpg" width="16" height="16"/>备案办理</div>
                </li>
                <li>
                    <div onclick="layout_center_addTab('__APP__/User/index','巡检部门报表');"><img src="__PUBLIC__/images/DataAnaly.jpg" width="16" height="16"/>调解办理 </div>
                </li>
                <li>
                    <div onclick="layout_center_addTab('__APP__/User/index','巡检部门报表');"><img src="__PUBLIC__/images/DataAnaly.jpg" width="16" height="16"/>评审办理</div>
                </li>
                <li>
                    <div onclick="layout_center_addTab('__APP__/User/index','巡检部门报表');"><img src="__PUBLIC__/images/DataAnaly.jpg" width="16" height="16"/>交付办理 </div>
                </li>
            </ul>
     </div>-->
    <div title="系统维护" data-options="isonCls:'icon-house',tools : [ {
 iconCls : 'icon-reload',
 handler : function() {
$('#layout_west_tree').tree('reload');
}
}, {
 iconCls : 'icon-redo',
 handler : function() {
 var node = $('#layout_west_tree').tree('getSelected');
 if (node) {
$('#layout_west_tree').tree('expandAll',  node.target);
}  else {
$('#layout_west_tree').tree('expandAll');
}
}
}, {
 iconCls : 'icon-undo',
 handler : function() {
 var node = $('#layout_west_tree').tree('getSelected');
 if (node) {
$('#layout_west_tree').tree('collapseAll',  node.target);
}  else {
$('#layout_west_tree').tree('collapseAll');
}
}
}  ]">
        <ul id="layout_west_tree">
        </ul>
    </div>
</div>