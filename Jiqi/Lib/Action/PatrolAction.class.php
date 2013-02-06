<?php
// 本类由系统自动生成，仅供测试用途
class PatrolAction extends CommonAction {
	public function index() {
		$patrol = M("ps_guanxian");
		$list = $patrol->select();
		$this->assign("list", $list);
		//dump($list);
		$this->display();
	}
	public function google() {
		$patrol = M("ps_guanxian");
		//胶州管线
		$condition['mark'] = '胶州';
		$jiaozhoulist = $patrol->where($condition)->select();
		//dump($jiaozhoulist);
		$this->assign("jiaozhoulist", $jiaozhoulist);
		//城阳管线
		$condition2['mark'] = '城阳';
		$chengyanglist = $patrol->where($condition2)->select();
		//dump($list);
		$this->assign("chengyanglist", $chengyanglist);
		//巡线
		$checkdatalist = M("ps_checkdata");
		import("ORG.Util.Page"); //导入分页类
		$count = $checkdatalist->count(); //计算总数
		$p = new Page($count, 10);
		$condition3['MACHINECODE'] = 'B057';
		$condition3['CHECKTIME'] = array('between','2012-01-04,2012-01-05');
		$checkdatalist = $checkdatalist->where($condition3)->select();
		//dump($checkdatalist);
		$this->assign("checkdatalist", $checkdatalist);
		$this->display();
	}
	public function sogou() {
		$patrol = M("ps_guanxian");
		$chengyanglist = $patrol->order('id asc')->select();	
		$list=json_encode($chengyanglist);
		//echo ($list);
		$this->ajaxReturn($list,'管线数据加载成功！',1); //输出json数据 
	}
	public function xunxian() {
		//巡线
		$checkdatalist = M("ps_checkdata");
		import("ORG.Util.Page"); //导入分页类
		$count = $checkdatalist->count(); //计算总数
		$p = new Page($count, 10);
		$condition3['MACHINECODE'] = 'B057';
		$condition3['CHECKTIME'] = array('between','2012-01-04,2012-01-05');
		$checkdatalist = $checkdatalist->where($condition3)->select();
		//dump($checkdatalist);
		$this->assign("checkdatalist", $checkdatalist);
		//$this->display();
	}
	// 编辑数据
	public function edit() {
		if (!empty ($_GET['id'])) {
			$Form = D("guanxian");
			$vo = $Form->getById($_GET['id']);
			if ($vo) {
				$this->assign('vo', $vo);
				$this->display();
			} else {
				exit ('编辑项不存在！');
			}
		} else {
			exit ('编辑项不存在！');
		}
	}
	// 更新数据
	public function update() {
		//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
		$Form = D("news");
		$_POST["id"] = $_GET["id"];
		//$_POST["newscreattime"] = time();
		$htmlData = '';
		if (!empty ($_POST['content1'])) {
			if (get_magic_quotes_gpc()) {
				$htmlData = stripslashes($_POST['content1']);
			} else {
				$htmlData = $_POST['content1'];
			}
		}
		$_POST['newscontent'] = $htmlData;
		if ($vo = $Form->create()) {
			$list = $Form->save();
			//未传入$data理由同上面的add方法
			/* 为了保证数据库的安全，避免出错更新整个数据表，如果没有任何更新条件，数据对象本身也不包含主键字段的话，
			  save方法不会更新任何数据库的记录。
			  因此下面的代码不会更改数据库的任何记录
			 */
			//dump($list);
			if ($list !== false) {
				//注意save方法返回的是影响的记录数，如果save的信息和原某条记录相同的话，会返回0
				//所以判断数据是否更新成功必须使用 '$list!== false'这种方式来判断
				$this->success('数据更新成功！', "__URL__/index");
			} else {
				$this->error("没有更新任何数据!");
			}
		} else {
			$this->error($Form->getError());
		}
		//$this->redirect('index');
	}
	public function checkDataReport(){
		//巡线
		$checkdatalist = M("ps_checkdata");
		import("ORG.Util.Page"); //导入分页类
		$count = $checkdatalist->count(); //计算总数
		$p = new Page($count, 10);
		//$condition3['MACHINECODE'] = 'B057';
		$checktimeStart=$_GET["checktimeStart"];
		$checktimeEnd=$_GET["checktimeEnd"];
		$condition3['CHECKTIME'] = array('between',array($checktimeStart,$checktimeEnd));
		$checkdatalist = $checkdatalist->where($condition3)->limit(100)->select();
		$checkdatalist=json_encode($checkdatalist);
		$result = '{"total":'.$count.',"rows":' . $checkdatalist . '}';
		echo ($result);
		//dump($checkdatalist);
		//$this->ajaxReturn($checkdatalist,"查询成功",1);
	}
}
?>