<?php
// 本类由系统自动生成，仅供测试用途
class UserModel extends RelationModel{
	public $_validate	=	array(
		//array('account','/^[a-z]\w{3,}$/i','帐号格式错误'),
		//array('password','require','密码必须'),
		//array('nickname','require','昵称必须'),
		//array('repassword','require','确认密码必须'),
		//array('repassword','password','确认密码不一致',self::EXISTS_VAILIDATE,'confirm'),
		array('account','','帐号名称已经存在！',0,'unique',1), 
		);
/*	public $_auto=array(
		//array('password','pwdHash',1,'callback'),
		//array('create_time','getDate',1,'function'),
		//array('update_time','getDate',2,'function'),
		);*/

	protected function pwdHash() {
		if(isset($_POST['password'])) {
			return md5($_POST['password']);
		}else{
			return 123456;
		}
	}
	protected  $_link = array(
	'role_user'=>array(
		'mapping_type'=>MANY_TO_MANY,
		'class_name'=>'role',
		'mapping_name'=>'roles',
		'foreign_key'=>'user_id',
		'relation_foreign_key'=>'role_id',
		'relation_table'=>'role_user',
		//'as_fields'=>'name',
		),
	);
}
?>