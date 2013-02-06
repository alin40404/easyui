<?php
// 角色模型
class RoleViewModel extends ViewModel {
	public $viewFields = array (
		'Role' => array (
			'id',
			'name',
			'pid',
			'status',
			'remark',
			'ename',
			'create_time',
			'update_time',
		),
		'Node' => array (
			'id',
			'name',
			'title',
			'status',
			'attributes',
			'iconCls',
			'sort',
			'pid',
			'level',
			'remark',
		),
		'Access' => array (
			'title',
			'_on' => 'Role.id=Node.id'
		),

	);
}
?>