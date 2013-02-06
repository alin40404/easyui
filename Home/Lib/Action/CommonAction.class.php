<?php
class CommonAction extends Action {
	function _initialize() {
		import('ORG.Util.Cookie');
		// 用户权限检查  
		if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
			import('ORG.Util.RBAC');
			//dump(RBAC :: AccessDecision());
			if (!RBAC :: AccessDecision()) {
				//检查认证识别号  
				if (!$_SESSION[C('USER_AUTH_KEY')]) {
					if ($this->isAjax()) {
						$this->ajaxReturn(RBAC :: AccessDecision(), "你没有权限！请联系管理员", 0);  
						//$this->error("你没有权限"); 
						//echo ("<script >$.messager.show({title: '提示',msg: '你没有权限！请联系管理员赋予您权限！'});</script>");
					} else {
						//跳转到认证网关  
						redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
					}
				}

				// 没有权限 抛出错误  
				if (C('RBAC_ERROR_PAGE')) {
					// 定义权限错误页面                                  
					//redirect(C('RBAC_ERROR_PAGE'));
					$this->ajaxReturn(RBAC :: AccessDecision(), "你没有权限！请联系管理员赋予您权限！", 0);  
					//echo ("<script >$.messager.show({title: '提示',msg: '你没有权限！'});</script>");
				} else {
					if (C('GUEST_AUTH_ON')) {
						$this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
					}
					/*// 提示错误信息  
					if (isset ($_SESSION[C('USER_AUTH_KEY')])) {
						unset ($_SESSION[C('USER_AUTH_KEY')]);
						unset ($_SESSION);
						session_destroy();
					}*/
					//$this->error(L('_VALID_ACCESS_'));
					$this->ajaxReturn(meiquanxian, "你没有权限！请联系管理员赋予您权限！", 0);  
					//echo ("<script >$.messager.show({title: '提示',msg: '你没有权限！请联系管理员赋予您权限！'});</script>");
				}
			}
		}
	}
}
?>