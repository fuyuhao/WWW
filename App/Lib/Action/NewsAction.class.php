<?php
class NewsAction extends BaseAction {

    public function postnews() {
		$this->display();
	}
	
	public function addproduct() {
		$this->display();
	}
	
	public function comboData1() {
		$did = $_GET['pid'];
        $TypeModel = D('Product');
        $list = $TypeModel->where('pid = %d', $did)->select();
        $this->ajaxReturn($list);
    }
	
	public function comboData2() {
        $TypeModel = D('Product');
        $list = $TypeModel->select();
        $this->ajaxReturn($list);
    }
	
	public function getData() {
        $TypeModel = D('NewsProduct');
		$nid = session('nid');
        $dataList = $TypeModel->join('bt_product ON bt_product.pid=bt_news_product.pid')->where('nid = %d', $nid)->select();
        $this->returnGridData($dataList, $TypeModel->count());
		

    }
	
	public function doSave() {
			//$nid = session('nid');
		//dump($nid);
	$file = M('NewsProduct');
	$pid = $_POST['bt_product_combobox'];
	$punit = $_POST['bt_unit_combobox'];
	$pcount = $_POST['pcount'];
	$pdetail = $_POST['pdetail'];
	$nid = session('nid');
	$file->pid=$pid;
	$file->punit=$punit;
	$file->npcount=$pcount;
	$file->npdetail=$pdetail;
	$file->nid=$nid;
	$file->add();
	$this->returnStatus();
	}

	
	
	public function save() {
	$file = M('News');
	$mydetail = $_POST['mydetail'];
	$newscontent = $_POST['newscontent'];
	$newsstart = $_POST['newsstart'];
	$newsend = $_POST['newsend'];
	$file->ntitle=$mydetail;
	$file->ntext=$newscontent;
	$file->nstart=$newsstart;
	$file->nend=$newsend;
	$lastInsId=$file->add(); 
	
	session('nid',$lastInsId);
	
	}
}
?>