<?php
// 角色模型
class RoleModel extends RelationModel {
	protected $_validate = array(
		array('name','require','名称必须'),
		array('name','','名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
		);

	protected $_auto=array(
		array('create_time','time',1,'function'),
		array('update_time','time',1,'function'),// 对create_time字段在更新的时候写入当前时间戳
		);
	protected  $_link = array(
	'access'=>array(
		'mapping_type'=>MANY_TO_MANY,
		'class_name'=>'node',
		'mapping_name'=>'nodes',
		'foreign_key'=>'role_id',
		'relation_foreign_key'=>'node_id',
		'relation_table'=>'access',
		//'as_fields'=>'title',
		),
	);
}
?>