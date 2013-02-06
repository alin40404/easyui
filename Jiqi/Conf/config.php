<?php
$siteconfig = require './siteconfig.php';
$config = array (
	/*'DB_TYPE' => 'Oracle', // 数据库类型
	'DB_HOST' => '124.65.82.214', // 服务器地址
	'DB_NAME' => 'ORCL', // 数据库名
	'DB_USER' => 'pcsys', // 用户名
	'DB_PWD' => 'pcsysloader', // 密码
	'DB_PREFIX'	=>'PC_',// 数据表前缀
	'DB_PORT' => '1521', // 端口*/

	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'dwz_thinkphp',
	'DB_USER' => 'root',
	'DB_PWD' => 'root',
	'DB_PORT' => '3306',
	'DB_PREFIX' => '',
	'SHOW_PAGE_TRACE' => 1, //打开调试模式
	'SHOW_ERROR_MSG' => true, //显示错误信息
	'TMPL_ACTION_ERROR' => 'Public:error', // 默认错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' => 'Public:success', // 默认成功跳转对应的模板文件

	'USER_AUTH_ON' => true,
	'USER_AUTH_TYPE' => 1, // 默认认证类型 1 登录认证 2 实时认证
	'USER_AUTH_KEY' => 'authId', // 用户认证SESSION标记
	'ADMIN_AUTH_KEY' => 'administrator',
	'USER_AUTH_MODEL' => 'User', // 默认验证数据表模型
	'AUTH_PWD_ENCODER' => 'md5', // 用户认证密码加密方式
	'USER_AUTH_GATEWAY' => '/Public/login', // 默认认证网关
	'NOT_AUTH_MODULE' => 'Public', // 默认无需认证模块
	'REQUIRE_AUTH_MODULE' => '', // 默认需要认证模块
	'NOT_AUTH_ACTION' => '', // 默认无需认证操作
	'REQUIRE_AUTH_ACTION' => '', // 默认需要认证操作
	'GUEST_AUTH_ON' => false, // 是否开启游客授权访问
	'GUEST_AUTH_ID' => 0, // 游客的用户ID

	//'DB_LIKE_FIELDS'=>'title|remark',
	'RBAC_ROLE_TABLE' => 'role',
	'RBAC_USER_TABLE' => 'role_user',
	'RBAC_ACCESS_TABLE' => 'access',
	'RBAC_NODE_TABLE' => 'node',
	
);
return array_merge($config, $siteconfig);
?>