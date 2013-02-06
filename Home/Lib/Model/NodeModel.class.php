<?php
// 节点模型
class NodeModel extends Model {
	protected $_validate = array(
		array('title','checkNode','节点已经存在',0,'callback',1),
		//array('name','','名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
		);
	public function checkNode() {
		$map['title'] = $_POST['title'];
		$map['pid']	=isset($_POST['pid'])?$_POST['pid']:0;
        //$map['status'] = 1;
		$result	= $this->where($map)->select();
        if($result) {
        	return false;
        }else{
			return true;
		}
	}
}
?>