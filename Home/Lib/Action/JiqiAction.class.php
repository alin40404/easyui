<?php
// 本类由系统自动生成，仅供测试用途
class JiqiAction extends CommonAction {
	public function index() {
		$this->display("index");
	}
	public function view() {
		$jiqi = M("jiqi");
		import("ORG.Util.Page"); //导入分页类
		$count = $jiqi->count(); //计算总数
		$page=$_POST["page"];
		$rows=$_POST["rows"];
		$sort=$_POST["sort"];
		$order=$_POST["order"];
		//$list = $jiqi->page($_POST["page"],$_POST["rows"])->select();
		$list = $jiqi->page($page,$rows)->order(array($sort=>$order))->select();
		$list = json_encode($list);
		$result = '{"total":'.$count.',"rows":' . $list . '}';
		echo ($result);
	}
}
?>