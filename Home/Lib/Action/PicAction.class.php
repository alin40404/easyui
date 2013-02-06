<?php

// 本类由系统自动生成，仅供测试用途
class PicAction extends CommonAction {
	public function index() {
			echo "111";
    $Form = D("Items");
    $list   = $Form->field('*')->limit(0,10)->findAll();
    //dump($Form->getLastSql());
    //dump($list);
		
	}
	public function pic() {
		$this->display();
	}
	public function high() {
		$this->display();
	}
	public function sogou() {
		$patrol = M("guanxian");
		$list = $patrol->select();
		//dump($list);
		$this->assign("list",$list);
		$this->display();
	}
}
?>