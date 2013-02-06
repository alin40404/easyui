<?php


// 本类由系统自动生成，仅供测试用途
class ReportAction extends Action {
	public function index() {
		$this->display("index");
	}
	public function view() {
		$jiqi = M("jiqi");
		import("ORG.Util.Page"); //导入分页类
		$count = $jiqi->count(); //计算总数
		//$list = $jiqi->page($_POST["page"],$_POST["rows"])->select();
		$list = $jiqi->select();
		$list = json_encode($list);
		$result = '{"total":'.$count.',"rows":' . $list . '}';
		echo $result;
	}
}
?>