<?php
class UserAction extends CommonAction {
	public function index() {
		$this->display();
	}
	public function getAllUser() {
		//Load('extend');
		$n =D("User");
		import("ORG.Util.Page"); //导入分页类
		$page=$_POST["page"];
		$rows=$_POST["rows"];
		$sort=$_POST["sort"];
		$order=$_POST["order"];
		//dump($order);
		if($_POST["name"]!=null&&$_POST["name"]!=""){
			$condition['account']=array('like',$_POST["name"]);
		}if($_POST["createdatetimeStart"]!=null&&$_POST["createdatetimeStart"]!=""){
			$condition['create_time']=array('between',$_POST["createdatetimeStart"],$_POST["createdatetimeEnd"]);
		}if($_POST["modifydatetimeStart"]!=null&&$_POST["modifydatetimeStart"]!=""){
			$condition['update_time']=array('between',$_POST["modifydatetimeStart"],$_POST["modifydatetimeEnd"]);
		}
		$count = $n->count(); //计算总数
		//$p = new Page($count,$rows);order($sort+','+$order)->
		$list = $n->relation(true)->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
		//dump($list);
		$list=json_encode($list);
		$result = '{"total":'.$count.',"rows":' . $list . '}';
		echo ($result); //输出json数据 
	}
	//添加用户提交处理  
	public function add() {
		$m =D("User");
		$_POST['password']=md5($_POST['password']);
		$roleId=$_POST['roleIds'];
		if(!$m->create($_POST)) {
			$this->ajaxReturn($_POST,$m->getError(),3);   
		}else{
			if($result=$m->add()) {
				//dump($result);
				$this->addRole($result,$roleId);
				$this->ajaxReturn($_POST,'添加用户成功！',1);
			}else{
				$this->ajaxReturn($m->getError(),'添加用户失败！',0);   
			}
		}
	}
	protected function addRole($userId,$roleId) {
		//新增用户自动加入相应权限组
		$RoleUser =M("role_user");
		$data['user_id']=$userId;
		$data['role_id']=$roleId;
		$RoleUser->create($data);
		$RoleUser->add($data);
	}
	// 更新数据
	public function edit(){
		//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
		$Form = D("user");
		$userId=$_POST['id'];
		$roleId=$_POST['roles'];
		if ($vo = $Form->create()) {
			$list = $Form->save($_POST);
			//dump($_POST);
			//未传入$data理由同上面的add方法
			/* 为了保证数据库的安全，避免出错更新整个数据表，如果没有任何更新条件，数据对象本身也不包含主键字段的话，
			  save方法不会更新任何数据库的记录。
			  因此下面的代码不会更改数据库的任何记录
			 */
			//dump($list);
				//注意save方法返回的是影响的记录数，如果save的信息和原某条记录相同的话，会返回0
				//所以判断数据是否更新成功必须使用 '$list!== false'这种方式来判断
				$this->editRole($userId,$roleId);
				$this->ajaxReturn($_POST,'更新成功！',1);
		} else {
			$this->ajaxReturn($_POST,$Form->getError(),3);
		}
	}
	protected function editRole($userId,$roleId) {
		//新增用户自动加入相应权限组
		$RoleUser =M("role_user");
		$data['user_id']=$userId;
		$data['role_id']=$roleId;
		$con['user_id']=$userId;
		//$RoleUser->create($data);
		$RoleUser->where($con)->save($data);
	}
	// 删除数据
	public function delete() {
		//在ThinkPHP中使用delete方法删除数据库中的记录。同样可以使用连贯操作进行删除操作。
		if (!empty ($_GET['ids'])) {
			$d = M("user");
			$condition['id']=array('in',$_GET['ids']);
			$result = $d->where($condition)->delete();
			/*
			  delete方法可以用于删除单个或者多个数据，主要取决于删除条件，也就是where方法的参数，
			  也可以用order和limit方法来限制要删除的个数，例如：
			  删除所有状态为0的5 个用户数据 按照创建时间排序
			  $Form->where('status=0')->order('create_time')->limit('5')->delete();
			  本列子没有where条件 传入的是主键值就行了
			 */
			if (false !== $result) {
				$RoleUser =M("role_user");
				$condition1['user_id']=array('in',$_GET['ids']);
				$RoleUser->where($condition1)->delete();
				$this->ajaxReturn($_GET,'删除用户成功！',1);
			} else {
				$this->ajaxReturn($_GET,'删除出错！',1);
			}
		} else {
			$this->ajaxReturn($_GET,'删除项不存在！',1);
		}
		//$this->redirect('index');
	}
	// 更新数据
	public function editPwd(){
		//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
		$Form = D("user");
		$_POST['password']=md5($_POST['password']);
		if ($vo = $Form->create()) {
			$list = $Form->save($_POST);
			//dump($_POST);
			//未传入$data理由同上面的add方法
			/* 为了保证数据库的安全，避免出错更新整个数据表，如果没有任何更新条件，数据对象本身也不包含主键字段的话，
			  save方法不会更新任何数据库的记录。
			  因此下面的代码不会更改数据库的任何记录
			 */
			//dump($list);
			if ($list !== false) {
				//注意save方法返回的是影响的记录数，如果save的信息和原某条记录相同的话，会返回0
				//所以判断数据是否更新成功必须使用 '$list!== false'这种方式来判断
				$this->ajaxReturn($_POST,'更新成功！',1);
			} else {
				$this->ajaxReturn($_POST,'没有更新任何数据!',0);
			}
		} else {
			$this->ajaxReturn($_POST,$Form->getError(),3);
		}
	}
}
?>