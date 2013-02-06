<?php
class RoleAction extends CommonAction {
	public function index() {
		$this->display();
	}
	public function getAllRole() {
		$n =D("Role");
		import("ORG.Util.Page"); //导入分页类
		$page = $_POST["page"];
		$rows = $_POST["rows"];
		$sort = $_POST["sort"];
		$order = $_POST["order"];
		$count = $n->count(); //计算总数
		//$p = new Page($count,$rows);order($sort+','+$order)->
		$list = $n->relation(true)->order('id desc')->select();
		//$list = $n->select();
		$list = json_encode($list);
		$result = '{"total":' . $count . ',"rows":' . $list . '}';
		echo ($list); //输出json数据   
	}
	//添加
	public function add() {
		$m = D("Role");
		if (!$m->create()) {
			$this->ajaxReturn($_POST,$m->getError(), 3);
		} else {
			if ($result = $m->add()) {
				$this->addNode($result,$_POST['resourceIds']);
				$this->ajaxReturn($result, '添加用户成功！', 1);
			} else {
				$this->ajaxReturn($_POST, '添加失败！', 0);
			}
		}
	}
	protected function addNode($roleId,$nodeIds) {
		//新增角色加入相应的操作
		$ac =D("access");
		for($i=0; $i<count($nodeIds); $i++){
			$data[$i]['role_id'] = $roleId;   
			$data[$i]['node_id'] = $nodeIds[$i];   
		}
		$ac->addAll($data);
	}
	// 更新数据
	public function edit() {
		//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
		$Form =D("Role");
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
				$ac =M("access");
				$condition1['role_id']=$_POST['id'];
				$ac->where($condition1)->delete();
				$this->addNode($_POST['id'],$_POST['resourceIds']);
				$this->ajaxReturn($_POST, '更新成功！', 1);
			} else {
				$this->ajaxReturn($_POST, '没有更新任何数据!', 1);
			}
		} else {
			$this->ajaxReturn($_POST, $Form->getError(), 1);
		}
	}
	protected function editRole($roleId,$nodeId) {
		//新增用户自动加入相应权限组
		$RoleUser =M("access");
		for($i=0; $i<count($roleId); $i++){
			$data[$i]['role_id'] = $roleId;   
			$data[$i]['node_id'] = $nodeId[$i];   
		}
		//$data['user_id']=$roleId;
		//$data['role_id']=$roleId;
		$con['role_id']=$roleId;
		//$RoleUser->create($data);
		$RoleUser->where($con)->save($data);
	}
	// 删除数据
	public function delete() {
		//在ThinkPHP中使用delete方法删除数据库中的记录。同样可以使用连贯操作进行删除操作。
		if (!empty ($_GET['ids'])) {
			$d = D("Role");
			$condition['id'] = array ('in',$_GET['ids']);
			$result = $d->where($condition)->delete();
			/*
			  delete方法可以用于删除单个或者多个数据，主要取决于删除条件，也就是where方法的参数，
			  也可以用order和limit方法来限制要删除的个数，例如：
			  删除所有状态为0的5 个用户数据 按照创建时间排序
			  $Form->where('status=0')->order('create_time')->limit('5')->delete();
			  本列子没有where条件 传入的是主键值就行了
			 */
			if (false !== $result) {
				$ac =M("access");
				$condition1['role_id']=array('in',$_GET['ids']);
				$ac->where($condition1)->delete();
				$this->ajaxReturn($_GET, '删除成功！', 1);
			} else {
				$this->ajaxReturn($d->getError(),$d->getError(), 0);
			}
		} else {
			$this->ajaxReturn($d->getError(), '删除项不存在！',3);
		}
	}
}
?>